<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

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

class PatientController extends Controller
{
     public function __construct()
     {
        $this->middleware('auth');
     }

    public function index(Request $request)
    {
        $patients = Patient::where('client_id', Auth::user()->client_id)
                            ->where('last_name', 'like', $request->namelist . '%')
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

        $user = new User;
        $user->client_id = Auth::user()->client_id;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->username = strtolower(substr($request->first_name, 0, 1) . str_replace(" ", "_", $request->last_name) . $unique_id);
        $user->email = $request->email;
        $user->password = bcrypt("123456");
        $user->type = 'patient';
        $user->save();

        $patient = new Patient;
        $patient->client_id = Auth::user()->client_id;
        $patient->first_name = $request->first_name;
        $patient->last_name = $request->last_name;
        $patient->dob = $request->dob != '' ? date('Y-m-d', strtotime($request->dob)) : null;
        $patient->gender = $request->gender;
        $patient->email = $request->email;
        $patient->contact_number = $request->contact_number;
        $patient->user_id = $user->id;
        $patient->save();

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
        $patient_details = PatientDetail::where('patient_id', $patient->id)->where('is_archived', false)->orderBy('created_at', 'asc')->get();
        $archived_details = PatientDetail::where('patient_id', $patient->id)->where('is_archived', true)->orderBy('created_at', 'asc')->get();

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
        $patient->address = $request->address;
        $patient->save();

        return redirect('patient');
    }

    public function destroy(Request $request, $id)
    {
        $patient = Patient::find($id);
        $patient_id = $patient->id;
        $user_id = $patient->user_id;

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
        $patient_detail = PatientDetail::find($id);
        $patient_detail->clinic = $request->clinic;
        $patient_detail->doctor = $request->doctor;
        $patient_detail->service = $request->service;
        $patient_detail->notes = nl2br($request->notes);

        if ($request->status == 'Done') {
            $patient_detail->date_scheduled = null;
            $patient_detail->time_scheduled = null;
            $patient_detail->created_at = $request->date_scheduled != '' ? date('Y-m-d', strtotime($request->date_scheduled)) : date('Y-m-d');
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
}
