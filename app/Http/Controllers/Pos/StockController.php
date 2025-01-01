<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Unit;
use App\Models\Category;
use App\Models\Product;
use App\Models\Purchase;
use PDF;

class StockController extends Controller
{
    /**
     * Stock Report
     */
    public function StockReport()
    {
       $allData = Purchase::select('product_id', 'unit_price')->distinct()
                    ->with('product')->get();
       return view('backend.stock.stock_report', compact('allData'));
    }

    /**
     * Stock Report Print
     */
    public function StockReportPrint()
    {
        $allData = Purchase::select('product_id', 'unit_price')->distinct()
                    ->with(['product:id,product_name,product_sku,quantity'])->get();
                    
        $pdf = PDF::loadView('backend.stock.stock_report_print', compact('allData'));
        return $pdf->stream('Stock Report.pdf');
    }

    /**
     * Stock Supplier Wise
     */
    public function StockSupplierWise()
    {
        $suppliers = Supplier::all();
        $category =  Category::all();
        return view('backend.stock.supplier_product_wise_report', compact('suppliers', 'category'));
    }

    /**
     * Supplier Wise Pdf
     */
    public function SupplierWisePdf(Request $request)
    {
        $allData = Product::orderBy('supplier_id', 'ASC')->orderBy('category_id', 'ASC')->where('supplier_id', $request->supplier_id)->get();
        return view('backend.stock.supplier_wise_report_pdf', compact('allData'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function ProductWisePdf(Request $request)
    {
        $product = Product::where('category_id', $request->category_id)->where('id', $request->product_id)->first();
        return view('backend.stock.product_wise_report_pdf', compact('product'));
    }

}
