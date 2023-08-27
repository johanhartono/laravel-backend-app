<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable =['user_id','seller_id','number','total_price','payment_status',
    'snap_url','delivery_address','order_id'];
}
