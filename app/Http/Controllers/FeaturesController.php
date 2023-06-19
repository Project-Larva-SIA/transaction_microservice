<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use App\Models\Items;
use App\Models\Transaction;
use Carbon\Carbon;
Class FeaturesController extends Controller {

use ApiResponser;

private $request;


public function __construct(Request $request){
    $this->request = $request;
}

public function claimItem(Request $request, $ItemID)
{

    // Retrieve the transaction record from the Transaction model based on the ItemID
    $transaction = Transaction::where('ItemID', $ItemID)->first();

    // Check if the transaction record exists
    if (!$transaction) {
        // Handle the case when the transaction record does not exist
        return response()->json(['error' => 'Transaction not found'], 404);
    }

    // Construct the response data
    $transactionDetails = [
        'ItemID' => $transaction->ItemID,
        'BuyerID' => $transaction->BuyerID,
        'TransactionAmount' => $transaction->TransactionAmount,
        'TransactionTime' => $transaction->TransactionTime,
    ];

    return $this->successResponse($transactionDetails);

}

public function showBuyer(Request $request, $SellerID)
{
    // Retrieve the transaction records from the Transaction model based on the SellerID
    $transactions = Transaction::where('SellerID', $SellerID)->get(['ItemID', 'BuyerID']);

    // Construct the response data
    $buyerDetails = $transactions->map(function ($transaction) {
        return [
            'ItemID' => $transaction->ItemID,
            'BuyerID' => $transaction->BuyerID,
        ];
    });

    return $this->successResponse($buyerDetails);
}





}
