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
                            <h3 class="text-center title-2">Account Profile</h3>
                        </div>
                        <hr>

                        <form action="{{ route('admin#update',Auth::user()->id ) }}" method="POST" enctype="multipart/form-data" >
                            @csrf
                            <div class="row">
                                <div class="col-4 offset-1">
                                    @if (Auth::user()->image == null)
                                        @if (Auth::user()->gender == 'male')
                                            <img src="{{asset('image/default_user.png')}}" class="img-thumbnail shadow-sm" />
                                        @else
                                            <img src="{{asset('image/female_user.png')}}" class="img-thumbnail shadow-sm" />
                                        @endif
                                    @else
                                        <img src="{{asset('storage/'.Auth::user()->image)}}" class="img-thumbnail shadow-sm" />
                                    @endif

                                    <div class="mt-3 @error('email') is-invalid @enderror">
                                        <input type="file" class="form-control" name="image">
                                        @error('image')
                                            <p class="text-danger">
                                                {{$message}}
                                            </p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row col-6">
                                    <div class="form-group">
                                        <label class="control-label mb-1">Name</label>
                                        <input id="cc-pament" name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name',Auth::user()->name) }}" aria-required="true" aria-invalid="false" placeholder="Enter your name">
                                    </div>
                                    @error('name')
                                    <p class="text-danger">
                                        {{$message}}
                                    </p>
                                    @enderror

                                    <div class="form-group">
                                        <label class="control-label mb-1">Email</label>
                                        <input id="cc-pament" name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email',Auth::user()->email) }}" aria-invalid="false" placeholder="Enter your email">
                                    </div>
                                    @error('email')
                                    <p class="text-danger">
                                        {{$message}}
                                    </p>
                                    @enderror


                                    <div class="form-group">
                                        <label class="control-label mb-1">Phone</label>
                                        <input id="cc-pament" name="phone" type="number" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone',Auth::user()->phone) }}" aria-invalid="false" placeholder="Enter your phone">
                                    </div>
                                    @error('phone')
                                    <p class="text-danger">
                                        {{$message}}
                                    </p>
                                    @enderror


                                    <div class="form-group">
                                        <label class="control-label mb-1">Gender</label>
                                        <select name="gender" id="" class="form-control @error('gender') is-invalid @enderror">
                                            <option value="">Choose Gender...</option>
                                            <option value="male" @if (Auth::user()->gender == 'male') selected @endif>Male</option>
                                            <option value="female" @if (Auth::user()->gender == 'female') selected @endif>Female</option>
                                        </select>
                                    </div>
                                    @error('gender')
                                    <p class="text-danger">
                                        {{$message}}
                                    </p>
                                    @enderror


                                    <div class="form-group">
                                        <label class="control-label mb-1">Address</label>
                                        <textarea name="address" id="" cols="30" rows="10" class="form-control @error('address') is-invalid @enderror"  placeholder="Enter your address">{{ old('address',Auth::user()->address) }}</textarea>
                                    </div>
                                    @error('address')
                                    <p class="text-danger">
                                        {{$message}}
                                    </p>
                                    @enderror


                                    <div class="form-group">
                                        <label class="control-label mb-1">Role</label>
                                        <input id="cc-pament" name="role" type="text" class="form-control @error('role') is-invalid @enderror" value="{{ old('role',Auth::user()->role) }}" disabled aria-required="true" aria-invalid="false" placeholder="Enter Name">
                                    </div>
                                    @error('role')
                                    <p class="text-danger">
                                        {{$message}}
                                    </p>
                                    @enderror


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
