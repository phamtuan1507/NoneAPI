<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'order_number', 'total_amount', 'status', 'payment_method',
        'billing_name', 'billing_company', 'billing_address1', 'billing_address2',
        'billing_city', 'billing_postal_code', 'billing_phone', 'billing_email',
        'billing_country', 'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
