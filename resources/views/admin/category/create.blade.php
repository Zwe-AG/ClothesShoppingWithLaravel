@extends('admin.layouts.master')
@section('content')
 <!-- MAIN CONTENT-->
 <div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3 offset-8">
                    <a href="{{ route('category#listpage') }}"><button class="btn bg-dark text-white my-3">List Page</button></a>
                </div>
            </div>
            <div class="col-lg-4 offset-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Create Category</h3>
                        </div>
                        <hr>
                        <form action="{{ route('categoty#create') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1"></label>
                                <input id="cc-pament" name="name" type="text" class="form-control" placeholder="Enter Create Category...." required>
                            </div>
                            <div class="d-grid mt-3">
                                <button  type="submit" class="btn btn-lg btn-info btn-block text-white">
                                    <i class="fa-solid fa-plus ms-1"></i> Create
                                </button>
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
