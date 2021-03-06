<?php

use Illuminate\Database\Seeder;

use App\Model\FeatureUser;

class FeatureUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect(['dashboard', 
            'appointment', 
            'add_appointment', 
            'edit_appointment', 
            'dental', 
            'patients', 
            'add_patient', 
            'edit_patient', 
            'delete_patient', 
            'view_patient_record', 
            'add_patient_detail', 
            'delete_patient_detail', 
            'archive_patient_detail', 
            'unarchive_patient_detail', 
            'add_patient_prescription', 
            'delete_patient_prescription',
            'clinics', 
            'add_clinic', 
            'edit_clinic', 
            'delete_clinic', 
            'doctors', 
            'add_doctor', 
            'edit_doctor', 
            'delete_doctor', 
            'services', 
            'add_service', 
            'edit_service', 
            'delete_service', 
            'billing', 
            'add_billing_invoice', 
            'delete_billing_invoice', 
            'add_billing_payment', 
            'delete_billing_payment', 
            'staffs', 
            'add_staff', 
            'edit_staff', 
            'delete_staff', 
            'set_privileges', 
            'account',
            'edit_business_information'])->each(function ($item, $key) {
            
	        $feature = FeatureUser::create(['name' => $item]);
        });

        $this->command->info('Feature Users list seeded.');
    }
}
