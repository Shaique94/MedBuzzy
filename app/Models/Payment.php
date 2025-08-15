<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'appointment_id',
        'patient_id', 
        'created_by',
        'amount',
        'total_amount',
        'method',
        'status',
        'payment_status',
        'transaction_id',
        'razorpay_payment_id',
        'razorpay_order_id',
        'razorpay_signature',
        'order_id',
        'receipt_no',
        'payment_date',
        'ip_address',
        'month',
        'year',
        'settlement'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'settlement' => 'boolean',
        'payment_date' => 'datetime'
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
