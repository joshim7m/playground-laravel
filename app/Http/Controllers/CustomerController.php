<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\NewCustomerRegisteredEvent;

use App\Customer;
use App\Company;
use App\Bill;
use App\Schedule;

class CustomerController extends Controller
{
    public function index(){

      $customers = Customer::orderBy('id', 'desc')->get();
      $companies = Company::orderBy('id', 'desc')->get();

      return view('customer.index', compact('companies', 'customers'));
    }

    public function store(Request $request){

      $customer = new Customer;
      $customer->name           = $request->name;
      $customer->email          = $request->email;
      $customer->terms          = $request->terms;
      $customer->paid           = '0';
      $customer->contact_amount = $request->contact_amount;
      $customer->company        = $request->company;
      $customer->save();


      $bill = new Bill;
      $bill->customer_id  = $customer->id;
      $bill->name         = $customer->name;
      $bill->email        = $customer->email;
      $bill->status       = 'unpaid';
      $bill->amount       = $customer->contact_amount / $customer->terms;
      $bill->term         = '1';
      $bill->month        = date('M');
      $bill->date         = date('Y-m-d');
      $bill->save();

      $terms = $customer->terms;

      for($i = 0; $i < $terms; $i++){

        $cur_date = strtotime(date("Y-m-d"));

        $schedule = new Schedule;
        $schedule->bill_id            = $bill->id;
        $schedule->billing_date       = date("Y-m-d", strtotime("+".$i. "Month", $cur_date));


        $schedule->bill_creation_date = date("Y-m-d", strtotime("+".$i. "Month -3 Day", $cur_date));
        $schedule->status             = 'pending';
        $schedule->save();

      }
      
      // event(new NewCustomerRegisteredEvent($customer));


      // // Register to newsletter

      // dump('Restigter to newsletter');

      // // slack notification to amdin

      // dump('slack notification to admin');

       return redirect()->route('customer.index');

    }
}
