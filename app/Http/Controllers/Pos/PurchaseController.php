<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\Unit;
use App\Models\Category;
use App\Models\Product;
date_default_timezone_set('Asia/Dhaka');


class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allData = Purchase::orderBy('purchase_date', 'DESC')->orderBy('id', 'DESC')->get();
        return view('backend.purchase.purchase_all', compact('allData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $supplier = Supplier::all();
        $unit = Unit::all();
        $category = Category::all();
        return view('backend.purchase.purchase_add', compact('supplier','unit', 'category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if($request->category_id == null){
            notyf()
                ->position('x', 'right')
                ->position('y', 'top')
                ->error("Sorry! You don't select any item");

            return redirect()->back();
        }else{
            $countCategory = count($request->category_id);
            for($i = 0; $i < $countCategory;  $i++){

                // Validation Message Notification
                if($request->buying_qty[$i] == null){
                    notyf()
                        ->position('x', 'right')
                        ->position('y', 'top')
                        ->error("Product buying quantity required!");
                        return redirect()->back();
                }else if($request->unit_price[$i] == null){
                    notyf()
                    ->position('x', 'right')
                    ->position('y', 'top')
                    ->error("Product unit price required!");
                    return redirect()->back();
                }

                $purchase = new Purchase();
                $purchase->supplier_id = $request->supplier_id[$i];
                $purchase->category_id = $request->category_id[$i];
                $purchase->product_id = $request->product_id[$i];
                $purchase->purchase_date = date("Y-m-d", strtotime($request->purchase_date[$i]));
                $purchase->purchase_no = $request->purchase_no[$i];
                $purchase->buying_qty = $request->buying_qty[$i];
                $purchase->unit_price = $request->unit_price[$i];
                $purchase->buying_price = $request->buying_price[$i];
                $purchase->p_description = $request->p_description[$i];
                $purchase->created_by = Auth::user()->id;
                $purchase->created_at = now();
                $purchase->save();
            }
            sweetalert()->success('Purchase Save Successfully!');
        }

        return redirect()->route('purchase.all');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        if($id != null){
        //    sweetalert()->showCancelButton(true, "Yes, delete it!", "#d33", "You won't be able to revert this!")->error('Are you sure?');
            $result = Purchase::findOrFail($id)->delete();

            if($result){
                sweetalert()->success('Purchase Item Deleted Successfully!');
            }
        }else{
            sweetalert()->error('Purchase Item not Deleted');
        }

        return redirect()->back();
    }

    /**
     * GET CATEGORY
     */
    public function getCategory(Request $request){
        $supplier_id = $request->supplier_id;
        $allCategory = Product::with(['category'])->select('category_id')
                        ->where('supplier_id', $supplier_id)
                        ->groupBy('category_id')
                        ->get();
       return response()->json($allCategory);
    }

    /**
     * GET PRODUCT
     */
     public function getProduct(Request $request){
        $category_id = $request->category_id;
        $allProduct = Product::where('category_id', $category_id)->get();
        return response()->json($allProduct);
     }

     /**
      * PURCHASE PENDING
      */
    public function purchasePending(){

        $allData = Purchase::orderBy('purchase_date', 'DESC')->orderBy('id', 'DESC')->where('status', '0')->get();
        return view('backend.purchase.purchase_pending', compact('allData'));

    } // END PURCHASE PENDING


    /**
     * PURCHASE APPROVED
     */

    public function purchaseApprove(string $id){

        $purchase = Purchase::findOrFail($id);
        $product = Product::where('id', $purchase->product_id)->first();

        $purchase_qty =  ((float)($purchase->buying_qty)) + ((float)($product->quantity));
        $product->quantity = $purchase_qty;

        if($product->save()){
            Purchase::findOrFail($id)->update([
                "status" => '1'
            ]);

            sweetalert()->success('Purchase Approved Successfully!');

            return redirect()->back();
        }

    } // END PURCHASE APPROVED


    /**
     * DAILY PURCHASE REPORT
     */
    public function dailyPurchaseReport(){
        return view('backend.purchase.daily_purchase_report');
    } // END PURCHASE REPORT


    /**
     * DAILY PURCHASE REPORT PDF
     */
    public function dailyPurchasePdf(Request $request){
        $start_date = date('Y-m-d', strtotime($request->start_date));
        $end_date = date('Y-m-d', strtotime($request->end_date));
        $allData = Purchase::whereBetween('purchase_date', [$start_date, $end_date])->where('status', '1')->get();
        return view('backend.purchase.daily_purchase_report_pdf', compact('allData', 'start_date', 'end_date'));
    }

}
