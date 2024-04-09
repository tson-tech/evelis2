<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferAudit extends Model
{
    use HasFactory;

    protected $table = 'transfer_audits';

    protected $fillable = [
        'customer_id',
        'ip_address',
        'location',
        'amount',
    ];
}
