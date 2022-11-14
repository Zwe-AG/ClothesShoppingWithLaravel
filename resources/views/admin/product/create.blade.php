@extends('admin.layouts.master')
@section('content')
 <!-- MAIN CONTENT-->
 <div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3 offset-8">
                    <a href="{{ route('product#listpage') }}"><button class="btn bg-dark text-white my-3">List Page</button></a>
                </div>
            </div>
            <div class="col-lg-4 offset-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Create Product</h3>
                        </div>
                        <hr>

                        <form action="{{ route('product#create') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                                <div class="form-group mb-2">
                                        <label for="cc-payment" class="control-label mb-1">Name</label>
                                        <input id="cc-pament" name="name" type="text" class="form-control @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Product Name">
                                        @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                </div>
                                    <div class="form-group">
                                        <div class="mt-2">
                                            <label for="cc-payment" class="control-label mb-1">Image</label>
                                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                                        </div>
                                        @error('image')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="cc-payment" class="control-label mb-1">Description</label>
                                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" cols="30" rows="10"></textarea>
                                        @error('description')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="cc-payment" class="control-label mb-1">Price</label>
                                        <input id="cc-pament" name="price" type="number" class="form-control @error('price') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Admin Phone">
                                        @error('price')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Category Id</label>
                                        <select name="categoryProduct" id="" class="form-control @error('categoryProduct') is-invalid @enderror">
                                            <option value="">Choose Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('categoryProduct')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="d-grid">
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
