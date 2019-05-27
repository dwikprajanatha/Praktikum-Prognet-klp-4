@extends('admin.layouts.adminApp')

@section('content')



<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Edit Product</h3>
            </div>

        </div>

        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Edit Product <small>Make your Products Special</small></h2>
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
                        <form id="demo-form2" action="{{route('product.update',$product->id)}}" method="POST" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PUT">   
                            @csrf
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="product-name">Product Name
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="name" id="product-name"  class="form-control col-md-7 col-xs-12" value="{{$product->product_name}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="product-stock">Product Stock
                                </label>
                                <div class="col-md-2 col-sm-3 col-xs-12 form-group has-feedback">
                                    <input type="text" name="stock" id="product-stock" class="form-control" id="inputSuccess5" value="{{$product->stock}}" >
                                    <span class="form-control-feedback right" aria-hidden="true">Pcs</span>
                                </div>

                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="product-weight">Product Weight
                                </label>
                                <div class="col-md-2 col-sm-3 col-xs-12 form-group has-feedback">
                                    <input type="text" name="weight" id="product-weight" class="form-control" id="inputSuccess5" value="{{$product->weight}}">
                                    <span class="form-control-feedback right" aria-hidden="true">Kg</span>
                                </div>
                            </div>

                            <div class="form-group">
                            
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Product Categories</label>

                                <div class="col-md-6 col-sm-6 col-xs-12">
                                        <p style="padding: 5px;">

                                        
                                        @foreach($categories as $cat)

                                            @if(in_array($cat->id,$category_id))

                                                <input type="checkbox" name="categories[]" value="{{$cat->category_name}}" class="flat" checked /> {{$cat->category_name}}
                                            @else

                                            <input type="checkbox" name="categories[]" value="{{$cat->category_name}}" class="flat" /> {{$cat->category_name}}

                                            @endif



                                        @endforeach
                                         
                                            
                                                
                                            
                                      
          
                                        <p>
                                </div>

                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="product-description">Product Description
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea class="form-control" name="description" id="product-description" rows="3">{{$product->description}}</textarea>
                                    <p class="text-danger">Max. 255 Character!</p>
                                </div>
                                
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="product-rate">Product Rate<span class="required">*</span>
                                </label>
                                <div class="col-md-2 col-sm-3 col-xs-12 form-group has-feedback">
                                    <input type="text" name="rate" id="product-rate" class="form-control has-feedback-left" id="inputSuccess5" value="{{$product->product_rate}}">
                                    <span class="form-control-feedback left" aria-hidden="true">Rp.</span>
                                </div>

                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="product-price">Product Price<span class="required">*</span>
                                </label>
                                <div class="col-md-2 col-sm-3 col-xs-12 form-group has-feedback">
                                    <input type="text" name="price" id="product-price" class="form-control has-feedback-left" id="inputSuccess5" value="{{$product->price}}">
                                    <span class="form-control-feedback left" aria-hidden="true">Rp.</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="image-upload">Upload image
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="file" name="files[]" multiple="multiple" id="image-upload" class="form-control col-md-7 col-xs-12" accept=".jpg,.jpeg,.png">
                                    <p class="text-danger">If You dont want to EDIT or REPLACE picture, just leave it blank!</p>
                                    
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
