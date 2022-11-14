@extends('user.layouts.master')

@section('content')
<div class="container-fluid px-2 px-md-4">
    <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
      <span class="mask  bg-gradient-primary  opacity-6"></span>
    </div>
    <div class="card card-body mx-3 mx-md-4 mt-n6">
      <div class="row gx-4 mb-2">
        <div class="col-auto">
          <div class="avatar avatar-xl position-relative">
            @if (Auth::user()->image == null)
                @if (Auth::user()->gender == 'male')
                    <img src="{{ asset('image/defaultimg.jpeg') }}" class="border-radius-lg shadow-sm" style="height:70px;object-fit:cover"/>
                @else
                <img src="{{ asset('image/female.jpeg') }}" class="w-100 border-radius-lg shadow-sm" style="height:70px;object-fit:cover"/>
                @endif
                @else
                <img src="{{ asset('storage/'.Auth::user()->image) }}"  class="border-radius-lg shadow-sm" style="height:70px;object-fit:cover"/>
            @endif
          </div>
        </div>
        <div class="col-auto my-auto">
          <div class="h-100">
            <h5 class="mb-1">
              {{ Auth::user()->name }}
            </h5>
            <p class="mb-0 font-weight-normal text-sm">
                {{ Auth::user()->role }}
            </p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="row">
          <div class="col-12 col-xl-6">
            <div class="card card-plain h-100">
              <div class="card-header p-3">
                <h6>Password Change Settings</h6>
              </div>
              <div class="card-body p-3">
                <form action="{{ route('user#passwordchange') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="cc-payment" class="control-label mb-1">Old Password</label>
                        <input id="cc-pament" name="oldPassword" type="password" class="form-control @if(session('notMatch')) is-invalid @endif @error('oldPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Old Password....">
                        @error('oldPassword')
                           <div class="invalid-feedback">
                              {{ $message }}
                           </div>
                        @enderror
                        @if(session('notMatch'))
                        <div class="invalid-feedback">
                            {{ session('notMatch') }}
                         </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="cc-payment" class="control-label mb-1">New Password</label>
                        <input id="cc-pament" name="newPassword" type="password" class="form-control mb-2 @error('newPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter New Password....">
                        @error('newPassword')
                           <div class="invalid-feedback">
                              {{ $message }}
                           </div>

                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="cc-payment" class="control-label mb-1">Confirm Password</label>
                        <input id="cc-pament" name="confirmPassword" type="password"  class="form-control mb-3 @error('confirmPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Confirm Password....">
                        @error('confirmPassword')
                           <div class="invalid-feedback">
                              {{ $message }}
                           </div>

                        @enderror
                    </div>
                    <div>
                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block text-white">
                            <i class="fa-solid fa-key"></i> Change Password
                        </button>
                    </div>
                </form>
              </div>
            </div>
          </div>
          <div class="col-12 col-xl-6">
            <div class="card card-plain h-100">
              <div class="card-header pb-0 p-3">
                <div class="row">
                  <div class="col-md-8 d-flex align-items-center">
                    <h6 class="mb-0">Profile Information</h6>
                  </div>
                  <div class="col-md-4 text-end">
                    <a href="{{ route('user#editprofile',Auth::user()->id) }}">
                      <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Profile"></i>
                    </a>
                  </div>
                </div>
              </div>
              <div class="card-body p-3">
                <p class="text-sm">
                  Hi, I’m {{ Auth::user()->name }}, Decisions: If you can’t decide, the answer is no. If two equally difficult paths, choose the one more painful in the short term (pain avoidance is creating an illusion of equality).
                </p>
                <hr class="horizontal gray-light my-4">
                <ul class="list-group">
                  <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Full Name:</strong> &nbsp; {{ Auth::user()->name }}</li>
                  <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Mobile:</strong> &nbsp;  {{ Auth::user()->phone }}</li>
                  <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong> &nbsp; {{ Auth::user()->email }}</li>
                  <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Location:</strong> &nbsp;  {{ Auth::user()->address }}</li>
                  <li class="list-group-item border-0 ps-0 pb-0">
                    <strong class="text-dark text-sm">Social:</strong> &nbsp;
                    <a class="btn btn-facebook btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                      <i class="fab fa-facebook fa-lg"></i>
                    </a>
                    <a class="btn btn-twitter btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                      <i class="fab fa-twitter fa-lg"></i>
                    </a>
                    <a class="btn btn-instagram btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                      <i class="fab fa-instagram fa-lg"></i>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
@endsection
