<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use URL;
use View;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

use App\Models\Customer;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $custData = Customer::orderBy('id','desc')->get();
        return view('customer', compact('custData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customer');
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'nullable|email',
            'phone' => 'nullable|regex:/^\d{10}$/',
        ]);
    
        if(!empty($request->id)){
            $customer = Customer::find($request->id);
            $msg = 'Customer updated successfully.';
        } else {
            $customer = new Customer;
            $msg = 'Customer added successfully.';
        }
        $customer->first_name = $request->first_name;
        $customer->last_name = $request->last_name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->save();

        return redirect()->route('customers.index')->with('customersuccess', $msg);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $custData = Customer::orderBy('id','desc')->get();

        $updData = Customer::where('id' , $id)->first();
        return View::make('customer', [
            'custData' => $custData,
            'ban' => $updData,
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        $msg = 'Customer deleted successfully.';
        return redirect()->route('customers.index')->with('deletesuccess', $msg);
    }
}
