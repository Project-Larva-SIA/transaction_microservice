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


public function index()
{
    $invoices = Invoice::all();
    return $this->successResponse($invoices);
}
public function addInvoice(Request $request ){
    
    $rules = [
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


public function deleteInvoices($InvoiceID)
{
    $invoices = Invoice::findOrFail($InvoiceID);
    $invoices->delete();

    return $this->successResponse($invoices);

}

}
