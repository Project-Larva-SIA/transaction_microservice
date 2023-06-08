<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model{

protected $table = 'transactions';

public $primaryKey = 'TransactionID';

public $timestamps = false;

protected $fillable = [
    'TransactionID', 'ItemID', 'SellerID', 'BuyerID', 'TransactionAmount', 'TransactionTime'
];
}