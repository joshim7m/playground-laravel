<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\NewCustomerRegisteredEvent;

use App\Customer;
use App\Company;

class CustomerController extends Controller
{
    public function index(){

      $customers = Customer::orderBy('id', 'desc')->get();
      $companies = Company::orderBy('id', 'desc')->get();

      return view('customer.index', compact('companies', 'customers'));
    }

    public function store(Request $request){

      $customer = new Customer;
      $customer->name = $request->name;
      $customer->email = $request->email;
      $customer->company = $request->company;
      $customer->save();

      event(new NewCustomerRegisteredEvent($customer));


      // // Register to newsletter

      // dump('Restigter to newsletter');

      // // slack notification to amdin

      // dump('slack notification to admin');

      // return redirect()->route('customer.index');

    }
}
