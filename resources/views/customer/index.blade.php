@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Customers</div>
                <div class="card-body">

                  <div class="row justify-content-center">
                    <div class="col-md-8">
                      <form action="{{ route('customer.store') }}" method="post">
                    @csrf

                    <div class="form-group">
                      <input type="text" name="name" class="form-control" placeholder="name">
                    </div>
                    <div class="form-group">
                      <input type="email" name="email" class="form-control" placeholder="email">
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                       <div class="form-group">
                        <input type="text" name="terms" class="form-control" placeholder="terms">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                          <input type="text" name="contact_amount" class="form-control" placeholder="contact amount">
                        </div>
                    </div>
                    </div>

                    <div class="form-group">
                      <select name="company" class="form-control">
                      @foreach($companies as $company)
                        
                        <option value="{{$company->name}}">{{ $company->name }}</option>
                
                      @endforeach
                      </select>
                    </div>

                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    </div>

                  </form>
                    </div>
                  </div>

                  <hr>

                  <div class="row justify-content-center">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>SL</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Companny</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($customers as $key => $customer)
                        
                        <tr>
                          <td>{{ $key + 1 }}</td>
                          <td>{{ $customer->name }}</td>
                          <td>{{ $customer->email }}</td>
                          <td>{{ $customer->company }}</td>
                        </tr>

                      @endforeach
                      </tbody>
                    </table>
                  </div>



                </div>
            </div>
        </div>
    </div>
</div>
@endsection
