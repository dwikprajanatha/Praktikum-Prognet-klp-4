
@extends('user.layouts.app')

@section('content')
    <div class="page-section pb-40">
        <div class="container">
                <div class="col-lg-12 order-1">
                    <!--=======  shop banner  =======-->
                    
                    <div class="shop-banner mb-30 text-center d-none">
                        <img src="assets/img/banners/shop-banner.jpg" class="img-fluid" alt="">
                    </div>
                    
                    <!--=======  End of shop banner  =======-->
                
                    <!--=======  shop header  =======-->
                    
                    <div class="shop-header mb-30">

                        <div class="shop-header__left">
                            <div class="shop-header__left__message">
                                Showing 1 to 9 of 15 (2 Pages)
                            </div>
                        </div>

                        <div class="shop-header__right">

                            <div class="single-select-block d-inline-block mr-50 mr-lg-10 mr-md-10 mr-sm-10">
                                <span class="select-title">Show:</span>
                                <select>
                                    <option value="1">10</option>
                                    <option value="2">20</option>
                                    <option value="3">30</option>
                                    <option value="4">40</option>
                                </select>
                            </div>

                            <div class="single-select-block d-inline-block">
                                <span class="select-title">Sort By:</span>
                                <select>
                                    <option value="1">Default</option>
                                    <option value="2">Name (A-Z)</option>
                                    <option value="3">Price (min - max)</option>
                                    <option value="4">Color</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <!--=======  End of shop header  =======-->

                    <!--=======  shop page content  =======-->
                    
                    <div class="row shop-product-wrap list">
                        <div class="col-12 col-lg-4 col-md-6 col-sm-6 mb-20">
                        
                        @foreach($data as $d)


                        <!--=======  List view product  =======-->
                        
                            <div class="single-slider-product single-slider-product--list-view list-view-product">
                                <div class="single-slider-product__image single-slider-product--list-view__image">
                                    <a href="index.php?page=productdetail">
                                        <img src="{{asset('images/'. $d->image_name)}}" class="img-fluid" alt="">
                                    </a>
                                    @if(isset($discount))
                                    
                                    @foreach($discount as $disc)

                                        @if($disc->product_id == $d->product_id)  
                                        <span class="discount-label discount-label--green">{{$disc->percentage}}%</span>
                                        @endif

                                    @endforeach

                                    @endif

                                </div>

                                <div class="single-slider-product__content  single-slider-product--list-view__content">
                                    <div class="single-slider-product--list-view__content__details">
                                        <p class="product-title"><a href="{{route('detail.product',$d->product_id)}}">{{$d->product_name}}</a></p>
                                        <div class="rating">
                                            <i class="ion-android-star active"></i>
                                            <i class="ion-android-star active"></i>
                                            <i class="ion-android-star active"></i>
                                            <i class="ion-android-star active"></i>
                                            <i class="ion-android-star"></i>
                                        </div>
                                        
                                        <p class="short-desc">{{$d->description}}</p>
                                    </div>

                                    <div class="single-slider-product--list-view__content__actions">
                                        <div class="availability mb-10">
                                            <span class="availability-title">Availabe:</span>
                                            <span class="availability-value">Out of stock</span>
                                        </div>

                                        @if(isset($disc_prices))

                                        @foreach($disc_prices as $disc_price)

                                            @if($disc_price['product_id'] == $d->product_id)

                                            <p class="product-price"><span class="discounted-price">Rp.{{number_format($disc_price['discount_price'])}}</span> <span class="main-price discounted">Rp.{{number_format($d->price)}}</span></p>
                                            @else
                                            <p class="product-price"><span class="main-price">Rp.{{number_format($d->price)}}</span></p>
                                            @endif

                                        @endforeach

                                        @else 

                                        <p class="product-price"><span class="main-price">Rp.{{number_format($d->price)}}</span></p>


                                        @endif


                                        <a href="{{ route('add.to.cart', $d->product_id) }}" class="theme-button list-cart-button mb-10">Add to Cart</a>

                                        <div class="hover-icons">
                                            <ul>
                                                <li><a data-toggle = "modal" data-target="#quick-view-modal-container" href="javascript:void(0)"><i class="icon-eye"></i></a></li>
                                                <li><a href="javascript:void(0)"><i class="icon-heart"></i></a></li>
                                                <li><a href="javascript:void(0)"><i class="icon-sliders"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <!--=======  End of grid view product  =======-->
                        @endforeach
                        </div>
                    </div>

                    
                    <!--=======  End of shop page content  =======-->

                    <!--=======  pagination  =======-->
                    
                    <div class="pagination-section mb-md-30 mb-sm-30">
                        <ul class="pagination">
                            <li class="active"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">></a></li>
                            <li><a href="#">>|</a></li>
                        </ul>

                        <div class="pagination-text">
                            Showing 1 to 9 of 15 (2 Pages)
                        </div>
                    </div>
                    
                    <!--=======  End of pagination  =======-->
                </div>
        </div>
    </div>
    
    <!--====================  End of page content  ====================-->



    <!-- scroll to top  -->
    <a href="#" class="scroll-top"></a>
    <!-- end of scroll to top -->


    <!--=============================================
	=            Quick view modal         =
	=============================================-->
	
	<div class="modal fade quick-view-modal-container" id="quick-view-modal-container" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
                    <div class="col-xl-12 col-lg-12">
                        <div class="row">
                            <div class="col-xl-5 col-lg-6 col-md-6 mb-xxs-25 mb-xs-25 mb-sm-25">
                                <!--=======  big image slider  =======-->
                                
                                <div class="big-image-slider-wrapper">
                                    <div class="ht-slick-slider big-image-slider"
                                    data-slick-setting='{
                                        "slidesToShow": 1,
                                        "slidesToScroll": 1,
                                        "dots": false,
                                        "autoplay": false,
                                        "autoplaySpeed": 5000,
                                        "speed": 1000
                                    }'
                                    data-slick-responsive='[
                                        {"breakpoint":1501, "settings": {"slidesToShow": 1} },
                                        {"breakpoint":1199, "settings": {"slidesToShow": 1} },
                                        {"breakpoint":991, "settings": {"slidesToShow": 1} },
                                        {"breakpoint":767, "settings": {"slidesToShow": 1} },
                                        {"breakpoint":575, "settings": {"slidesToShow": 1} },
                                        {"breakpoint":479, "settings": {"slidesToShow": 1} }
                                    ]'
                                    >
    
                                    <!--=======  big image slider single item  =======-->
                                                
                                    <div class="big-image-slider-single-item">
                                        <img src="assets/img/products/big1-1.jpg" class="img-fluid" alt="">
                                    </div>
                                    
                                    <!--=======  End of big image slider single item  =======-->
    
                                    <!--=======  big image slider single item  =======-->
                                                
                                    <div class="big-image-slider-single-item">
                                        <img src="assets/img/products/big1-2.jpg" class="img-fluid" alt="">
                                    </div>
                                    
                                    <!--=======  End of big image slider single item  =======-->
    
                                    <!--=======  big image slider single item  =======-->
                                                
                                    <div class="big-image-slider-single-item">
                                        <img src="assets/img/products/big1-3.jpg" class="img-fluid" alt="">
                                    </div>
                                    
                                    <!--=======  End of big image slider single item  =======-->
    
                                    <!--=======  big image slider single item  =======-->
                                                
                                    <div class="big-image-slider-single-item">
                                        <img src="assets/img/products/big1-4.jpg" class="img-fluid" alt="">
                                    </div>
                                    
                                    <!--=======  End of big image slider single item  =======-->
    
                                    <!--=======  big image slider single item  =======-->
                                                
                                    <div class="big-image-slider-single-item">
                                        <img src="assets/img/products/big1-5.jpg" class="img-fluid" alt="">
                                    </div>
                                    
                                    <!--=======  End of big image slider single item  =======-->
    
                                    <!--=======  big image slider single item  =======-->
                                                
                                    <div class="big-image-slider-single-item">
                                        <img src="assets/img/products/big1-6.jpg" class="img-fluid" alt="">
                                    </div>
                                    
                                    <!--=======  End of big image slider single item  =======-->
    
                                    </div>
                                </div>
                                
                                <!--=======  End of big image slider  =======-->

                                <!--=======  small image slider  =======-->
                                
                                <div class="small-image-slider-wrapper small-image-slider-wrapper--quickview">
                                    <div class="ht-slick-slider small-image-slider"
                                    data-slick-setting='{
                                        "slidesToShow": 4,
                                        "slidesToScroll": 1,
                                        "dots": false,
                                        "autoplay": false,
                                        "autoplaySpeed": 5000,
                                        "speed": 1000,
                                        "asNavFor": ".big-image-slider",
                                        "focusOnSelect": true,
                                        "arrows": true,
                                        "prevArrow": {"buttonClass": "slick-prev", "iconClass": "ion-ios-arrow-left" },
                                        "nextArrow": {"buttonClass": "slick-next", "iconClass": "ion-ios-arrow-right" }
                                    }'
                                    data-slick-responsive='[
                                        {"breakpoint":1501, "settings": {"slidesToShow": 3} },
                                        {"breakpoint":1199, "settings": {"slidesToShow": 3} },
                                        {"breakpoint":991, "settings": {"slidesToShow": 3} },
                                        {"breakpoint":767, "settings": {"slidesToShow": 3} },
                                        {"breakpoint":575, "settings": {"slidesToShow": 2} },
                                        {"breakpoint":479, "settings": {"slidesToShow": 2} }
                                    ]'
                                    >
    
                                    <!--=======  small image slider single item  =======-->
                                                
                                    <div class="small-image-slider-single-item">
                                        <img src="assets/img/products/small1-1.jpg" class="img-fluid" alt="">
                                    </div>
                                    
                                    <!--=======  End of small image slider single item  =======-->
    
                                    <!--=======  small image slider single item  =======-->
                                                
                                    <div class="small-image-slider-single-item">
                                        <img src="assets/img/products/small1-2.jpg" class="img-fluid" alt="">
                                    </div>
                                    
                                    <!--=======  End of small image slider single item  =======-->
    
                                    <!--=======  small image slider single item  =======-->
                                                
                                    <div class="small-image-slider-single-item">
                                        <img src="assets/img/products/small1-3.jpg" class="img-fluid" alt="">
                                    </div>
                                    
                                    <!--=======  End of small image slider single item  =======-->
    
                                    <!--=======  small image slider single item  =======-->
                                                
                                    <div class="small-image-slider-single-item">
                                        <img src="assets/img/products/small1-4.jpg" class="img-fluid" alt="">
                                    </div>
                                    
                                    <!--=======  End of small image slider single item  =======-->
    
                                    <!--=======  small image slider single item  =======-->
                                                
                                    <div class="small-image-slider-single-item">
                                        <img src="assets/img/products/small1-5.jpg" class="img-fluid" alt="">
                                    </div>
                                    
                                    <!--=======  End of small image slider single item  =======-->
    
                                    <!--=======  small image slider single item  =======-->
                                                
                                    <div class="small-image-slider-single-item">
                                        <img src="assets/img/products/small1-6.jpg" class="img-fluid" alt="">
                                    </div>
                                    
                                    <!--=======  End of small image slider single item  =======-->
    
                                    </div>
                                </div>
                                
                                <!--=======  End of small image slider  =======-->
                            </div>
                            <div class="col-xl-7 col-lg-6 col-md-6">
                                <!--=======  product detail content  =======-->
                                
                                <div class="product-detail-content">
                                    <div class="tags mb-5">
                                        <span class="tag-title">Tags:</span>
                                        <ul class="tag-list">
                                            <li><a href="#">Plant</a>,</li>
                                            <li><a href="#">Garden</a></li>
                                        </ul>
                                    </div>

                                    <h3 class="product-details-title mb-15">Lorem ipsum indoor plants</h3>
                                    <div class="rating">
                                        <i class="ion-android-star active"></i>
                                        <i class="ion-android-star active"></i>
                                        <i class="ion-android-star active"></i>
                                        <i class="ion-android-star active"></i>
                                        <i class="ion-android-star"></i>
                                    </div>
                                    <p class="product-price product-price--big mb-10"><span class="discounted-price">$100.00</span> <span class="main-price discounted">$120.00</span></p>

                                    <div class="product-info-block mb-30">
                                        <div class="single-info">
                                            <span class="title">Ex Tax:</span>
                                            <span class="value">$95.00</span>
                                        </div>
                                        <div class="single-info">
                                            <span class="title">Brand:</span>
                                            <span class="value"><a href="#">Brac</a></span>
                                        </div>
                                        <div class="single-info">
                                            <span class="title">Product Code:</span>
                                            <span class="value">abcd1234</span>
                                        </div>
                                        <div class="single-info">
                                            <span class="title">Availability:</span>
                                            <span class="value stock-red">In stock</span>
                                        </div>
                                    </div>

                                    <div class="product-short-desc mb-25">
                                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptas consectetur inventore voluptatem dignissimos nemo repellendus est, harum maiores veritatis quidem.</p>
                                    </div>

                                    <div class="quantity mb-20">
                                        <span class="quantity-title mr-20">Qty</span> 
                                        <div class="pro-qty mr-15 mb-lg-20 mb-md-20 mb-sm-20">
                                            <input type="text" value="1">
                                        </div>
                                        <button class="theme-button product-cart-button">+ Add to Cart</button>
                                    </div>

                                    <div class="compare-button mb-15">
                                        <a href="#"><i class="icon-sliders"></i> Compare This Product</a>
                                    </div>

                                    <div class="wishlist-button">
                                        <a href="#"><i class="icon-heart"></i> Add to Wishlist</a>
                                    </div>
                                </div>
                                
                                <!--=======  End of product detail content  =======-->
                            </div>
                        </div>
                    </div>
				</div>
			</div>

		</div>
    </div>
    
    <!--=====  End of Quick view modal  ======-->
    
@endsection

