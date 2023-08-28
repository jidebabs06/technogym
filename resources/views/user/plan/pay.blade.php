@extends('admin.layouts.main')

@section('content')
          @if ($message = Session::get('success'))
              <div class="alert alert-success">
                  <p>{{ $message }}</p>
              </div>
          @endif
          <div class="row">
            <div class="col-md-4">
              <div class="card">
                <div class="card-body">
                  <div class="container text-center pt-5">
                    <h2 class="mb-3 mt-5">Proceed to Payment</h2>
                    <p class="w-75 mx-auto mb-5">You are about to make payment for the {{ $selectedPlan->plan_name }} Plan. We use a secured payment gateway</p>
                    <div class="row pricing-table">
                      <div class="col-md-12 col-xl-12 grid-margin stretch-card pricing-card center">
                        <div class="card border-primary border pricing-card-body">
                          <div class="text-center pricing-card-head">
                            <h3>{{ $selectedPlan->plan_name }}</h3>
                            <p>Premium</p>
                            <h1 class="font-weight-normal mb-4">{{ $selectedPlan->plan_price }}</h1>
                          </div>
                          <?php
                          $kobo = 100;
                          ?>
                          <form action="{{route('pay') }}" method="POST" accept-charset="UTF-8">
                            {{ csrf_field() }}
                            <input type="hidden" name="email" value="{{ Auth::user()->email }}"> {{-- required --}}
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}"
                            <input type="hidden" name="plan_id" value="{{ $selectedPlan->id }}">
                            <input type="hidden" name="amount" value="{{ $selectedPlan->plan_price * $kobo}}">
                            <input type="hidden" name="currency" value="NGN">
                            <input type="hidden" name="metadata" value="{{ json_encode($array = [
                                'plan_id' =>  $selectedPlan->id]) }}" >
                            <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> {{-- required --}}
                            <div class="wrapper">
                                <button type="submit" class="btn btn-outline-primary btn-block" value="Pay Now!">Pay</a>
                              </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <!-- content-wrapper ends -->
@endsection
