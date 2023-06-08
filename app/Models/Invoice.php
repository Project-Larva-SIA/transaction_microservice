<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model{

protected $table = 'invoices';

public $primaryKey = 'InvoiceID';

public $timestamps = false;

protected $fillable = [
    'InvoiceID', 'UserID', 'ItemID', 'Amount', 'TransactionID', 'invoiceTime'
];
}