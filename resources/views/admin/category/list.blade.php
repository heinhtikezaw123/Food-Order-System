@extends('admin.layouts.master')

@section('title','Category List Page')

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Product List</h2>
                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{ route('category#createPage') }}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>add category
                            </button>
                        </a>
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            CSV download
                        </button>
                    </div>
                </div>
                {{-- bootstrap alert after creating category--}}
                @if (session('categoryCreated'))
                    <div class='col-4 offset-8'>
                        <<div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('categoryCreated')}}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif

                @if (session('categoryDeleted'))
                <div class='col-4 offset-8'>
                    <<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>{{ session('categoryDeleted') }}!</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
                @endif

                @if (session('passwordChanged'))
                <div class='col-4 offset-8'>
                    <<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('passwordChanged') }}!</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
                @endif

                <div class="row">
                    <div class="col-3">
                        <h4 class="text-secondary">Search Key : <span class="text-danger">{{ request('key') }}</span></h4>
                    </div>

                    <div class="col-3 offset-6">
                        <form action="{{ route('category#list') }}" method="GET">
                            <div class="d-flex">
                                <input type="text" name="key" class="form-control" placeholder="Search..." value="{{ request('key') }}">
                                <button class="btn bg-dark text-white" type="submit">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row my-2">
                    <div class="col-5">
                        <h3> Total   ( {{ $categories->total() }} )</h3>
                    </div>
                </div>

                @if(count($categories) != 0)
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>category name</th>
                                    <th>Created Date</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($categories as $category )
                                    <tr class="tr-shadow">
                                        <td>{{ $category->id }}</td>
                                        <td class="col-5">{{ $category->name }}</td>
                                        <td>{{ $category->created_at->format('j-F-Y') }}</td>
                                        <td>
                                            <div class="table-data-feature">
                                                <a href="{{route('category#edit',$category->id)}}">
                                                    <button class="item me-1" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <i class="zmdi zmdi-edit"></i>
                                                    </button>
                                                </a>
                                                <a href="{{ route('category#delete',$category->id)}}" >
                                                    <button class="item me-1" data-toggle="tooltip" data-placement="top" title="Delete">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach




                            </tbody>
                        </table>

                        <div class="mt-3">
                            {{ $categories->links() }}
                        </div>
                    </div>

                @else
                    <h3 class="text-secondary text-center mt-5">There is no categories here</h3>
                @endif
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection
