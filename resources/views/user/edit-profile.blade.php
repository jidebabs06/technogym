@extends('admin.layouts.main')

@section('content')
          @if ($errors->any())
              <div class="alert alert-danger">
                  <strong>Error!</strong> <br>
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif
         @if ($message = Session::get('success'))
              <div class="alert alert-success">
                  <p>{{ $message }}</p>
              </div>
          @endif
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Update Profile</h4>
                    <form class="forms-sample" action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" value="{{ $user->role_id }}" name="role_id">
                    <div class="form-group">
                      <label for="exampleInputUsername1">FullName</label>
                      <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Name" name="name" value="{{ $user->name }}">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email</label>
                      <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Price" name="email" value="{{ $user->email }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">Phone Number</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Phone Number" name="phoneno" value="{{ $user->phoneno }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">Address</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Phone Number" name="address" value="{{ $user->address }}">
                    </div>
                    @can('isAdmin')
                    <div class="form-group">
                      <label for="exampleTextarea1">Assign Role</label>
                      <select class="js-example-basic-single w-100" name="role_id">
                        <option value="{{ $user->role_id }}">Select...</option>
                      @foreach ($roles as $role)
                        <option value="{{$role->id}}">{{$role->name}}</option>
                      @endforeach
                    </select>
                    @can('isUser')
                    <input type="hidden" value="{{ $user->role_id }}" name="role_id">
                    @endcan
                    </div>
                    @endcan
                    <button type="submit" class="btn btn-primary me-2">Update Profile</button>
                  </form>
                </div>
              </div>
            </div>
        </div>
@endsection
