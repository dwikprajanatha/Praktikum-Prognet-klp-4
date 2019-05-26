@extends('admin.layouts.Adminapp')

@section('css')

    <!-- bootstrap-datetimepicker -->
    <link href="{{asset('adminAssets/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css')}}" rel="stylesheet">

@endsection

@section('content')



<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Form Elements</h3>
            </div>



        </div>

        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Form Design <small>different form elements</small></h2>
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
                        <br />

        @if(session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{session()->get('success')}}
            </div>

        @elseif(session()->has('error'))
            <div class="alert alert-danger" role="alert">
                {{session()->get('error')}}
            </div>
        @endif
                        <form id="demo-form2" action="{{route('product.store')}}" method="POST" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="product-name">Product Name<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="name" id="product-name" required="required" class="form-control col-md-7 col-xs-12" placeholder="Product Name">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="product-stock">Product Stock<span class="required">*</span>
                                </label>
                                <div class="col-md-2 col-sm-3 col-xs-12 form-group has-feedback">
                                    <input type="text" name="stock" id="product-stock" class="form-control" id="inputSuccess5">
                                    <span class="form-control-feedback right" aria-hidden="true">Pcs</span>
                                </div>

                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="product-weight">Product Weight<span class="required">*</span>
                                </label>
                                <div class="col-md-2 col-sm-3 col-xs-12 form-group has-feedback">
                                    <input type="text" name="weight" id="product-weight" class="form-control" id="inputSuccess5">
                                    <span class="form-control-feedback right" aria-hidden="true">Kg</span>
                                </div>
                            </div>

                            <div class="form-group">
                            
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Product Categories</label>

                                <div class="col-md-6 col-sm-6 col-xs-12">
                                        <p style="padding: 5px;">
                                        @foreach($categories as $category)

                                        <input type="checkbox" name="categories[]" value="{{$category->category_name}}" class="flat" /> {{$category->category_name}}

                                        @endforeach
                                        <p>
                                </div>

                            </div>


                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="product-description">Product Description <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea class="form-control" name="description" id="product-description" rows="3" placeholder="Describe Your Product Here.."></textarea>
                                    <p class="text-danger">Max. 255 Character!</p>
                                </div>
                                
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="product-rate">Product Rate<span class="required">*</span>
                                </label>
                                <div class="col-md-2 col-sm-3 col-xs-12 form-group has-feedback">
                                    <input type="text" name="rate" id="product-rate" class="form-control has-feedback-left" id="inputSuccess5">
                                    <span class="form-control-feedback left" aria-hidden="true">Rp.</span>
                                </div>

                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="product-price">Product Price<span class="required">*</span>
                                </label>
                                <div class="col-md-2 col-sm-3 col-xs-12 form-group has-feedback">
                                    <input type="text" name="price" id="product-price" class="form-control has-feedback-left" id="inputSuccess5">
                                    <span class="form-control-feedback left" aria-hidden="true">Rp.</span>
                                </div>
                            </div>

                            <div class="form-group">

                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="discount">Discount<span class="required">*</span>
                                </label>
                                <div class="col-md-2 col-sm-3 col-xs-12 form-group">
                                    <input type="text" name="discount" id="discount" class="form-control has-feedback" id="inputSuccess5">
                                    <span class="form-control-feedback right">%</span>
                                </div>

                            </div>

                            <div class="row calendar-exibit">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="discount">Disc. Start<span class="required">*</span>
                                </label>
                            <div class="col-md-3">
                                <fieldset>
                                <div class="control-group">
                                    <div class="controls">
                                    <div class="col-md-11 xdisplay_inputx form-group has-feedback">
                                        <input type="text" class="form-control has-feedback-left" id="single_cal1" name="disc_start" aria-describedby="inputSuccess2Status">
                                        <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                        <span id="inputSuccess2Status" class="sr-only">(success)</span>
                                    </div>
                                    </div>
                                </div>
                                </fieldset>
                            </div>
                            </div>


                            <div class="row calendar-exibit">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="discount">Disc. End<span class="required">*</span>
                                </label>
                            <div class="col-md-3">
                                <fieldset>
                                <div class="control-group">
                                    <div class="controls">
                                    <div class="col-md-11 xdisplay_inputx form-group has-feedback">
                                        <input type="text" class="form-control has-feedback-left" id="single_cal2" name="disc_end" aria-describedby="inputSuccess2Status">
                                        <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                        <span id="inputSuccess2Status" class="sr-only">(success)</span>
                                    </div>
                                    </div>
                                </div>
                                </fieldset>
                            </div>
                            </div>


                            <br>
                            <br>
                            <div class="form-group">
                                
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="image-upload">Upload image<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="file" name="files[]" multiple="multiple" id="image-upload" required="required" class="form-control col-md-7 col-xs-12" accept=".jpg,.jpeg,.png">
                                </div>

                            </div>

                            <div class="row" id="image_preview"></div>

                            <div class="col-md-12">
                                <div class="row">
                                    <div class="text-center">
                                        <input type="submit" class="btn btn-success" value="Submit">    
                                    </div>
                                </div>

                                
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('javascript')


    <!-- bootstrap-daterangepicker -->
    <script src="{{ asset('adminAssets/vendors/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('adminAssets/vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <!-- bootstrap-datetimepicker -->    
    <script src="{{ asset('adminAssets/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>


@endpush