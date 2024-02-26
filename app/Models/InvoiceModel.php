<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EntryModel;

class InvoiceModel extends Model
{
    use HasFactory;
    protected $table = 'invoice';
    protected $primaryKey='iId';
    protected $fillable = [
        'bId',
        'invoice_no',
        'created_at',
    ];
}
