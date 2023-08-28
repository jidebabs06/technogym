@extends('admin.layouts.main')

@section('content')
          @if ($message = Session::get('success'))
              <div class="alert alert-success">
                  <p>{{ $message }}</p>
              </div>
          @endif
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <div class="container text-center pt-5">
                    <h2 class="mb-3 mt-5">Available Membership Plans</h2>
                    <p class="w-75 mx-auto mb-5">Choose a plan that suits you the best. If you are not fully satisfied, we offer 30-day money-back guarantee no questions asked!!</p>
                    <div class="row pricing-table">

                        @foreach($allPlans as $plan)
                        @if($plan->status == "1")
                      <div class="col-md-4 col-xl-4 grid-margin stretch-card pricing-card">
                        <div class="card border-primary border pricing-card-body">
                          <div class="text-center pricing-card-head">
                            <h3>{{$plan->plan_name}}</h3>
                            <p>Premium</p>
                            <h1 class="font-weight-normal mb-4">{{$plan->plan_price}}</h1>
                          </div>
                          <ul class="list-unstyled plan-features">
                            <li>{{$plan->plan_details}}</li>
                            <li>Spam testing and blocking</li>
                            <li>10 GB Space</li>
                            <li>50 user accounts</li>
                            <li>Free support for one years</li>
                            <li>Duration: {{$plan->duration}} Days</li>
                          </ul>
                          <div class="wrapper">
                            <a href="{{ url('/subscribe')}}/{{$plan->id }}" class="btn btn-outline-primary btn-block">Subscribe</a>
                          </div>
                        </div>
                      </div>
                      @endif
                      @endforeach
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <!-- content-wrapper ends -->
@endsection
