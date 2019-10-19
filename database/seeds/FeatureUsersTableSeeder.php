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
        collect(['dashboard', 'calendar', 'add_appointment', 'edit_appointment', 'patients', 'add_patient', 'edit_patient', 'delete_patient', 'view_patient_record', 'add_patient_detail', 'delete_patient_detail', 'archive_patient_detail', 'unarchive_patient_detail', 'add_patient_charge', 'delete_patient_charge', 'add_patient_payment', 'delete_patient_payment', 'dental_chart', 'clinics', 'add_clinic', 'edit_clinic', 'delete_clinic', 'doctors', 'add_doctor', 'edit_doctor', 'delete_doctor', 'services', 'add_service', 'edit_service', 'delete_service', 'users', 'add_user', 'edit_user', 'delete_user', 'set_privileges', 'settings', 'edit_business_information'])->each(function ($item, $key) {
	        $feature = FeatureUser::create(['name' => $item]);
        });

        $this->command->info('Feature Users list seeded.');
    }
}
