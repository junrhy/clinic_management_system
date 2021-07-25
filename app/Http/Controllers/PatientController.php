<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

use App\Model\Client;
use App\Model\Patient;
use App\User;
use App\Model\Clinic;
use App\Model\Doctor;
use App\Model\Service;
use App\Model\PatientDetail;
use App\Model\Prescription;
use App\Model\PatientBillingCharge;
use App\Model\PatientBillingPayment;
use App\Model\DentalChart;
use App\Model\Attachment;

use DB;
use Auth;
use DateTime;
use PDF;
use Carbon\Carbon;

class PatientController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/patient_view';

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['register_as_patient', 'create_patient_user'] ]);
    }

    public function index(Request $request)
    {
        $patients = Patient::where('client_id', Auth::user()->client_id)
                            ->where('last_name', 'like', $request->namelist . '%')
                            ->whereNull('is_registration_request')
                            ->orderBy('last_name', 'asc')
                            ->paginate(30);

        return view('patient.index')
              ->with('patients', $patients)
              ->with('namelist', $request->namelist);
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword;
        
        $multiple_keyword = explode(' ', $request->keyword);

        $patients = Patient::where('client_id', Auth::user()->client_id)
                            ->whereIn('first_name', $multiple_keyword)
                            ->orWhereIn('last_name', $multiple_keyword)
                            ->orWhereIn('contact_number', $multiple_keyword)
                            ->orWhere('first_name', 'like', '%' . $keyword . '%')
                            ->orWhere('last_name', 'like', '%' . $keyword . '%')
                            ->orWhere('contact_number', 'like', '%' . $keyword . '%')
                            ->paginate(30);

        return view('patient._table_data')
              ->with('patients', $patients);
    }

    public function create()
    {
        return view('patient.create');
    }

    public function store(Request $request)
    {
        $user_max_id = User::whereRaw('id = (select max(`id`) from users)')->first();
        $unique_id = $user_max_id->id + 1;

        $patient = new Patient;
        $patient->client_id = Auth::user()->client_id;
        $patient->first_name = $request->first_name;
        $patient->last_name = $request->last_name;
        $patient->dob = $request->dob != '' ? date('Y-m-d', strtotime($request->dob)) : null;
        $patient->gender = $request->gender;
        $patient->email = $request->email;
        $patient->contact_number = $request->contact_number;
        $patient->save();

        // begin upload logo
        $FILESYSTEM_DRIVER = env('FILESYSTEM_DRIVER', 'local');

        $file = $request->file('profile_picture');

        if(!empty($file)):
            $folder_name = 'patient_profile_pictures';
            $directory = 'client' . Auth::user()->client_id .'/' . $folder_name;

            Storage::disk($FILESYSTEM_DRIVER)->makeDirectory($directory);

            try {
                Storage::disk($FILESYSTEM_DRIVER)->put($directory . '/' . $patient->id .'_'. $file->getClientOriginalName(), file_get_contents($file), 'public');
            } catch (Exception $e) {
                dd($e);
            }

            $patient = Patient::find($patient->id);
            $patient->profile_picture = $directory . '/' . $patient->id .'_'. $file->getClientOriginalName();
            $patient->save();
        endif;
        // end upload

        return redirect('patient');
    }

    public function show($id)
    {
        $patient = Patient::find($id);

        $clinics = Clinic::where('client_id', Auth::user()->client_id)->orderBy('name', 'asc')->get();

        $doctors = Doctor::select(DB::raw("CONCAT(first_name,' ',last_name) AS fullname"),'id')
                            ->where('client_id', Auth::user()->client_id)
                            ->orderBy('first_name', 'asc')
                            ->get();

        $services = Service::where('client_id', Auth::user()->client_id)->orderBy('name', 'asc')->get();
        
        $patient_details = PatientDetail::where('patient_id', $patient->id)
                                        ->whereNull('is_schedule_request')
                                        ->where('is_archived', false)
                                        ->orderBy('created_at', 'asc')->get();

        $archived_details = PatientDetail::where('patient_id', $patient->id)
                                        ->whereNull('is_schedule_request')
                                        ->where('is_archived', true)
                                        ->orderBy('created_at', 'asc')->get();

        $prescriptions = Prescription::where('patient_id', $patient->id)->orderBy('created_at', 'asc')->get();

        return view('patient.show')
                ->with('patient', $patient)
                ->with('clinics', $clinics)
                ->with('doctors', $doctors)
                ->with('services', $services)
                ->with('details', $patient_details)
                ->with('archived_details', $archived_details)
                ->with('prescriptions', $prescriptions);
    }

    public function edit($id)
    {
        $patient = Patient::find($id);

        return view('patient.edit')
                ->with('patient', $patient);
    }

    public function update(Request $request, $id)
    {
        $patient = Patient::find($id);
        $patient->first_name = $request->first_name;
        $patient->last_name = $request->last_name;
        $patient->dob = $request->dob != '' ? date('Y-m-d', strtotime($request->dob)) : null;
        $patient->gender = $request->gender;
        $patient->email = $request->email;
        $patient->contact_number = $request->contact_number;

        // begin upload logo
        $FILESYSTEM_DRIVER = env('FILESYSTEM_DRIVER', 'local');

        $file = $request->file('profile_picture');

        if(!empty($file)):
            $folder_name = 'patient_profile_pictures';
            $directory = 'client' . Auth::user()->client_id .'/' . $folder_name;

            Storage::disk($FILESYSTEM_DRIVER)->makeDirectory($directory);

            try {
                Storage::disk($FILESYSTEM_DRIVER)->put($directory . '/' . $patient->id .'_'. $file->getClientOriginalName(), file_get_contents($file), 'public');
            } catch (Exception $e) {
                dd($e);
            }

            $patient->profile_picture = $directory . '/' . $patient->id .'_'. $file->getClientOriginalName();
        endif;
        // end upload

        $patient->save();

        return redirect('patient');
    }

    public function delete_patient_profile_pic($id)
    {
        $patient = Patient::find($id);
        
        $folder_name = 'patient_profile_pictures';
        $file = $patient->profile_picture;

        $FILESYSTEM_DRIVER = env('FILESYSTEM_DRIVER', 'local');
        Storage::disk($FILESYSTEM_DRIVER)->delete($file);

        $patient->profile_picture = null;
        $patient->save();

        return back()->with('success','Profile picture successfully deleted!');
    }

    public function destroy(Request $request, $id)
    {
        $patient = Patient::find($id);
        $patient_id = $patient->id;
        $user_id = $patient->user_id;

        $FILESYSTEM_DRIVER = env('FILESYSTEM_DRIVER', 'local');
        Storage::disk($FILESYSTEM_DRIVER)->delete($patient->profile_picture);

        $patient->delete();

        PatientDetail::where('patient_id', $patient_id)->delete();
        PatientBillingCharge::where('patient_id', $patient_id)->delete();
        PatientBillingPayment::where('patient_id', $patient_id)->delete();
        User::where('id', $user_id)->forceDelete();
    }

    public function create_patient_detail(Request $request)
    {
        $clinic = Clinic::find($request->clinic_id);
        $doctor = Doctor::find($request->doctor_id);
        $patient = Patient::find($request->patient_id);

        $patient_detail = new PatientDetail;
        $patient_detail->client_id = Auth::user()->client_id;
        $patient_detail->patient_id = $request->patient_id;
        $patient_detail->clinic_id = $clinic->id;
        $patient_detail->doctor_id = $doctor->id;
        $patient_detail->clinic = $clinic->name;
        $patient_detail->doctor = $doctor->first_name .' '. $doctor->last_name;
        $patient_detail->service = $request->service;
        $patient_detail->notes = nl2br($request->notes);
        $patient_detail->attachment_number = $request->attachment_number;
        $patient_detail->is_scheduled = $request->date_scheduled != '' ? true : false;
        $patient_detail->date_scheduled = $request->date_scheduled != '' ? date('Y-m-d', strtotime($request->date_scheduled)) : null;
        $patient_detail->time_scheduled = $request->time_scheduled != '' ? DateTime::createFromFormat('H:i a', $request->time_scheduled) : null;
        $patient_detail->created_by = Auth::user()->first_name . ' ' . Auth::user()->last_name;

        if ($request->invoice_item && count($request->invoice_item) > 0) {
            
            for ($invoice_item_count=0; $invoice_item_count < count($request->invoice_item); $invoice_item_count++) { 
                $billing_charge = new PatientBillingCharge;
                $billing_charge->client_id = Auth::user()->client_id;
                $billing_charge->patient_id = $request->patient_id;
                $billing_charge->doctor_id = $request->doctor_id;
                $billing_charge->description = $request->invoice_item[$invoice_item_count]['service'] ." x ". $request->invoice_item[$invoice_item_count]['qty'];
                $billing_charge->amount = $request->invoice_item[$invoice_item_count]['qty'] * $request->invoice_item[$invoice_item_count]['price'];
                $billing_charge->save();
            }
        }

        if ($request->amount_paid) {
            $billing_payment = new PatientBillingPayment;
            $billing_payment->client_id = Auth::user()->client_id;
            $billing_payment->patient_id = $request->patient_id;
            $billing_payment->doctor_id = $request->doctor_id;
            $billing_payment->description = "Payment for services: " . $request->service;
            $billing_payment->amount = $request->amount_paid;
            $billing_payment->save();
        }

        if ($request->date_scheduled != '') {
          $patient_detail->status = 'Open';
        }

        $patient_detail->save();
    }

    public function upload_detail(Request $request)
    {
        $FILESYSTEM_DRIVER = env('FILESYSTEM_DRIVER', 'local');

        $files = $request->file('attachment');

        if(!empty($files)):
            $folder_name = $request->patient_id . '-' . date('m-d-Y-H-i-s');

            Storage::disk($FILESYSTEM_DRIVER)->makeDirectory('client' . Auth::user()->client_id .'/'. $folder_name);

            foreach ($files as $file):
                try {
                    Storage::disk($FILESYSTEM_DRIVER)->put('client' . Auth::user()->client_id .'/'. $folder_name .'/'. $file->getClientOriginalName(), file_get_contents($file), 'public');
                } catch (Exception $e) {
                    dd($e);
                }
                

                $attachment = new Attachment;
                $attachment->attachment_number = $request->attachment_number;
                $attachment->filename = $file->getClientOriginalName();
                $attachment->path = $folder_name;
                $attachment->save();
            endforeach;
        endif;
    }

    public function update_patient_detail(Request $request, $id)
    {
        $clinic = Clinic::find($request->clinic_id);
        $doctor = Doctor::find($request->doctor_id);

        $patient_detail = PatientDetail::find($id);
        $patient_detail->clinic_id = $clinic->id;
        $patient_detail->doctor_id = $doctor->id;
        $patient_detail->clinic = $clinic->name;
        $patient_detail->doctor = $doctor->first_name .' '. $doctor->last_name;
        $patient_detail->service = $request->service;
        $patient_detail->notes = nl2br($request->notes);

        if ($request->status == 'Done') {
            $patient_detail->date_scheduled = null;
            $patient_detail->time_scheduled = null;
            $patient_detail->created_at = $request->date_scheduled != '' ? date('Y-m-d', strtotime($request->date_scheduled)) : date('Y-m-d');

            if ($request->invoice_item && count($request->invoice_item) > 0) {
                
                for ($invoice_item_count=0; $invoice_item_count < count($request->invoice_item); $invoice_item_count++) { 
                    $billing_charge = new PatientBillingCharge;
                    $billing_charge->client_id = Auth::user()->client_id;
                    $billing_charge->patient_id = $patient_detail->patient_id;
                    $billing_charge->doctor_id = $request->doctor_id;
                    $billing_charge->description = $request->invoice_item[$invoice_item_count]['service'] ." x ". $request->invoice_item[$invoice_item_count]['qty'];
                    $billing_charge->amount = $request->invoice_item[$invoice_item_count]['qty'] * $request->invoice_item[$invoice_item_count]['price'];
                    $billing_charge->save();
                }
            }

            if ($request->amount_paid) {
                $billing_payment = new PatientBillingPayment;
                $billing_payment->client_id = Auth::user()->client_id;
                $billing_payment->patient_id = $patient_detail->patient_id;
                $billing_payment->doctor_id = $request->doctor_id;
                $billing_payment->description = "Payment for services: " . $request->service;
                $billing_payment->amount = $request->amount_paid;
                $billing_payment->save();
            }
            
        } else {
            $patient_detail->date_scheduled = $request->date_scheduled != '' ? date('Y-m-d', strtotime($request->date_scheduled)) : null;
            $patient_detail->time_scheduled = DateTime::createFromFormat('H:i a', $request->time_scheduled);
        }
        
        $patient_detail->status = $request->status;
        $patient_detail->save();
    }

    public function delete_patient_detail(Request $request, $id)
    {
        $patient_detail = PatientDetail::find($id);

        if ($patient_detail->attachment_number != "") {

            $attachments = Attachment::where('attachment_number', $patient_detail->attachment_number)->get();

            $FILESYSTEM_DRIVER = env('FILESYSTEM_DRIVER', 'local');

            foreach ($attachments as $attachment):
                $attachment->delete();

                Storage::disk($FILESYSTEM_DRIVER)->delete('client' . Auth::user()->client_id .'/'. $attachment->path .'/'. $attachment->filename);
               
                if ($FILESYSTEM_DRIVER == "public") {
                    $FileSystem = new Filesystem();

                    $directory = 'storage/'. $attachment->path;
                
                    if ($FileSystem->exists($directory)) {
                        $files = $FileSystem->files($directory);

                        if (empty($files)) {
                            $FileSystem->deleteDirectory($directory);
                        }
                    }
                }
                

                if ($FILESYSTEM_DRIVER == "spaces") {
                    if ( in_array( 'client' . Auth::user()->client_id .'/'. $attachment->path, Storage::disk($FILESYSTEM_DRIVER)->directories('client' . Auth::user()->client_id) ) ) {
                        
                        if ( empty( Storage::disk($FILESYSTEM_DRIVER)->files('client' . Auth::user()->client_id .'/'. $attachment->path) ) ) {
                            Storage::disk($FILESYSTEM_DRIVER)->deleteDirectory('client' . Auth::user()->client_id .'/'. $attachment->path);
                        }
                    }
                }
           endforeach;
        }
        
        $patient_detail->delete();
    }

    public function bulk_delete_patient_detail(Request $request)
    {
        PatientDetail::whereIn('id', $request->ids)->delete(); 
    }

    public function archive_patient_detail($id)
    {
        $patient_detail = PatientDetail::find($id);
        $patient_detail->is_archived = true;
        $patient_detail->save();
    }

    public function unarchive_patient_detail($id)
    {
        $patient_detail = PatientDetail::find($id);
        $patient_detail->is_archived = false;
        $patient_detail->save();
    }

    public function store_prescription(Request $request)
    {
        $clinic = Clinic::where('name', $request->clinic)->first();
        
        $doctor = Doctor::select(DB::raw("CONCAT(first_name,' ',last_name) AS fullname"),'id')
                            ->where('id', $request->doctor)
                            ->first();

        $prescription = new Prescription;
        $prescription->client_id = Auth::user()->client_id;
        $prescription->patient_id = $request->patient_id;
        $prescription->clinic_id = $clinic->id;
        $prescription->doctor_id = $doctor->id;
        $prescription->clinic = $request->clinic;
        $prescription->doctor = $doctor->fullname;
        $prescription->prescription = nl2br($request->prescription);
        $prescription->created_by = Auth::user()->first_name . ' ' . Auth::user()->last_name;
        
        $prescription->save();
    }

    public function print_prescription(Request $request)
    {
        $prescription = Prescription::find($request->id);

        return view('patient._prescription_print')
                    ->with('prescription', $prescription);
    }

    public function delete_prescription($id)
    {
        $prescription = Prescription::find($id);
        $prescription->delete();
    }

    public function patient_view()
    {
        if( Auth::check() ) {
            $user = User::find(Auth::user()->id);
            $user->last_active_at = Carbon::now()->toDateTimeString();
            $user->save();
        }

        $patient = Patient::where('user_id', Auth::user()->id)->first();

        $appointments = PatientDetail::where('client_id', Auth::user()->client_id)
                                ->where('patient_id', $patient->id)
                                ->whereIn('status', ['Open', 'In Progress'])
                                ->orderBy('time_scheduled', 'asc')
                                ->get();

        $prescriptions = Prescription::where('patient_id', $patient->id)->get();

        return view('patient.patient_view')
                    ->with('patient', $patient)
                    ->with('appointments', $appointments)
                    ->with('prescriptions', $prescriptions);
    }

    public function download_medical_record(Request $request)
    {
        $patient = Patient::find($request->patient_id);

        $medical_records = PatientDetail::where('patient_id', $patient->id)->orderBy('created_at', 'asc')->get();

        $data = ['patient' => $patient, 'medical_records' => $medical_records];

        $pdf = PDF::loadView('patient._download_medical_record', $data);
        $pdf->setPaper('a4', 'portrait');

        return $pdf->download($patient->first_name . '_' . $patient->last_name . '_medical_record.pdf');
    }

    public function register_as_patient()
    {
        return view('patient.auth.register');
    }

    public function create_patient_user(Request $request)
    {
        $client = Client::find($request->client_id);

        if ($client == null) {
            return abort(404, 'Registration not available. Contact Administrator.');
        }

        $validated = $request->validate([
            'username' => 'required|string|max:50|unique:users',
            'dob' => 'required',
            'gender' => 'required',
            'email' => 'nullable|string|email|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'client_id' => $request->client_id,
            'first_name'=> $request->first_name,
            'last_name' => $request->last_name,
            'name'      => $request->first_name .' '. $request->last_name,
            'username'  => $request->username,
            'email'     => $request->email,
            'password'  => bcrypt($request->password),
            'type'      => User::PATIENT_TYPE,
            'is_client' => false,
        ]);

        $patient = new Patient;
        $patient->client_id = $request->client_id;
        $patient->first_name = $request->first_name;
        $patient->last_name = $request->last_name;
        $patient->dob = $request->dob != '' ? date('Y-m-d', strtotime($request->dob)) : null;
        $patient->gender = $request->gender;
        $patient->email = $request->email;
        $patient->contact_number = $request->contact;
        $patient->user_id = $user->id;
        $patient->is_registration_request = true;
        $patient->save();

        $this->guard()->login($user);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }

    public function patient_registration_requests()
    {
        $patients = Patient::where('client_id', Auth::user()->client_id)
                            ->where('is_registration_request', true)
                            ->orderBy('last_name', 'asc')
                            ->paginate(30);

        return view('patient.registration_requests')
              ->with('patients', $patients);
    }

    public function patient_registration_request_approved(Request $request)
    {
        $patient = Patient::find($request->id);
        $patient->is_registration_request = null;
        $patient->save();
    }

    public function patient_registration_request_denied($id)
    {
        $patient = Patient::find($id);

        $user = User::find($patient->user_id);
        $user->forceDelete();
        
        $patient->delete();
    }

    public function create_patient_user_account($id)
    {
        $patient = Patient::find($id);

        return view('patient.auth.create_patient_user_account')
              ->with('patient', $patient);
    }

    public function save_patient_user_account(Request $request)
    {
        $request->validate([
            'patient_id' => 'required',
            'username' => 'required|string|max:50|unique:users',
            'password' => 'required|confirmed|min:6'
        ]);

        $patient = Patient::find($request->patient_id);

        $user = new User();
        $user->client_id = Auth::user()->client_id;
        $user->first_name = $patient->first_name;
        $user->last_name = $patient->last_name;
        $user->name = $patient->first_name .' '. $patient->last_name;
        $user->username = $request->username;
        $user->email = $patient->email;
        $user->password = bcrypt($request->password);
        $user->type = User::PATIENT_TYPE;
        $user->is_client = false;
        $user->save();

        $patient->user_id = $user->id;
        $patient->save();

        return redirect('patient');
    }

    public function remove_patient_user_account(Request $request)
    {
        $patient = Patient::find($request->id);

        $user = User::find($patient->user_id);
        $user->forceDelete();

        $patient->user_id = null;
        $patient->save();
    }
}
