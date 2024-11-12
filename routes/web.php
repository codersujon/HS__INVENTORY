<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\CourierController;
use App\Http\Controllers\Pos\CustomerController;
use App\Http\Controllers\Pos\SupplierController;
use App\Http\Controllers\Pos\UnitController;
use App\Http\Controllers\Pos\CategoryController;
use App\Http\Controllers\Pos\ProductController;
use App\Http\Controllers\Pos\PurchaseController;
use App\Http\Controllers\Pos\InvoiceController;
use App\Http\Controllers\Pos\StockController;
use App\Http\Controllers\Pos\ShelfController;
use App\Http\Controllers\Pos\PdfController;
use App\Models\CourierApi;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Customer;
use App\Models\Category;
use App\Models\Invoice;
use App\Models\User;



Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    $id = Auth::user()->id;
    $adminData  = User::find($id);
    $products = Product::all();
    $suppliers = Supplier::all();
    $customers = Customer::all();
    $category = Category::all();


    $today = now()->format('Y-m-d');
    $invoices = Invoice::whereDate('date', $today)->get();
    $allData =  Invoice::whereDate('date', $today)->orderBy('created_at', 'DESC')->limit(7)->get();

    return view('backend.index', compact('adminData', 'products', 'suppliers', 'customers', 'category', 'allData', 'invoices'));
})->middleware(['auth', 'verified'])->name('dashboard');


/**
 * PDF AND PRINT CONTROLLER
 */
Route::get('generate-pdf', [PdfController::class, 'generatePdf'])->name('generate-pdf');

Route::controller(PdfController::class)->group(function(){
    Route::get('/invoice/print/{id}', 'invoicePrint')->name('invoice.print');
});


/**
 * MANAGE STOCK
 */
Route::middleware('auth')->group(function(){
    Route::controller(StockController::class)->group(function(){
        Route::get('/stock/report', 'StockReport')->name('stock.report');
        Route::get('/stock/report/print', 'StockReportPrint')->name('stock.report.print');
        Route::get('/stock/supplier/wise', 'StockSupplierWise')->name('stock.supplier.wise');
        Route::post('/supplier/wise/pdf', 'SupplierWisePdf')->name('supplier.wise.pdf');
        Route::post('/product/wise/pdf', 'ProductWisePdf')->name('product.wise.pdf');
    });
});

/**
 * MANAGE INVOICE
 */
Route::middleware('auth')->group(function(){
    Route::controller(InvoiceController::class)->group(function(){
        Route::get('/invoice/all', 'index')->name('invoice.all');
        Route::get('/invoice/add', 'create')->name('invoice.add');
        Route::get('/get-product-stock', 'getProductStock')->name('get-product-stock');
        Route::post('/invoice/store', 'store')->name('invoice.store');
        Route::get('/invoice/details/{id}', 'invoiceDetails')->name('invoice.details');
        Route::get('/invoice/pending', 'invoicePending')->name('invoice.pending');
        Route::get('/invoice/approve/{id}', 'invoiceApprove')->name('invoice.approve');
        Route::get('/invoice/deliver/{id}', 'invoiceDeliver')->name('invoice.deliver');
        Route::post('/invoice/deliverable/{id}', 'invoiceDeliverableStore')->name('invoice.deliverable.store');
        Route::get('invoice/on/delivery', 'onDelivery')->name('invoice.on.delivery');
        Route::get('invoice/delivered', 'invoiceDelivered')->name('invoice.delivered');
        Route::get('/invoice/destroy/{id}', 'invoiceDestroy')->name('invoice.destroy');
        Route::post('/invoice/approval/{id}', 'invoiceApprovalStore')->name('invoice.approval.store');
        Route::get('/daily/invoice/report', 'dailyInvoiceReport')->name('daily.invoice.report');
        Route::get('/daily/invoice/pdf', 'dailyInvoicePdf')->name('daily.invoice.pdf');
        // Invoice Return
        Route::get('/invoice/return/{id}', 'invoiceReturn')->name('invoice.return');
        Route::post('/invoice/return/store/{id}', 'invoiceReturnStore')->name('invoice.return.store');
        Route::get('/invoice/returned', 'invoiceReturned')->name('invoice.returned'); 

        // Bluk Order Create
        Route::get('/bulk-courier/{slug}', 'bulk_courier')->name('bulk_courier');
    });
});


/**
 * COURIER API MANAGEMENT
 */
Route::middleware('auth')->group(function(){
    Route::controller(CourierController::class)->group(function(){
        Route::get('/courier/api', 'index')->name('courier.api');
    });
});



/**
 * MANAGE PURCHASE
 */
Route::middleware('auth')->group(function(){
    Route::controller(PurchaseController::class)->group(function(){
        Route::get('/purchase/all', 'index')->name('purchase.all');
        Route::get('/purchase/create', 'create')->name('purchase.create');
        Route::post('/purchase/store', 'store')->name('purchase.store');
        Route::get('/purchase/delete/{id}', 'destroy')->name('purchase.delete');

        Route::get('/get-category', 'getCategory')->name('get-category');
        Route::get('/get-product', 'getProduct')->name('get-product');

        Route::get('/purchase/pending', 'purchasePending')->name('purchase.pending');
        Route::get('/purchase/approve/{id}', 'purchaseApprove')->name('purchase.approve');
        Route::get('/daily/purchase/report', 'dailyPurchaseReport')->name('daily.purchase.report');
        Route::get('daily/purchase/pdf', 'dailyPurchasePdf')->name('daily.purchase.pdf');

    });
});

/**
 * MANAGE PRODUCT
 */
Route::middleware('auth')->group(function(){
    Route::controller(ProductController::class)->group(function(){
        Route::get('/product/all', 'index')->name('product.all');
        Route::get('/product/add', 'create')->name('product.create');
        Route::post('/product/store', 'store')->name('product.store');
        Route::get('/product/edit/{id}', 'edit')->name('product.edit');
        Route::post('/product/update/{id}', 'update')->name('product.update');
        Route::get('/product/delete/{id}', 'destroy')->name('product.delete');
    });
});

/**
 * MANAGE CATEGORY
 */
Route::middleware('auth')->group(function(){
    Route::controller(CategoryController::class)->group(function(){
        Route::get('/category/all', 'index')->name('category.all');
        Route::get('/category/add', 'create')->name('category.create');
        Route::post('/category/store', 'store')->name('category.store');
        Route::get('/category/edit/{id}', 'edit')->name('category.edit');
        Route::post('/category/update/{id}', 'update')->name('category.update');
        Route::get('/category/delete/{id}', 'destroy')->name('category.delete');
    });
});

/**
 * MANAGE UNITS
 */
Route::middleware('auth')->group(function(){
    Route::controller(UnitController::class)->group(function(){
        Route::get('/unit/all', 'index')->name('unit.all');
        Route::get('/unit/add', 'create')->name('unit.create');
        Route::post('/unit/store', 'store')->name('unit.store');
        Route::get('/unit/edit/{id}', 'edit')->name('unit.edit');
        Route::post('/unit/update/{id}', 'update')->name('unit.update');
        Route::get('/unit/delete/{id}', 'destroy')->name('unit.delete');
    });
});

/**
 * MANAGE CUSTOMER
 */
Route::middleware('auth')->group(function(){
    Route::controller(CustomerController::class)->group(function(){
        Route::get('/customer/all', 'index')->name('customer.all');
        Route::get('/customer/add', 'create')->name('customer.create');
        Route::post('/customer/store', 'store')->name('customer.store');
        Route::get('/customer/show/{id}', 'show')->name('customer.show');
        Route::get('/customer/edit/{id}', 'edit')->name('customer.edit');
        Route::post('/customer/update/{id}', 'update')->name('customer.update');
        Route::get('/customer/delete/{id}', 'destroy')->name('customer.delete');
    });
});

/**
 * MANAGE SUPPLIERS
 */
Route::middleware('auth')->group(function(){
    Route::controller(SupplierController::class)->group(function(){
        Route::get('/supplier/all', 'index')->name('supplier.all');
        Route::get('/supplier/add', 'create')->name('supplier.create');
        Route::post('/supplier/store', 'store')->name('supplier.store');
        Route::get('/supplier/show/{id}', 'show')->name('supplier.show');
        Route::get('/supplier/edit/{id}', 'edit')->name('supplier.edit');
        Route::post('/supplier/update/{id}', 'update')->name('supplier.update');
        Route::get('/supplier/delete/{id}', 'destroy')->name('supplier.delete');
    });
});


/**
 * MANAGE SHELVES
 */
Route::middleware('auth')->group(function(){
    Route::controller(ShelfController::class)->group(function(){
        Route::get('/shelves/all', 'index')->name('shelves.all');
        Route::get('/shelves/add', 'create')->name('shelves.create');
        Route::post('/shelves/store', 'store')->name('shelves.store');
        Route::get('/shelves/edit/{id}', 'edit')->name('shelves.edit');
        Route::post('/shelves/update/{id}', 'update')->name('shelves.update');
        Route::get('/shelves/delete/{id}', 'destroy')->name('shelves.delete');
    });
});

/**
 * MANAGE USER PROFILE
 */
Route::middleware('auth')->group(function () {
    Route::get('/admin/profile', [ProfileController::class, 'Profile'])->name('admin.profile');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/change/password', [ProfileController::class, 'changePassword'])->name('change.password');
    Route::post('/update/password', [ProfileController::class, 'updatePassword'])->name('update.password');
});

require __DIR__.'/auth.php';
