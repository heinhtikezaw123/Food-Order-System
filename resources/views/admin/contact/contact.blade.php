@extends('admin.layouts.master')

@section('title', 'Category List Page')

@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">User Contact Lists</h2>
                            </div>
                        </div>
                    </div>
                    {{-- bootstrap alert after creating category --}}



                    <div class="col-5">
                        {{-- <h3> Total {{ count($order) }}</h3> --}}
                    </div>
                </div>

        <div class="table-responsive table-responsive-data2">
            <table class="table table-data2 text-center">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User Name</th>
                        <th>User Email</th>
                        <th>User Message</th>
                        <th></th>

                    </tr>
                </thead>
                <tbody id="dataList">
                    @foreach ($userContacts as $u)
                        <tr class="tr-shadow">
                            <td>{{ $u->id }}</td>
                            <td>{{ $u->name }}</td>
                            <td>{{ $u->email }}</td>
                            <td>{{ $u->message }}</td>
                            <td>
                                <a href="{{ route('admin#userContactDelete',$u->id) }}" >
                                    <button class="item me-1" data-toggle="tooltip" data-placement="top" title="Delete">
                                        <i class="zmdi zmdi-delete"></i>
                                    </button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
        <!-- END DATA TABLE -->
    </div>
    </div>
    </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection


