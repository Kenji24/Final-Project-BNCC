<?php

namespace App\Http\Controllers;

use App\Models\InvoiceHeader;
use App\Models\InvoiceDetail;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index(){
        $user_id = auth()->user()->id;
        $invoice = InvoiceHeader::where('user_id', $user_id)->get();
        $finalInvoice = [];

        if($invoice){
            $invoiceDetail = [];

            foreach ($invoice as $item) {
                $invoiceDetailInfo = InvoiceDetail::where("invoice_headers_id", $item->id)->get();
                array_push($invoiceDetail, $invoiceDetailInfo);
            }

            foreach ($invoice as $key => $item) {
                $finalInvoice[$key] = [
                    "invoiceHeader" => $item,
                    "invoiceDetail" => $invoiceDetail[$key],
                ];
            }
        }

        // dd($finalInvoice);

        return view('Invoice.index', compact('finalInvoice'));
    }
}
