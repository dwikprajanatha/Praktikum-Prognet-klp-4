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
                                <img src="{{asset('images/'.$data->image_name)}}" class="img-fluid" alt="">
                            </div>
                            
                            <!--=======  End of big image slider single item  =======-->

                           
                      
                        
                        <!--=======  End of big image slider  =======-->

                       
                </div>

                <div class="col-lg-6">
                    <!--=======  product details content  =======-->
                                        
                    <div class="product-detail-content">

                        <h3 class="product-details-title mb-15">{{$data->product_name}}</h3>

                        <p class="product-price product-price--big mb-10"><span class="main-price">Rp.{{number_format($data->total)}}</span></p>

                        <div class="product-info-block mb-30">
                            <div class="single-info">

                                <span class="title">Expires at:</span>
                                <span class="value">{{$data->timeout}}</span>
                            </div>
                            <div class="single-info">
                                <span class="title">Quantity:</span>
                                <span class="value">{{$data->qty}}</span>
                            </div>

                            <div class="single-info">
                            @if($data->status_transaksi == 'expired')
                                <span class="title">Status:</span>
                                <span class="value">Expired</span>
                            @else
                                <span class="title">Status:</span>
                                <span class="value">{{$data->status_barang}}</span>
                            @endif
                            </div>
                        </div>

                        @if($data->status_transaksi == 'unverified')
                        <form action="{{route('upload.bukti')}}" method="post" enctype="multipart/form-data">
                        @csrf
                            <label>Upload Photo Payment</label><br>
                            <input type="file" name="proof_of_payment" accept="image/*"> <br><br>
                            <input type="hidden" name="id_transaksi" value="{{$data->transaction_id}}">
                            <input type="hidden" name="user_id" value="{{$data->user_id}}">
                            <input type="submit" value="upload">
                        </form>
                        @elseif($data->status_transaksi == 'expired')
                        <a href="#"><button class="btn btn-error">Expired!</button></a>
                        @elseif($data->status_barang == 'Arrived')
                        <a href="{{route('show.review',$data->product_id)}}"><button class="btn btn-success">Sampai!</button></a>
                        @endif
                    </div>

                    <!--=======  End of product details content  =======-->                    
                </div>
            </div>
        </div>
    </div>
    
    <!--====================  End of product details area  ====================-->


    
 
  

@endsection