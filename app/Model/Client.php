<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use App\User;

use DB;

class Client extends Model
{
	public function clinics()
    {
        return $this->hasMany(Clinic::class);
    }

	public function patients()
    {
        return $this->hasMany(Patient::class);
    }

    public function inventories()
    {
        return $this->hasMany(Inventory::class)->select('name', DB::raw('SUM(qty) as qty'))->groupBy('name');
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'client_id');
    }

    public function billing_statements()
    {
        return $this->hasMany(BillingStatement::class);
    }

    public function billing_statements_unpublish()
    {
        return $this->hasMany(BillingStatement::class)->where('is_publish', false);
    }

    public function billing_statements_published()
    {
        return $this->hasMany(BillingStatement::class)->where('is_publish', true);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function disconnection_reasons()
    {
        return $this->hasMany(DisconnectionReason::class);
    }

    public function payments()
    {
        return $this->hasMany(ClientBillingPayment::class)->orderBy('paid_at', 'desc');
    }
}
