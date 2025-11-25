<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChargerData extends Model
{
   use HasFactory;

    protected $table = 'chargers';   // your table name

    protected $fillable = [
        'inward_date',
        'part_serial_no',
        'inward_lr_no',
        'dealer_name',
        'dealer_code',
        'part_name',
        'part_code',
        'vin_number',
        'sales_date',
        'warranty_remark',
        'problem_remark',
        'status',
        'device_status',
        'child_parts_used',
        'resolution_remark',
        'dispatch_date',
        'dispatch_lr_no',
    ];
}
