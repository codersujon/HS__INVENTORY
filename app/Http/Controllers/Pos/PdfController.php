<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
use App\Models\Invoice;
use App\Models\Payment;



class PdfController extends Controller
{


    public function generatePdf(){
        $pdf = PDF::loadView('pdf.daily_purchase_pdf', $data);
        return $pdf->stream('Daily Purchase.pdf');
    }

    /**
     * INVOICE PRINT
     */

     public function invoicePrint($id){
        $invoice = Invoice::with('invoice_details')->findOrFail($id);
        $payment = Payment::where('invoice_id', $id)->first();
        $data = [
            "title" => "hypershop.com.bd",
            "invoice"=> $invoice,
            "payment"=>$payment
        ];
        $pdf = PDF::loadView('backend.pdf.single_invoice_pdf', compact('data'));
        return $pdf->stream('invoice.pdf');
    } // End Print
}
