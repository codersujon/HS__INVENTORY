<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

date_default_timezone_set('Asia/Dhaka');

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::latest()->get();
        return view('backend.customer.customer_all', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.customer.customer_add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $customer = new Customer();
        $customer->customer_name = ucwords($request->customerN);
        $customer->c_phone = $request->c_phone;
        $customer->c_dob = $request->c_dob;
        $customer->c_email = strtolower($request->c_email);
        $customer->c_gender = ucfirst($request->c_gender);
        $customer->address = $request->address;

         // FOR IMAGE UPDATE
         $customName ="";
        if($request->file('c_image')){
            $file = $request->file('c_image');
            $customName =  date('YmdHi').'.'.$file->getClientOriginalExtension();
            //Image Intervention Package Use
            $manager = new ImageManager(new Driver());
            $file = $manager->read($file); // File Read
            $file->resize(130, 70)->save('upload/customer/'.$customName); // Resize and save

        }else{
            $customName =  $customer->c_image;
        }

        $customer->c_image = $customName;
        $result = $customer->save();

        if($result){
            sweetalert()->timer(800)->success('Customer Added Successfully!');
        }else{
            sweetalert()->timer(800)->error('Customer not added!');
        }

        return redirect()->route('customer.all');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $customer = Customer::findOrFail($id);
        return view('backend.customer.single_customer', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $customer = Customer::findOrFail($id);
        return view('backend.customer.customer_edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $customer = Customer::findOrFail($id);
        // FOR IMAGE UPDATE
        $customName ="";
        if($request->file('c_image')){
            $file = $request->file('c_image');
            $customName =  date('YmdHi').'.'.$file->getClientOriginalExtension();
            @unlink(public_path('upload/customer/'.$customer->c_image));
            $manager = new ImageManager(new Driver());
            $file = $manager->read($file); // File Read
            $file->resize(130, 70)->save('upload/customer/'.$customName); // Resize and save

        }else{
            $customName =  $customer->c_image;
        }

        $result = Customer::findOrFail($id)->update([
            'customer_name' => ucwords($request->customerN),
            'c_phone' => $request->c_phone,
            'c_dob' => $request->c_dob,
            'c_email' => strtolower($request->c_email),
            'c_gender' => ucfirst($request->c_gender),
            'address' => $request->address,
            'c_image' => $customName,
            'updated_at' => now(),
        ]);


        if($result){
            sweetalert()->timer(800)->success('Customer Updated Successfully!');
        }else{
            sweetalert()->timer(800)->error('Customer not Updated!');
        }

        return redirect()->route('customer.all');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $customer = Customer::findOrFail($id);
        @unlink(public_path('upload/customer/'.$customer->c_image));
        $result = Customer::findOrFail($id)->delete();

        if($result){
            notyf()->position('y', 'top')->duration(1000)->success('Customer Deleted Successfully!');
        }else{
            notyf()->position('y', 'top')->duration(1000)->error('Customer not Deleted!');
        }

        return redirect()->back();
    }
}
