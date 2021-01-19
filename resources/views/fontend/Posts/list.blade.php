@extends('fontend.layouts.guest')
@section('content')
 
    <section class="breadcrumb-section mb-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <nav aria-label="breadcrumb">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fa fa-home" aria-hidden="true"></i> {{ __('layout.home') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('products') }}">{{ __('layout.product') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> title </li>
                      </ol>
                    </nav>                     
                </div>
            </div>
        </div>
    </section> 
  
<div id="content">
  <div class="container">
    <div class="row justify-content-md-center">
          <div class="col col-lg-12 col-xl-12">
        <div class="row has-sidebar">
          <div class="col-md-8 col-lg-9"> 
            <div class="item-listing list">

                @foreach($data as $row)


              <div class="item">
                <div class="row">
                  <div class="col-lg-5">
                    <div class="item-image"> 
                      @if (!empty($row->photo)) 
                      <a href="{{ url('posts',$row->slug) }}">
                      <img src="{{ asset('upload/Post/'.$row->photo) }}">
                      </a> 
                      @endif 
                      <div class="item-badges">
                      <div class="item-badge-left">Sponsored</div>
                      <div class="item-badge-right">For Sale</div>
                      </div>
                      <div class="item-meta">
                      <div class="item-price">$420,000
                      <small>$777 / sq m</small>
                      </div>
                      </div>
                      
                      <a href="#" class="save-item"><i class="fa fa-star"></i></a> </div>
                  </div>
                  <div class="col-lg-7">
                  <div class="item-info">
                    <h3 class="item-title"><a href="{{ url('posts',$row->slug) }}">{{ $row->title }}</a></h3>
                    <div class="item-location">
                      <i class="fa fa-map-marker"></i> Kirkstone Road, Middlesbrough TS3
                    </div>
                    <div class="item-details-i"> 
                      {{ $row->description }}
                    </div>
                     
                 </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="added-on">
                          Listed on 19th Feb 2017
                        </div>
                      </div>
                      <div class="col-md-6">
                        <a href="#" class="added-by">by John Doe</a>
                      </div>
                    </div>

                  </div>
                </div>
              </div>



 
                @endforeach
            </div>
              
  
            <nav aria-label="Page navigation">
              <ul class="pagination">
                {{ $data->links() }}
              </ul>
            </nav>
          </div>
          <div class="col-md-4 col-lg-3">
            <button id="toggle-filters" class="btn btn-primary btn-circle mobile-filter"><i class="fa fa-filter"></i></button>
            <div id="sidebar" class="sidebar-left">
            <button class="close-panel btn btn-white"><i class="fa fa-long-arrow-left"></i></button>
              <div class="sidebar_inner">
              <div id="filters">
                <div class="card">
                  <div class="card-header">
                    <h4 class="panel-title"> <a role="button" data-toggle="collapse" data-parent="#accordion" href="#p_budget" aria-expanded="true" aria-controls="p_type"> Budget <i class="fa fa-caret-down float-right"></i> </a> </h4>
                  </div>
                  <div id="p_budget" class="panel-collapse collapse" role="tabpanel">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <input type="text" class="form-control input-sm" placeholder="Min">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <input type="text" class="form-control input-sm" placeholder="Max">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-header">
                    <h4 class="panel-title"> <a role="button" data-toggle="collapse" data-parent="#accordion" href="#p_type" aria-expanded="true" aria-controls="p_type"> Property Type <i class="fa fa-caret-down float-right"></i> </a> </h4>
                  </div>
                  <div id="p_type" class="panel-collapse collapse show" role="tabpanel">
                    <div class="card-body">
                        <div class="checkbox ">
                            <input type="checkbox" value="1" id="house">
                            <label for="house">House</label>
                        </div>
                        <div class="checkbox ">
                            <input type="checkbox" value="1" id="flat">
                            <label for="flat">Flat</label>
                        </div>
                        <div class="checkbox ">
                            <input type="checkbox" value="1" id="appartment">
                            <label for="appartment">Appartment</label>
                        </div>
                        <div class="checkbox ">
                            <input type="checkbox" value="1" id="farms">
                            <label for="farms">Farms/Lands</label>
                        </div>
                        <div class="checkbox ">
                            <input type="checkbox" value="1" id="room">
                            <label for="room">Room</label>
                        </div>
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-header">
                    <h4 class="panel-title"> <a role="button" data-toggle="collapse" data-parent="#accordion" href="#p_features" aria-expanded="true" aria-controls="p_features"> Features <i class="fa fa-caret-down float-right"></i> </a> </h4>
                  </div>
                  <div id="p_features" class="panel-collapse collapse show" role="tabpanel">
                    <div class="card-body">
                      <div class="checkbox">
                        <input type="checkbox" value="" id="garden">
                        <label for="garden"> Garden</label>
                      </div>
                      <div class="checkbox">
                        <input type="checkbox" value="" id="parking">
                        <label for="parking"> Parking</label>
                      </div>
                      <div class="checkbox">
                        <input type="checkbox" value="" id="fireplace">
                        <label for="fireplace"> Fireplace</label>
                      </div>
                      <div class="checkbox">
                        <input type="checkbox" value="" id="restaurant">
                        <label for="restaurant"> Restaurant</label>
                      </div>
                      <div class="checkbox">
                        <input type="checkbox" value="" id="school">
                        <label for="school"> School</label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              </div>
            </div>
          </div>
          
        </div>
        </div>
        </div>
        </div>
        </div> 
 
@endsection()

 