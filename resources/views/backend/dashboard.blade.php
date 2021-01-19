@extends('backend.layouts.master')
@section('content')
<div class="page-title-box">
                            <div class="row align-items-center">
                                
                                <div class="col-sm-6">
                                    <h4 class="page-title">Dashboard</h4>
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item active">Welcome to Veltrix Dashboard</li>
                                    </ol>

                                </div>
                                <div class="col-sm-6">
                                
                                    <div class="float-right d-none d-md-block">
                                        <div class="dropdown">
                                            <a class="btn btn-primary arrow-none waves-effect waves-light" href="{{ url('admin/config') }}">
                                                <i class="mdi mdi-settings mr-2"></i> Cấu hình website
                                            </a> 
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left mini-stat-img mr-4">
                                                <img src="assets/images/services-icon/01.png" alt="" >
                                            </div>
                                            <h5 class="font-16 text-uppercase mt-0 text-white-50">Orders</h5>
                                            <h4 class="font-500">{{ $order_count ?? '' }} <i class="mdi mdi-arrow-up text-success ml-2"></i></h4>
                                            <div class="mini-stat-label bg-success">
                                                <p class="mb-0">+ 12%</p>
                                            </div>
                                        </div>
                                        <div class="pt-2">
                                            <div class="float-right">
                                                <a href="#" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                                            </div>
        
                                            <p class="text-white-50 mb-0">Total Order</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left mini-stat-img mr-4">
                                                <img src="assets/images/services-icon/02.png" alt="" >
                                            </div>
                                            <h5 class="font-16 text-uppercase mt-0 text-white-50">User</h5>
                                            <h4 class="font-500">{{ $user_count ?? '' }} <i class="mdi mdi-arrow-down text-danger ml-2"></i></h4>
                                            <div class="mini-stat-label bg-danger">
                                                <p class="mb-0">- 28%</p>
                                            </div>
                                        </div>
                                        <div class="pt-2">
                                            <div class="float-right">
                                                <a href="#" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                                            </div>
        
                                            <p class="text-white-50 mb-0">Total User</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left mini-stat-img mr-4">
                                                <img src="assets/images/services-icon/03.png" alt="" >
                                            </div>
                                            <h5 class="font-16 text-uppercase mt-0 text-white-50">Products</h5>
                                            <h4 class="font-500">{{ $products_count ?? '' }} <i class="mdi mdi-arrow-up text-success ml-2"></i></h4>
                                            <div class="mini-stat-label bg-info">
                                                <p class="mb-0"> 00%</p>
                                            </div>
                                        </div>
                                        <div class="pt-2">
                                            <div class="float-right">
                                                <a href="#" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                                            </div>
        
                                            <p class="text-white-50 mb-0">Total Products</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left mini-stat-img mr-4">
                                                <img src="assets/images/services-icon/04.png" alt="" >
                                            </div>
                                            <h5 class="font-16 text-uppercase mt-0 text-white-50">Feedback</h5>
                                            <h4 class="font-500">{{ $feedback_count ?? '' }} <i class="mdi mdi-arrow-up text-success ml-2"></i></h4>
                                            <div class="mini-stat-label bg-warning">
                                                <p class="mb-0">+ 84%</p>
                                            </div>
                                        </div>
                                        <div class="pt-2">
                                            <div class="float-right">
                                                <a href="#" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                                            </div>
        
                                            <p class="text-white-50 mb-0">Total Feedback</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->          

                        <div class="row">
                            <div class="col-xl-8">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="mt-0 header-title mb-4">ĐƠN HÀNG MỚI</h4>
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                  <tr>
                                                    <th scope="col">(#) Id</th>
                                                    <th scope="col">Reception</th>
                                                    <th scope="col">Total</th>
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Thanh toán</th>
                                                    <th scope="col" >Function</th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($order_last as $row)
                                                    <tr>
                                                        <td>{{ $row->id }}</td>
                                                        <td>{{ $row->recept_email }}</td>
                                                        <td>{{ $row->total }} {{ $row->currency }}</td>

                                                        <td>{{ $row->created_at }}</td>

                                                        @if($row->invoice_id!='')
                                                        <td>{{ $row->payment }} <font color="green">Invoice ID</font> : <strong>{{ $row->invoice_id }}</strong></td>
                                                        <td>
                                                            <a href="{{ url('admin/orders/show',$row->id) }}" class="btn btn-outline-success btn-sm">
                                                                <i class="fa fa-bars"></i> {{ __('layout.see_details') }}
                                                            </a>
                                                        <td>
                                                        @else
                                                        <td>
                                                            @if($row->paystatus=='paied') 
                                                            <span class="badge badge-success">{{ $row->paystatus }}</span>
                                                            @else
                                                            <span class="badge badge-danger">Not yet</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="{{ url('admin/orders/show',$row->id) }}" class="btn btn-outline-success btn-sm">
                                                                <i class="fa fa-bars"></i>  {{ __('layout.see_details') }}
                                                            </a>
                                                            <a href="{{ url('admin/orders/del',$row->id) }}" class="btn btn-outline-danger btn-sm btnremove">
                                                                <i class="fa fa-remove"></i> {{ __('layout.remove') }}
                                                            </a>
                                                        </td>
                                                        @endif
                                                    </tr>
                                                    @endforeach

                                                     
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="mt-0 header-title mb-4">Sales Report</h4>

                                        <div class="cleafix">
                                            <p class="float-left"><i class="mdi mdi-calendar mr-1 text-primary"></i> Jan 01 - Jan 31</p>
                                             <h5 class="font-18 text-right">$4230</h5>
                                        </div>

                                        <div id="ct-donut" class="ct-chart wid"></div>
    
                                        <div class="mt-4">
                                            <table class="table mb-0">
                                                <tbody>
                                                    <tr>
                                                        <td><span class="badge badge-primary">Desk</span></td>
                                                        <td>Desktop</td>
                                                        <td class="text-right">54.5%</td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="badge badge-success">Mob</span></td>
                                                        <td>Mobile</td>
                                                        <td class="text-right">28.0%</td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="badge badge-warning">Tab</span></td>
                                                        <td>Tablets</td>
                                                        <td class="text-right">17.5%</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
    
                            </div>
                        </div>
                        <!-- end row -->
 	
@endsection()