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

public function getTransaction(){

$transaction = Transaction::all();

return $this->successResponse($transaction, Response::HTTP_OK);

}

// public function show($BidID)
// {
//     $specificData = Bids::find($BidID);

//     if (!$specificData) {
//         return response()->json(['message' => 'Bid not found'], 404);
//     }

//     $bidderId = $specificData->BidderID;
//     $bidAmount = $specificData->BidAmount;
//     $itemId = $specificData->ItemID;

//     // Fetch the ItemName based on the ItemID
//     $item = Items::find($itemId);
//     $itemName = $item ? $item->ItemName : null;

//     return response()->json(['BidderID' => $bidderId, 'BidAmount' => $bidAmount, 'ItemName' => $itemName]);
// }



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

public function updateTransaction(Request $request,$TransactionID)
{
        
    $rules = [

    'TransactionID' => 'required',
    'ItemID' => 'required',
    'SellerID' => 'required',
    'BuyerID' => 'required',
    'TransactionAmount' => 'required',
    
];

    $this->validate($request, $rules);
    $transaction = Transaction::findOrFail($TransactionID);
    $transaction->fill($request->all());

    // if no changes happen
    if ($transaction->isClean()) {
    return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    $transaction->save();
    return $this->successResponse($transaction);

}

public function deleteTransaction($TransactionID)
{
    $transaction = Transaction::findOrFail($TransactionID);
    $transaction->delete();

    return $this->successResponse($transaction);

}

}
