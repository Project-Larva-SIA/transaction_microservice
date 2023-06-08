<?php
namespace App\Http\Controllers;
use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;

Class InvoicesController extends Controller {
use ApiResponser;
private $request;


public function __construct(Request $request){
    $this->request = $request;
}

public function getInvoices(){

$invoices = Invoice::all();

return $this->successResponse($invoices, Response::HTTP_OK);

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

    $invoices = Invoice::all();
    return $this->successResponse($invoices);
}
public function addTransaction(Request $request ){

    $rules = [

    'InvoiceID' => 'required',
    'UserID' => 'required',
    'ItemID' => 'required',
    'Amount' => 'required',
    'TransactionID' => 'required',

    ];

    $this->validate($request,$rules);
    $invoices = Invoice::create($request->all());

    return $this->successResponse($invoices, Response::HTTP_CREATED);
}

public function showInvoices($InvoiceID)
{
    $invoices = Invoice::findOrFail($InvoiceID);
    return $this->successResponse($invoices);

}

public function updateInvoices(Request $request,$InvoiceID)
{
        
    $rules = [

    'InvoiceID' => 'required',
    'UserID' => 'required',
    'ItemID' => 'required',
    'Amount' => 'required',
    'TransactionID' => 'required',
    
];

    $this->validate($request, $rules);
    $invoices = Invoice::findOrFail($InvoiceID);
    $invoices->fill($request->all());

    // if no changes happen
    if ($invoices->isClean()) {
    return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    $invoices->save();
    return $this->successResponse($invoices);

}

public function deleteInvoices($InvoiceID)
{
    $invoices = Invoice::findOrFail($InvoiceID);
    $invoices->delete();

    return $this->successResponse($invoices);

}

}
