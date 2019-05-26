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
                                    <th>Product</th>
                                    <th>Review</th>
                                    <th>Status</th>
     
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($reviews as $review)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$review->first_name . ' ' . $review->last_name}}</td>
                                    <td>{{$review->product_name}}</td>
                                    <td>{{$review->content}}</td>
                                    <td><a href="{{route('balas.reviews',$review->reviews_id)}}"><button class="btn btn-success">Balas</button></a></td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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