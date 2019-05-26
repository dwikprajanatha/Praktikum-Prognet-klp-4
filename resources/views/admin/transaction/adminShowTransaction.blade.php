@extends('admin.layouts.adminApp')

@section('content')

<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Users <small>Some examples to get you started</small></h3>
              </div>
            </div>

            <div class="clearfix"></div>
            
            <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                <div class="x_title">
                    <h2>Default Example <small>Users</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                        </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    
                    <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Destination</th>
                            <th>Courier</th>
                            <th>Shipping Cost</th>
                            <th>Transaction Status</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    @foreach($data as $da)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td><a href="{{route('show.detail.transaksi',$da->id_transaction)}}">{{$da->first_name}}</a></td>
                            <td>{{$da->regency .', ' . $da->province}}</td>
                            <td>{{$da->courier}}</td>
                            <td>Rp.{{number_format($da->shipping_cost)}}</td>
                            <td>{{$da->status_transaksi}}</td>
                            <td>Rp.{{number_format($da->total)}}</td>
                        </tr>
                    @endforeach

                    <tbody>
                   
                    </tbody>
                    </table>
                    <a href="#"><button type="button" class="btn btn-success">Add Product</button></a>
                  </div>
                </div>
              </div>
            </div>


          </div>
        </div>

@endsection


@push('javascript')

 <!-- Datatables -->
    <script src={{ asset("adminAssets/vendors/datatables.net/js/jquery.dataTables.min.js") }}></script>
    <script src={{ asset("adminAssets/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js") }}></script>

@endpush


