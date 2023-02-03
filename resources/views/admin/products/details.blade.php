@extends('admin.layouts.master')

@section('title','Category List Page')

@section('content')
<div class="main-content">
    <div class="row">
        <div class="col-4 offset-6 mb-2">
            @if (session('updateSuccess'))
                <div>
                    <<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('updateSuccess') }}!</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        <div class="ms-5">
                            <i class="fa-solid fa-arrow-left" onclick="history.back()"></i>
                        </div>


                        <div class="row">
                            <div class="col-3 offset-2">
                                    <img src="{{asset('storage/'.$pizza->image)}}" class="img-thumbnail shadow-sm" />
                            </div>

                            <div class="col-7">
                                <div class="my-3 btn bg-dark text-white d-block w-50 bg-danger text-center fs-5"> {{ $pizza->name }} </div>

                                <div class="my-3 btn bg-dark text-white"> <i class="fa-solid fs-5 fa-money-bill-1-wave me-2"></i> {{ $pizza->price }} kyats </div>
                                <div class="my-3 btn bg-dark text-white"> <i class="fa-solid fs-5 fa-clock me-2"></i> {{ $pizza->waiting_time }} mins</div>
                                <div class="my-3 btn bg-dark text-white"> <i class="fa-solid fs-5 fa-eye me-2"></i> {{ $pizza->view_count }} </div>
                                <div class="my-3 btn bg-dark text-white"> <i class="fa-solid fa-clone me-2"></i> {{ $pizza->category_name }} </div>
                                <div class="my-3 btn bg-dark text-white"> <i class="fa-solid fs-5 fa-user-clock me-2"></i> {{ $pizza->created_at->format('j-F-Y') }} </div>

                                <div class="my-3"> <i class="fa-solid fs-4 fa-file-lines me-3"></i> Details</div>
                                <div >{{$pizza->description}}</div>
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
