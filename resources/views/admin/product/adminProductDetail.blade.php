@extends('admin.layouts.Adminapp') 

@section('content')

<div class="right_col" role="main">

          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Detail Product</h3>
              </div>
            
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    
                    @if(session()->has('success'))
                      <div class="alert alert-success">
                        {{session()->get('success')}}    
                      </div>
                    @endif

                    
                    <h2>Product Detail</h2>
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

                    <div class="col-md-7 col-sm-7 col-xs-12">
                      <div class="product-image">
                        <img src="{{asset('images/'. $images[0]->image_name )}}" alt="..." />
                      </div>
                      <div class="product_gallery">
                        @foreach($images as $key => $image)
                        
                          @if($key > 0)
                          <a>
                            <img src="{{ asset('images/' . $image->image_name  )}}" alt="..." />
                          </a>
                          @endif

                        @endforeach
                      </div>
                    </div>

                    <div class="col-md-5 col-sm-5 col-xs-12" style="border:0px solid #e5e5e5;">

                      <h3 class="prod_title">{{$product->product_name}}</h3>

                      <p>{{$product->description}}</p>
                      <br />

                      <div class="">
                        <h2>Product Information</h2>
                        <table class="table-bordered text-center">
                          <thead>
                            <th><h2>Stock</h2></th>
                            <th><h2>Weight</h2></th>

                          </thead>
                          <tbody>
                            <td><h4>{{$product->stock}} Pcs</h4></td>
                            <td><h4>{{$product->weight}} Kg</h4></td>
                          </tbody>
                        </table>
                      </div>
                      <br />

                      @if(isset($category))
                      <div class="">
                        <h2>Product Categories</h2>
                        @foreach($category as $cat)
                        <span class="badge">{{$cat->category_name}}</span>
                        @endforeach
                      </div>
                      @endif


                      <div class="">
                        <div class="product_price">
                          <h1 class="price">Rp.{{number_format($product->price,0,0,'.')}}</h1>
                          <span class="price-tax">tax included</span>
                          <br>
                        </div>
                      </div>

                      <div class="d-inline">
                        <a href="{{route('product.edit', $product->id)}}" class="btn btn-app"><i class="fa fa-edit"></i>Edit</a>
                      </div>
                      <div class="d-inline">
                        <form action="{{route('product.destroy', $product->id)}}" method="post">
                          @csrf
                          <input name="_method" type="hidden" value="DELETE">
                          <button type="submit" class="btn btn-app"><i class="fa fa-trash"></i>Delete</button>
                        </form>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
</div>

@endsection