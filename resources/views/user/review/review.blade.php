@extends('user.layouts.app')

@section('content')

<div class="product-details-area mb-40">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-md-30 mb-sm-25">
                    <!--=======  product details slider  =======-->
                                        
                        <!--=======  big image slider  =======-->
                                    

                            <!--=======  big image slider single item  =======-->
                                        
                            <div class="big-image-slider-single-item">
                                <img src="{{asset('assets/img/products/big1-1.jpg')}}" class="img-fluid" alt="">
                            </div>
                            
                            <!--=======  End of big image slider single item  =======-->

                           
                      
                        
                        <!--=======  End of big image slider  =======-->

                       
                </div>

                <div class="col-lg-6">
                    <!--=======  product details content  =======-->
                                        
                    <div class="product-detail-content">

                        <h3 class="product-details-title mb-15">{{$data->product_name}}</h3>

                        <p class="product-price product-price--big mb-10"><span class="main-price">Rp.{{number_format($data->price)}}</span></p>


                    </div>

                    <div class="product-detail-content">
                    <form action="{{route('post.review')}}" method="post">
                    @csrf
                        <h3 class="product-details-title mb-15">Give us Review</h3>

                        <textarea name="review" cols="60" rows="10">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem, explicabo. Praesentium blanditiis esse dolorem ex pariatur accusamus velit, natus asperiores, voluptatibus repudiandae vitae dolor vel modi placeat unde neque cumque!</textarea>
                        <br>

                        <input type="hidden" name="product_id" value="{{$data->id}}">

                        <label for="rate">Rate Us!</label>
                        <select name="rate" id="rate">
                            <option value="1">Bad</option>
                            <option value="2">Enough</option>
                            <option value="3">Normal</option>
                            <option value="4">Great</option>
                            <option value="5">Excellent!</option>
                        </select>

                        <br><br>

                        <button type="submit" class="btn btn-success">Post!</button>
                    
                    </form>
                        
                    </div>

                    <!--=======  End of product details content  =======-->                    
                </div>
            </div>
        </div>
    </div>
    
    <!--====================  End of product details area  ====================-->




@endsection