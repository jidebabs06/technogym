@extends('admin.layouts.main')

@section('content')
<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card tale-bg">
            <div class="card-people mt-auto">
                <img src="admin/images/dashboard/people.svg" alt="people">
                <div class="weather-info">
                    <div class="d-flex">
                        <div class="ml-2">
                            <h4 class="location font-weight-normal">Welcome {{ Auth::user()->name }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @can('isAdmin')
    <div class="col-md-6 grid-margin transparent">
        <div class="row">
            <div class="col-md-6 mb-4 stretch-card transparent">
                <div class="card card-tale">
                    <div class="card-body">
                        <p class="mb-4">All Registered Users</p>
                        <p class="fs-30 mb-2"><span>{{ $allUsers->count() }}</span></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4 stretch-card transparent">
                <div class="card card-dark-blue">
                    <div class="card-body">
                        <p class="mb-4">Total Bookings</p>
                        <p class="fs-30 mb-2">61344</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                <div class="card card-light-blue">
                    <div class="card-body">
                        <p class="mb-4">Number of Meetings</p>
                        <p class="fs-30 mb-2">34040</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 stretch-card transparent">
                <div class="card card-light-danger">
                    <div class="card-body">
                        <p class="mb-4">Number of Clients</p>
                        <p class="fs-30 mb-2">47033</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endcan

</div>
@can('isAdmin')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <p class="card-title">Registered Membership Plans</p>
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table id="order-listing" class="expandable-table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Registration Date</th>
                                        <th>Fullname</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($allUsers as $user)
                                    <tr>
                                        <td>1</td>
                                        <td>{{$user->created_at}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>
                                            <label class="badge badge-info">On hold</label>
                                        </td>
                                        @if($user->role=="0")
                                        <td>
                                            <button href="{{url('/deleteuser',$user->id)}}" class="btn btn-outline-primary">Delete</button>
                                        </td>
                                        @else
                                        <td>
                                            <button class="btn btn-outline-primary">Delete</button>
                                        </td>
                                        @endif
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
</div>
@endcan
@endsection
