<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use App\Model\FeatureUser;

class FeatureUser extends Model
{
    public static function is_feature_allowed($feature_name, $user_id)
    {
    	$feature = FeatureUser::where('name', $feature_name)->first();

    	if ($feature != null) {
    		$ids = array_map('intval', explode(',', $feature->user_ids));

	        if (($key = array_search($user_id, $ids)) !== false) {
	            return '';
	        } else {
	        	return 'hidden';
	        }
    	}
    	
    	return '';
    }

    public static function is_feature_checked($feature_name, $user_id)
    {
        $feature = FeatureUser::where('name', $feature_name)->first();

        if ($feature != null) {
            $ids = array_map('intval', explode(',', $feature->user_ids));

            if (($key = array_search($user_id, $ids)) !== false) {
                return 'checked';
            }
        }
        
        return '';
    }
}
