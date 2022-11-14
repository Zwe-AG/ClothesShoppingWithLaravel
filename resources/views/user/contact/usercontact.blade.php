@extends('user.layouts.master')

@section('content')
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-2 offset-10">
                    <a href="{{ route('user#home') }}"> <button class="btn bg-dark text-white my-3"><i class="fa-solid fa-arrow-left me-2"></i>Your Profile</button></a>
                </div>
            </div>
            <div class="col-lg-6 offset-3">

              <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2" style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">Contact Us</h3>
                        </div>

                        <form action="{{ route('user#contactcreate') }}" method="POST">
                            @csrf
                            <div class="row mt-4">
                                <div class="row col-12">
                                    <div class="form-group mb-2 col-12">
                                        <label for="cc-payment" class="control-label mb-1">Name</label>
                                        <input id="cc-pament" name="name" type="text" value="{{ old('name',Auth::user()->name) }}" class="form-control @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Admin Name">
                                        @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-2 col-12">
                                        <label for="cc-payment" class="control-label mb-1">Email</label> <br>
                                        <input id="cc-pament" name="email" type="email" value="{{ old('email',Auth::user()->email) }}"  class="form-control @error('email') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Admin Email">
                                        @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-2 col-12">
                                        <label for="cc-payment" class="control-label mb-1">Message</label> <br>
                                        <textarea name="message" cols="85" rows="5"></textarea>
                                        @error('message')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-dark text-white form-control py-2"> <i class="fa-regular fa-paper-plane me-2"></i> Send Me </button>
                                    </div>
                                </div>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection

