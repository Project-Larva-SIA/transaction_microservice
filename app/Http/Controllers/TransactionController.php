<?php
namespace App\Http\Controllers;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;
// use App\Models\Items;

Class TransactionController extends Controller {
use ApiResponser;
private $request;


public function __construct(Request $request){
    $this->request = $request;
}

public function index()
{

    $transaction = Transaction::all();
    return $this->successResponse($transaction);
}
public function addTransaction(Request $request ){

    $rules = [

    'TransactionID' => 'required',
    'ItemID' => 'required',
    'SellerID' => 'required',
    'BuyerID' => 'required',
    'TransactionAmount' => 'required',

    ];

    $this->validate($request,$rules);
    $transaction = Transaction::create($request->all());

    return $this->successResponse($transaction, Response::HTTP_CREATED);
}

public function showTransaction($TransactionID)
{
    $transaction = Transaction::findOrFail($TransactionID);
    return $this->successResponse($transaction);

}


public function deleteTransaction($TransactionID)
{
    $transaction = Transaction::findOrFail($TransactionID);
    $transaction->delete();

    return $this->successResponse($transaction);

}

}
