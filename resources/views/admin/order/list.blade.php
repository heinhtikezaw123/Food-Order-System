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
                                <h2 class="title-1">Order List</h2>
                            </div>
                        </div>
                    </div>
                    {{-- bootstrap alert after creating category --}}
                    @if (session('categoryCreated'))
                        <div class='col-4 offset-8'>
                            <<div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('categoryCreated') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                        </div>
                </div>
                @endif

                @if (session('DeleteSuccess'))
                    <div class='col-4 offset-8'>
                        <<div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>{{ session('DeleteSuccess') }}!</strong>
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

        {{-- <div class="row">
                    <div class="col-3">
                        <h4 class="text-secondary">Search Key : <span class="text-danger">{{ request('key') }}</span></h4>
                    </div>

                    <div class="col-3 offset-6">
                        <form action="{{ route('product#list') }}" method="GET">
                            <div class="d-flex">
                                <input type="text" name="key" class="form-control" placeholder="Search..." value="{{ request('key') }}">
                                <button class="btn bg-dark text-white" type="submit">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div> --}}

                <div class="row my-2">
                    <div class="col-5">
                        <h3> Total {{ count($order) }}</h3>
                    </div>
                </div>



        <form action="{{ route('admin#orderChangeStatus') }}" method="get" class="col-5 mt-3">
            @csrf
            <div class="input-group mb-3">
                <select class="custom-select" id="inputGroupSelect02" name="orderStatus"
                    aria-label="Example select with button addon">
                    <option value="">All</option>
                    <option value="0" @if (request('orderStatus') == '0') selected @endif>Pending...</option>
                    <option value="1" @if (request('orderStatus') == '1') selected @endif>Accept</option>
                    <option value="2" @if (request('orderStatus') == '2') selected @endif>Reject</option>
                </select>
                <div class="input-group-append">
                    <button type="submit" class="btn btn-sm ms-3 bg-dark text-white input-group-text"><i class="fa-solid fa-magnifying-glass me-1"></i>Search</button>
                </div>
            </div>


        </form>



        <div class="table-responsive table-responsive-data2">
            <table class="table table-data2 text-center">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>User Name</th>
                        <th>Order Date</th>
                        <th>Order Code</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="dataList">
                    @foreach ($order as $o)
                        <tr class="tr-shadow">
                            <input type="hidden" class="orderId" value="{{ $o->id }}">
                            <td class="col-2">{{ $o->user_id }}</td>
                            <td class="col-2">{{ $o->user_name }}</td>
                            <td class="col-2">{{ $o->created_at->format('F-j-Y') }}</td>
                            <td class="col-2">
                                <a href="{{ route('admin#listInfo', $o->order_code) }}"
                                    style="text-decoration: none">{{ $o->order_code }}</a>
                            </td>
                            <td class="col-2">{{ $o->total_price }} Kyats</td>
                            <td class="col-2">
                                <select name="status" class="form-control statusChange">
                                    <option value="0" @if ($o->status == 0) selected @endif>Pending...
                                    </option>
                                    <option value="1" @if ($o->status == 1) selected @endif>Accept</option>
                                    <option value="2" @if ($o->status == 2) selected @endif>Reject</option>
                                </select>
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

@section('scriptSection')

    <script>
        $(document).ready(function() {
            // $('#orderStatus').change(function(){
            //     $status = $('#orderStatus').val();

            //     $.ajax({
            //     type : 'get',
            //     url : 'http://127.0.0.1:8000/order/ajax/status',
            //     data : {
            //         'status' : $status,
            //     },
            //     dataType : 'json',
            //     success : function(response) {
            //         $list = '';
            //             for($i=0;$i<response.length;$i++) {

            //                 //formatting the Date
            //                 $months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
            //                 $dbDate = new Date(response[$i].created_at);
            //                 $finalDate = $months[$dbDate.getMonth()] + "-" + $dbDate.getDate() + "-" + $dbDate.getFullYear();

            //                 //fixing the pending rejecting and accept

            //                 if(response[$i].status == 0) {
            //                     $statusMessage = `
        //                     <select name="status" class="form-control statusChange">
        //                         <option value="0" selected>Pending...</option>
        //                         <option value="1">Accept</option>
        //                         <option value="2">Reject</option>
        //                     </select>
        //                     `
            //                 } else if(response[$i].status == 1) {
            //                     $statusMessage = `
        //                     <select name="status" class="form-control statusChange">
        //                         <option value="0">Pending...</option>
        //                         <option value="1" selected>Accept</option>
        //                         <option value="2" >Reject</option>
        //                     </select>
        //                     `
            //                 } else if(response[$i].status == 2) {
            //                     $statusMessage = `
        //                     <select name="status" class="form-control statusChange">
        //                         <option value="0">Pending...</option>
        //                         <option value="1" >Accept</option>
        //                         <option value="2" selected >Reject</option>
        //                     </select>
        //                     `
            //                 }


            //                 $list += `
        //                     <tr class="tr-shadow">
        //                         <input type="hidden" class="orderId" value=`${response[$i].id}`>
        //                         <td class="col-2"> ${response[$i].user_id} </td>
        //                         <td class="col-2"> ${response[$i].user_name}</td>
        //                         <td class="col-2"> ${$finalDate}</td>
        //                         <td class="col-2"> ${response[$i].order_code}</td>
        //                         <td class="col-2"> ${response[$i].total_price} Kyats</td>
        //                         <td class="col-2"> ${$statusMessage}</td>
        //                     </tr>
        //                 `
            //             }

            //            $('#dataList').html($list);
            //     }

            //     })
            // })

            //change status
            $('.statusChange').change(function() {
                $currentStatus = $(this).val();
                $parentNode = $(this).parents('tr');
                $orderId = $($parentNode).find('.orderId').val();

                $data = {
                    'status': $currentStatus,
                    'orderId': $orderId,
                }

                $.ajax({
                    type: 'get',
                    url: 'http://127.0.0.1:8000/order/ajax/change/status',
                    data: $data,
                    dataType: 'json',
                })
            })

        })
    </script>

@endsection
