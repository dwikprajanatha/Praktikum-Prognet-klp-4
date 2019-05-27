@extends('user.layouts.app')

@section('content')

    <!--====================  product details area ====================-->
    
    <div class="product-details-area mb-40">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-md-30 mb-sm-25">
                    <!--=======  product details slider  =======-->
                                        
                        <!--=======  big image slider  =======-->
                                    
                        

                            <!--=======  big image slider single item  =======-->
                                        
                            <div class="big-image-slider-single-item">
                                <img src="{{asset('images/'.$products->image_name)}}" class="img-fluid" alt="">
                            </div>
                            
                            <!--=======  End of big image slider single item  =======-->
                        
                        
                </div>

                <div class="col-lg-6">
                    <!--=======  product details content  =======-->
                                        
                    <div class="product-detail-content">
                        <h3 class="product-details-title mb-15">{{$products->product_name}}</h3>

                        <p class="product-price product-price--big mb-10"><span class="main-price">Rp.{{number_format($products->price)}}</span></p>

                        <div class="product-info-block mb-30">
                            <div class="single-info">
                                <span class="title">Stock:</span>
                                <span class="value">{{$products->stock}}</span>
                            </div>
                        </div>

                        <div class="product-short-desc mb-25">
                            <p>{{$products->description}}</p>
                        </div>

                        <div class="quantity mb-20">
                            <a href="{{route('add.to.cart',$products->id)}}"><button class="theme-button product-cart-button">+ Add to Cart</button></a>
                        </div>

                        

                    <!--=======  End of product details content  =======-->                    
                </div>
            </div>
        </div>
    </div>
    
    <!--====================  End of product details area  ====================-->


    <!--=======  product description review   =======-->
    
    <div class="product-description-review-area mb-20">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!--=======  product description review container  =======-->
                    
                    <div class="tab-slider-wrapper product-description-review-container">
                        <nav>
                            <div class="nav nav-tabs justify-content-center" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="review-tab" data-toggle="tab" href="#review" role="tab"
                                    aria-selected="false">Review</a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            
                            <div class="tab-pane fade show active" id="review" role="tabpanel" aria-labelledby="review-tab">
                                <!--=======  review content  =======-->
                                
                                <div class="product-ratting-wrap">
                                
                                    <div class="rattings-wrapper">

                                    @foreach($reviews as $review)
                                        <div class="sin-rattings">
                                            <div class="ratting-author">
                                                <h3>{{$review->first_name . ' ' . $review->last_name}}</h3>

                                                <div class="ratting-star">
                                                @for($i=0 ; $i < $review->rate ; $i++)
                                                    <i class="fa fa-star"></i>
                                                @endfor
                                                @for($y = $i ; $y < 5 ; $y++)
                                                    <i class="fa fa-star-o"></i>
                                                @endfor
                                                    <span>({{$review->rate}})</span>
                                                </div>
                                            </div>
                                            <p>{{$review->content}}</p>
                                            
                                            @foreach($response as $respon)

                                            @if($respon->review_id == $review->id)
                                            <!-- balasan admin -->
                                            <div class="alert alert-success" role="alert">
                                            <h4 class="alert-heading">Thank You!</h4>
                                            <p>{{$respon->content}}</p>
                                            <hr>
                                            <p class="mb-0">Ingat tanaman ingat Alula!</p>
                                            </div>
                                            <!-- end balasan admin -->
                                            @break
                                            @endif

                                            @endforeach
                                        </div>
                                    @endforeach
                                        

                                    </div>
                                    
                                </div>
                                
                                <!--=======  End of review content  =======-->
                            </div>
                        </div>
                    </div>
                    
                    <!--=======  End of product description review container  =======-->
                </div>
            </div>
        </div>
    </div>
    
    <!--=======  End of product description review   =======-->

                            



@endsection