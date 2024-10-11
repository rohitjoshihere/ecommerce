<?php

namespace App;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryPartner extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone_number',
        'vehicle_number',
        'address',
        'availability',
    ];

    public function orders()
    {
        
        return $this->hasMany(Order::class, 'delivery_partner_id');
    }
}
