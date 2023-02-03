@extends('admin.layouts.master')

@section('title','Category List Page')

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                {{-- bootstrap alert after creating category--}}
                @if (session('categoryCreated'))
                    <div class='col-12'>
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <strong>{{ session('categoryCreated')}}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif

                @if (session('deleteSuccess'))
                <div class='col-4 offset-8'>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>{{ session('deleteSuccess') }}!</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
                @endif

                @if (session('passwordChanged'))
                <div class='col-4 offset-8'>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
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
                        <form action="{{ route('admin#list') }}" method="GET">
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
                        <h3> Total   ( {{ $admin->total() }} )</h3>
                    </div>
                </div>

                {{-- @if(count($categories) != 0) --}}
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Gender</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($admin as $a )
                                    <tr class="tr-shadow">
                                        <td class="col-2">
                                            @if ($a->image == null)
                                                @if ($a->gender == 'male')
                                                    <img src="{{asset('image/default_user.png')}}" class="img-thumbnail shadow-sm" />
                                                @else
                                                    <img src="{{asset('image/female_user.png')}}" class="img-thumbnail shadow-sm" />
                                                @endif
                                            @else
                                                <img src="{{asset('storage/'.$a->image)}}" class="img-thumbnail shadow-sm"  />
                                            @endif

                                        </td>
                                        <input type="hidden" id="userId" value="{{ $a->id }}">
                                        <td>{{ $a->name }}</td>
                                        <td>{{ $a->email }}</td>
                                        <td>{{ $a->gender }}</td>
                                        <td>{{ $a->phone }}</td>
                                        <td>{{ $a->address }}</td>
                                        <td>
                                            <div class="table-data-feature">
                                                @if (Auth::user()->id == $a->id)

                                                @else
                                                    <a href="{{ route('admin#changeRole',$a->id) }}" >
                                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Change Admin Role">
                                                            <i class="fa-solid fa-person-circle-minus"></i>
                                                        </button>
                                                    </a>

                                                    <select class="form-control adminToUser">
                                                        <option value="admin">Admin</option>
                                                        <option value="user">User</option>
                                                    </select>

                                                    <a href="{{ route('admin#delete',$a->id) }}" >
                                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-3">
                            {{ $admin->links() }}
                        </div>
                    </div>

                {{-- @else
                    <h3 class="text-secondary text-center mt-5">There is no categories here</h3>
                @endif --}}
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection

@section('scriptSection')

    <script>
        $(document).ready(function() {
            //change admin role to user role

            $('.adminToUser').change(function() {
                $changeRole = $(this).val();
                $parentNode = $(this).parents('tr');
                $userId = $parentNode.find('#userId').val();

                $data = {
                    'userId' : $userId,
                    'changeRole' : $changeRole
                }

                $.ajax({
                    type : 'get',
                    url : 'http://127.0.0.1:8000/ajax/change/adminRole',
                    data : $data,
                    dataType : 'json',
                })

                location.reload();
            })












            // $('.statusChange').change(function(){
            //     $changeRole = $(this).val();
            //     $parentNode = $(this).parents('tr');
            //     $userId = $($parentNode).find('#userId').val();

            //     $data = {
            //         'userId' : $userId,
            //         'role' : $changeRole,
            //     }


            //     $.ajax({
            //         type : 'get',
            //         url : 'http://127.0.0.1:8000/user/change/userRole',
            //         data : $data,
            //         dataType : 'json',
            //     })

            //     location.reload();
            // })

        })
    </script>

@endsection

