@extends('admin.layouts.adminApp')


@section('css')
    <!-- Datatables -->
    <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

@endsection

@section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Discount <small>Lists</small></h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Discount<small>Make your product more interesting</small></h2>
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
                                    <th>Percentage</th>
                                    <th>Start</th>
                                    <th>End</th>
     
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($discounts as $discount)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$discount->percentage}}%</td>
                                    <td>{{$discount->start}}</td>
                                    <td>{{$discount->end}}</td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- Modal for Create New -->
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target=".bs-example-modal-lg">Add New</button>

                        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                        </button>
                                        <h4 class="modal-title" id="myModalLabel">Add New Courier</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('courier.store')}}" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                            @csrf
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Courier Name <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" name="courier_name" id="courier_name" required="required" class="form-control col-md-7 col-xs-12">
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End of Modal -->
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


