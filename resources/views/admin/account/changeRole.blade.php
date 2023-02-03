@extends('admin.layouts.master')

@section('title','Category List Page')

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('admin#list') }}">
                            <div class="ms-5">
                                <i class="fa-solid fa-arrow-left"></i>
                            </div>
                        </a>

                        <div class="card-title">
                            <h3 class="text-center title-2">Change Role</h3>
                        </div>



                        <hr>

                        <form action="{{ route('admin#change',$account->id ) }}" method="POST" enctype="multipart/form-data" >
                            @csrf
                            <div class="row">
                                <div class="col-4 offset-1">
                                    @if ($account->image == null)
                                        @if ($account->gender == 'male')
                                            <img src="{{asset('image/default_user.png')}}" class="img-thumbnail shadow-sm" />
                                        @else
                                            <img src="{{asset('image/female_user.png')}}" class="img-thumbnail shadow-sm" />
                                        @endif
                                    @else
                                        <img src="{{asset('storage/'.$account->image)}}"  />
                                    @endif

                                </div>

                                <div class="row col-6">
                                    <div class="form-group">
                                        <label class="control-label mb-1">Name</label>
                                        <input id="cc-pament" disabled name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name',$account->name) }}" aria-required="true" aria-invalid="false" placeholder="Enter your name">
                                    </div>
                                    @error('name')
                                    <p class="text-danger">
                                        {{$message}}
                                    </p>
                                    @enderror

                                    <div class="form-group">
                                        <label class="control-label mb-1">Role</label>
                                        <select name="role" class="form-control" id="">
                                            <option value="admin" @if ($account->role == 'admin') selected @endif>Admin</option>
                                            <option value="user" @if ($account->role == 'user') selected @endif>User</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label mb-1">Email</label>
                                        <input id="cc-pament" disabled name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email',$account->email) }}" aria-invalid="false" placeholder="Enter your email">
                                    </div>
                                    @error('email')
                                    <p class="text-danger">
                                        {{$message}}
                                    </p>
                                    @enderror


                                    <div class="form-group">
                                        <label class="control-label mb-1">Phone</label>
                                        <input id="cc-pament" disabled name="phone" type="number" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone',$account->phone) }}" aria-invalid="false" placeholder="Enter your phone">
                                    </div>
                                    @error('phone')
                                    <p class="text-danger">
                                        {{$message}}
                                    </p>
                                    @enderror


                                    <div class="form-group">
                                        <label class="control-label mb-1">Gender</label>
                                        <select name="gender" disabled id="" class="form-control @error('gender') is-invalid @enderror">
                                            <option value="">Choose Gender...</option>
                                            <option value="male" @if ($account->gender == 'male') selected @endif>Male</option>
                                            <option value="female" @if ($account->gender == 'female') selected @endif>Female</option>
                                        </select>
                                    </div>
                                    @error('gender')
                                    <p class="text-danger">
                                        {{$message}}
                                    </p>
                                    @enderror


                                    <div class="form-group">
                                        <label class="control-label mb-1">Address</label>
                                        <textarea name="address" disabled id="" cols="30" rows="10" class="form-control @error('address') is-invalid @enderror"  placeholder="Enter your address">{{ old('address',$account->address) }}</textarea>
                                    </div>
                                    @error('address')
                                    <p class="text-danger">
                                        {{$message}}
                                    </p>
                                    @enderror

                                    <div class="mt-3 col-5 offset-7">
                                        <button type="submit" class="btn bg-dark text-white w-100">
                                           <i class="fa-solid fa-circle-chevron-right me-1"></i> Change
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
