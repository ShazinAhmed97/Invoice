<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\InvoiceModel;

class EntryModel extends Model
{
    use HasFactory;
    protected $table = 'entry';
    protected $primaryKey='bId';
    protected $fillable = [
        'cust_name',
        'cust_email',
        'quantity',
        'amount',
        'tax_percentage',
        'tax_amount',
        'net_amounr',
        'image',
        'date',
        'isAvail',
        'is_confirm',
        'created_at',
        'updated_at',

    ];

}
