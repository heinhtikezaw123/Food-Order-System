@extends('admin.layouts.master')

@section('title','Category List Page')

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Update Pizza</h3>
                        </div>

                        <div class="ms-5">
                            <i class="fa-solid fa-arrow-left" onclick="history.back()"></i>
                        </div>

                        <form action="{{ route('product#update') }}" method="POST" enctype="multipart/form-data" >
                            @csrf
                            <div class="row">
                                <div class="col-4 offset-1">
                                    <input type="hidden" name="pizzaId" value="{{ $pizza->id }}">
                                    <img src="{{asset('storage/'.$pizza->image)}}" class="img-thumbnail" />

                                    <div class="mt-3 ">
                                        <input type="file" class="form-control  @error('pizzaImage') is-invalid @enderror" name="pizzaImage">
                                        @error('pizzaImage')
                                            <p class="text-danger">
                                                {{$message}}
                                            </p>_
                                        @enderror
                                    </div>
                                </div>



                                <div class="row col-6">
                                    <div class="form-group">
                                        <label class="control-label mb-1">Name</label>
                                        <input id="cc-pament" name="pizzaName" type="text" class="form-control @error('pizzaName') is-invalid @enderror" value="{{ old('pizzaName',$pizza->name) }}" aria-required="true" aria-invalid="false" placeholder="Enter Pizza Name">
                                    </div>
                                    @error('pizzaName')
                                    <p class="text-danger">
                                        {{$message}}
                                    </p>
                                    @enderror

                                    <div class="form-group">
                                        <label class="control-label mb-1">Description</label>
                                        <textarea name="pizzaDescription" id="" cols="30" rows="10" class="form-control @error('pizzaDescription') is-invalid @enderror"  placeholder="Enter pizza description">{{ old('pizzaDescription',$pizza->description) }}</textarea>
                                    </div>
                                    @error('pizzaDescription')
                                    <p class="text-danger">
                                        {{$message}}
                                    </p>
                                    @enderror

                                    <div class="form-group">
                                        <label class="control-label mb-1">Category</label>
                                        <select name="pizzaCategory" id="" class="form-control @error('pizzaCategory') is-invalid @enderror">
                                            <option value="">Choose pizza category...</option>
                                            @foreach ($category as $c )
                                                <option value="{{ $c->id }}" @if ($pizza->category_id == $c->id) selected @endif>{{ $c->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('pizzaCategory')
                                    <p class="text-danger">
                                        {{$message}}
                                    </p>
                                    @enderror

                                    <div class="form-group">
                                        <label class="control-label mb-1">Price</label>
                                        <input id="cc-pament" name="pizzaPrice" type="number" class="form-control @error('pizzaPrice') is-invalid @enderror" value="{{ old('pizzaPrice',$pizza->price) }}" aria-required="true" aria-invalid="false" placeholder="Enter pizza price">
                                    </div>
                                    @error('pizzaPrice')
                                    <p class="text-danger">
                                        {{$message}}
                                    </p>
                                    @enderror

                                    <div class="form-group">
                                        <label class="control-label mb-1">Waiting Time</label>
                                        <input id="cc-pament" name="pizzaWaitingTime" type="number" class="form-control @error('pizzaWaitingTime') is-invalid @enderror" value="{{ old('pizzaWaitingTime',$pizza->waiting_time) }}" aria-required="true" aria-invalid="false" placeholder="Enter pizza waiting time">
                                    </div>
                                    @error('pizzaWaitingTime')
                                    <p class="text-danger">
                                        {{$message}}
                                    </p>
                                    @enderror

                                    <div class="form-group">
                                        <label class="control-label mb-1">View Count</label>
                                        <input id="cc-pament" name="viewCount" type="number" disabled class="form-control" value="{{ old('viewCount',$pizza->view_count) }}" aria-required="true" aria-invalid="false" >
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label mb-1">Created Date</label>
                                        <input id="cc-pament" name="createdAt" type="text" class="form-control" value="{{ $pizza->created_at->format('j-F-Y') }}" disabled aria-required="true" aria-invalid="false">
                                    </div>

                                    <div class="mt-3 col-5 offset-7">
                                        <button type="submit" class="btn bg-dark text-white w-100">
                                           <i class="fa-solid fa-circle-chevron-right me-1"></i> Update
                                        </button>
                                    </div>
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection
