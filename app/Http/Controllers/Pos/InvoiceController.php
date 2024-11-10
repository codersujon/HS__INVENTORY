<?php

namespace App\Http\Controllers\Pos;
date_default_timezone_set('Asia/Dhaka');
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Supplier;
use App\Models\Unit;
use App\Models\Category;
use App\Models\Product;
use App\Models\Purchase;

use App\Models\Customer;

use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Payment;
use App\Models\PaymentDetail;


class InvoiceController extends Controller
{
    /**
     * Invoice All
     */
    public function index(){
       $allData = Invoice::orderBy('date', 'DESC')->orderBy('id', 'DESC')->whereIn('status', [0, 1, 2])->get();
       return view('backend.invoice.invoice_all', compact('allData'));
    }

    /**
     * Invoice Add
     */
    public function create(){
        $category = Category::all();
        $invoice_data = Invoice::orderBy('id', 'DESC')->first();
        $customers = Customer::all();

        if($invoice_data == null){
            $firstReg = '0';
            $invoice_no = $firstReg + 1;
        }else{
            $invoice_data = Invoice::orderBy('id', 'DESC')->first()->invoice_no;
            $invoice_no = $invoice_data + 1;
        }

        return view('backend.invoice.invoice_add', compact('category', 'invoice_no', 'customers'));
    }

    /**
     * GET PRODUCT STOCK
     */
    public function getProductStock(Request $request){
        $product_id = $request->product_id;
        $stock = Product::where('id', $product_id)->first()->quantity;
        return response()->json($stock);
    }

    /**
     * INVOICE STORE
     */
    public function store(Request $request){

        // Validation Message
       if($request->category_id == null){
            notyf()
                ->position('x', 'right')
                ->position('y', 'top')
                ->error("Sorry! You don't select any item");
            return redirect()->back();
       }else if($request->paid_status == null){
            notyf()
            ->position('x', 'right')
            ->position('y', 'top')
            ->error("Paid status not found");
            return redirect()->back();
       }else if($request->customer_id == null){
            notyf()
            ->position('x', 'right')
            ->position('y', 'top')
            ->error("Customer info can't be empty!");
            return redirect()->back();
       }else if($request->description == null){
            notyf()
            ->position('x', 'right')
            ->position('y', 'top')
            ->error("Address can't be empty");
            return redirect()->back();
       }else{
            if($request->paid_amount > $request->estimated_amount){
                notyf()
                    ->position('x', 'right')
                    ->position('y', 'top')
                    ->error("Sorry! Paid amount is maximum the total price.");
                return redirect()->back();
            }else{

                $invoice = new  Invoice();
                $invoice->invoice_no = $request->invoice_no;
                $invoice->date = date('Y-m-d', strtotime($request->invoice_date));
                $invoice->description = $request->description;
                $invoice->created_by = Auth::user()->id;
                $invoice->created_at = now();

                // Loop is using for check every unit price and qty field is empty or not
                $count_product = count($request->product_id);
                for($f = 0; $f < $count_product; $f++ ){
                    // Validation Message Notification
                    if($request->selling_qty[$f] == null){
                        notyf()
                            ->position('x', 'right')
                            ->position('y', 'top')
                            ->error("Product Selling quantity required!");
                            return redirect()->back();
                    }else if($request->unit_price[$f] == null){
                        notyf()
                        ->position('x', 'right')
                        ->position('y', 'top')
                        ->error("Selling price required!");
                        return redirect()->back();
                    }else{

                        DB::transaction(function() use ($request, $invoice){
                            if($invoice->save()){

                                $count_category = count($request->category_id);
                                for($i = 0; $i < $count_category; $i++ ){
                                    
                                    $invoice_details =  new InvoiceDetail();
                                    $invoice_details->date = date('Y-m-d', strtotime($request->invoice_date));
                                    $invoice_details->invoice_id = $invoice->id;
                                    $invoice_details->category_id = $request->category_id[$i];
                                    $invoice_details->product_id = $request->product_id[$i];
                                    $invoice_details->selling_qty = $request->selling_qty[$i];
                                    $invoice_details->unit_price = $request->unit_price[$i];
                                    $invoice_details->selling_price = $request->selling_price[$i];
                                    $invoice_details->save();
                                }

                                if($request->customer_id == '0'){
                                    $customer = new Customer();
                                    $customer->customer_name = $request->customerN;
                                    $customer->c_phone = $request->c_phone;
                                    $customer->c_gender = $request->c_gender;
                                    $customer->save();
                                    $customer_id = $customer->id; // Get Customer id which is entry last time
                                } else{
                                    $customer_id = $request->customer_id;
                                }

                                $payment = new Payment();
                                $payment_details = new PaymentDetail();

                                $payment->invoice_id = $invoice->id;
                                $payment->customer_id = $customer_id;
                                $payment->paid_status = $request->paid_status;
                                $payment->paid_amount = $request->paid_amount;
                                $payment->discount_amount = $request->discount_amount;
                                $payment->total_amount = $request->estimated_amount;

                                if($request->paid_status == "full_paid"){
                                    $payment->paid_amount = $request->estimated_amount;
                                    $payment->due_amount = '0';
                                    $payment_details->current_paid_amount = $request->estimated_amount;
                                }elseif($request->paid_status == "full_due"){
                                    $payment->paid_amount = '0';
                                    $payment->due_amount = $request->estimated_amount;
                                    $payment_details->current_paid_amount = '0';
                                }elseif($request->paid_status == "partial_paid"){
                                    $payment->paid_amount = $request->paid_amount;
                                    $payment->due_amount = $request->estimated_amount - $request->paid_amount;
                                    $payment_details->current_paid_amount = $request->paid_amount;;
                                }
                                $payment->save();

                                $payment_details->invoice_id = $invoice->id;
                                $payment_details->date = date('Y-m-d', strtotime($request->invoice_date));
                                $payment_details->save();

                            }
                        });
                    }
                }

            }

       } // END ELSE

        notyf()
            ->position('x', 'right')
            ->position('y', 'top')
            ->success('Sales Invoice Inserted Successfully!');
        return Redirect()->route('invoice.pending');
    }

    /**
     * INVOICE PROCESSING
     */

     public function invoicePending(){
        $allData = Invoice::orderBy('date', 'DESC')->orderBy('id', 'DESC')->where('status', '0')->get();
        return view('backend.invoice.invoice_pending', compact('allData'));
     }

     /**
      * INVOICE APPROVE
      */
    public function invoiceApprove($id){
        $invoice = Invoice::with('invoice_details')->findOrFail($id);
        $payment = Payment::where('invoice_id', $id)->first();
        return view('backend.invoice.invoice_approve', compact('invoice', 'payment'));
    }


    /**
     * INVOICE ON DELIVERY
     */
    public function onDelivery(){
        $allData = Invoice::orderBy('date', 'DESC')->orderBy('id', 'DESC')->where('status', '1')->get();
        return view('backend.invoice.invoice_on_delivery', compact('allData'));
    }


    /**
     * INVOICE DELIVER
     */

    public function invoiceDeliver($id){
        $invoice = Invoice::with('invoice_details')->findOrFail($id);
        $payment = Payment::where('invoice_id', $id)->first();
        return view('backend.invoice.invoice_deliver', compact('invoice', 'payment'));
    }


    /**
     * INVOICE DELIVERABLE
     */

     public function invoiceDeliverableStore(Request $request, $id){

        $invoice = Invoice::findOrFail($id);
        $invoice->status = '2';
        $invoice->updated_by  = Auth::user()->id;
        $result = $invoice->update();

        if($result){
            sweetalert()->success('Invoice Delivered Successfully!');
            return redirect()->route('invoice.all');
        }
     }


    /**
     * INVOICE DELIVERED
     */
    public function invoiceDelivered(){
        $allData = Invoice::orderBy('date', 'DESC')->orderBy('id', 'DESC')->where('status', '2')->get();
        return view('backend.invoice.invoice_delivered', compact('allData'));
    }

    /**
     * INVOICE DESTROY
     */

     public function invoiceDestroy($id){
        $invoice = Invoice::find($id);
        $invoice->delete(); // Invoice id delete
        InvoiceDetail::where('invoice_id', $invoice->id)->delete();
        Payment::where('invoice_id', $invoice->id)->delete();
        PaymentDetail::where('invoice_id', $invoice->id)->delete();
        notyf()
            ->position('x', 'right')
            ->position('y', 'top')
            ->success('Invoice Deleted Successfully!');
        return Redirect()->route('invoice.pending');
     }

     /**
      * Invoice Approval Store
      */

    public function invoiceApprovalStore(Request $request, $id){

        foreach($request->selling_qty as $key => $val){
            $invoice_details =  InvoiceDetail::where('id', $key)->first();
            $product = Product::where('id', $invoice_details->product_id)->first();

            if($product->quantity < $request->selling_qty[$key]){
                notyf()
                ->position('x', 'right')
                ->position('y', 'top')
                ->error('Sorry! You do not have enough quantity of product in stock.');
                return redirect()->back();
            } // End if
        } // End foreach

        $invoice = Invoice::findOrFail($id);
        $invoice->status = '1';
        $invoice->updated_by  = Auth::user()->id;

        DB::transaction(function() use($request, $invoice, $id){
                foreach($request->selling_qty as $key => $val){
                    $invoice_details =  InvoiceDetail::where('id', $key)->first();
                    $product = Product::where('id', $invoice_details->product_id)->first();
                    $product->quantity = ((float)$product->quantity) - ((float)$request->selling_qty[$key]);
                    $product->save();
                }
        });

        $result = $invoice->update();

        if($result){
            sweetalert()->success('Invoice On Delivery Successfully!');
            return redirect()->route('invoice.all');
        }

    }


    /**
     * INVOICE RETURN 
     */
    public function invoiceReturn($id){
        $invoice = Invoice::with('invoice_details')->findOrFail($id);
        $payment = Payment::where('invoice_id', $id)->first();
        return view('backend.invoice.invoice_return', compact('invoice', 'payment'));
    }

    /**
     * INVOICE RETURN STORE
     */
    public function invoiceReturnStore(Request $request, $id){
        $invoice = Invoice::findOrFail($id);
        $invoice->status = '3';
        $invoice->updated_by  = Auth::user()->id;

        DB::transaction(function() use($request, $invoice, $id){
            foreach($request->selling_qty as $key => $val){
                $invoice_details =  InvoiceDetail::where('id', $key)->first();
                $product = Product::where('id', $invoice_details->product_id)->first();
                $product->quantity = ((float)$product->quantity) + ((float)$request->selling_qty[$key]);
                $product->save();
            }
        });

        $result = $invoice->update();

        if($result){
            sweetalert()->success('Sales Return Successfully!');
            return redirect()->route('invoice.all');
        }
    }

    /**
     * INVOICE RETURNED
     */
    public function invoiceReturned(){
        $allData = Invoice::orderBy('date', 'DESC')->orderBy('id', 'DESC')->where('status', '3')->get();
        return view('backend.invoice.invoice_returned', compact('allData'));
    }


    /**
     * INVOICE DETAILS
     */
    public function invoiceDetails($id){
        $invoice = Invoice::with('invoice_details')->findOrFail($id);
        $payment = Payment::where('invoice_id', $id)->first();
        return view('backend.invoice.invoice_details', compact('invoice', 'payment'));
    }

    /**
     * DAILY INVOICE REPORT
     */
    public function dailyInvoiceReport(){
        return view('backend.invoice.daily_invoice_report');
    } // Daily Invoice Report

    /**
     * DAILY INVOICE PDF
     */

     public function dailyInvoicePdf(Request $request){
        $start_date = date('Y-m-d', strtotime($request->start_date));
        $end_date = date('Y-m-d', strtotime($request->end_date));
        $allData = Invoice::whereBetween('date', [$start_date, $end_date])->where('status', '2')->get();
        return view('backend.invoice.invoice_daily_report_pdf', compact('allData', 'start_date', 'end_date'));
     }

}
