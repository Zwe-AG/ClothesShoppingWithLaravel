@extends('admin.layouts.master')
@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-2 offset-10">
                        <a href="{{ route('admin#profile') }}"> <button class="btn bg-dark text-white my-3"><i class="fa-solid fa-arrow-left me-2"></i>Your Profile</button></a>
                    </div>
                </div>
                <div class="col-lg-10 offset-1">

                  <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2" style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">Admin Profile</h3>
                            </div>

                            <form action="{{ route('admin#profileupdate',$admin->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row mt-4">
                                    <div class="col-4 offset-1">
                                        @if ($admin->image == null)
                                        @if ($admin->gender == 'male')
                                            <img src="{{ asset('image/defaultimg.jpeg') }}" class="img-thumbnail shadow-sm"/>
                                        @else
                                            <img src="{{ asset('image/female.jpeg') }}" class="img-thumbnail shadow-sm"/>
                                        @endif
                                        @else
                                        <img src="{{ asset('storage/'.$admin->image) }}"  class="img-thumbnail shadow-sm"/>
                                        @endif
                                        <div class="mt-2">
                                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                                        </div>
                                        @error('image')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="row col-6">
                                        <div class="form-group mb-2">
                                            <label for="cc-payment" class="control-label mb-1">Name</label>
                                            <input id="cc-pament" name="name" type="text" value="{{ old('name',$admin->name) }}" class="form-control @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Admin Name">
                                            @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="cc-payment" class="control-label mb-1">Email</label>
                                            <input id="cc-pament" name="email" type="text" value="{{ old('email',$admin->email) }}"  class="form-control @error('email') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Admin Email">
                                            @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="cc-payment" class="control-label mb-1">Phone</label>
                                            <input id="cc-pament" name="phone" type="number" value="{{ old('phone',$admin->phone) }}"  class="form-control @error('phone') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Admin Phone">
                                            @error('phone')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Gender</label>
                                            <select name="gender" id="" class="form-control @error('gender') is-invalid @enderror">
                                                <option value="">Choose Gender</option>
                                                <option value="male" @if($admin->gender == 'male') selected @endif>Male</option>
                                                <option value="female" @if($admin->gender == 'female') selected @endif>Female</option>
                                            </select>
                                            @error('gender')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="cc-payment" class="control-label mb-1">Address</label>
                                            <textarea name="address" class="form-control @error('address') is-invalid @enderror"  cols="30" rows="10" placeholder="Enter Admin Address">{{ old('address',$admin->address) }}</textarea>
                                            @error('address')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="cc-payment" class="control-label mb-1">Role</label>
                                            <input id="cc-pament" name="role" type="text" value="{{ old('role',$admin->role) }}" class="form-control" aria-required="true" aria-invalid="false" disabled>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-dark text-white form-control py-2"> <i class="fa-solid fa-pen-to-square me-2"></i> Update Profile </button>
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
