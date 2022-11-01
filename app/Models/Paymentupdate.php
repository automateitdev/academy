<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paymentupdate extends Model
{
    use HasFactory;
    protected $fillable = [
        'session_token',
        'status',
        'msg',
        'transaction_id',
        'transaction_date',
        'invoice_no',
        'invoice_date',
        'br_code',
        'applicant_name',
        'applicant_no',
        'total_amount',
        'pay_status',
        'pay_mode',
        'pay_amount',
        'vat',
        'comission',
        'scroll_no'
        
    ];
}
