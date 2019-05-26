@extends('user.layouts.app')

@section('css')

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />

@endsection

@section('content')

<div class="page-section pb-40">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    
                    <!-- Checkout Form s-->
                    <form action="{{route('cek.ongkir')}}" method="POST" class="checkout-form">
                    @csrf
                        <div class="row row-40">
                            
                            <div class="col-lg-7 mb-20">
                                
                                <!-- Billing Address -->
                                <div id="billing-form" class="mb-40">
                                    <h4 class="checkout-title">Shipping & Billing Address</h4>
    
                                    <div class="row">
                                    
                                    </form>

                                        <div class="col-12 mb-20">
                                            <label>Address*</label>
                                            <input type="text" name="address" placeholder="Address line 1">
                                        </div>

                                        <div class="col-md-12 col-12 mb-20">
                                            <label>Town/City*</label>
                                            <select class="js-example-basic-single" name="kabupaten" id="kabupaten">
                                                <option value="" disabled selected>Select City</option>
                                                @foreach($kabupaten_list as $kab)
                                                <option value="{{$kab['postal_code']}}" >{{$kab['city_name']}}, {{$kab['province']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
    
                                        <div class="col-md-6 col-12 mb-20">
                                            <label>Zip Code*</label>
                                            <input type="text" placeholder="Zip Code" value="" id="zip_code" disabled>
                                        </div>

                                        <div class="col-md-6 col-12 mb-20">
                                            <label>Courier*</label>
                                            <select class="js-example-basic-single" name="courier" id="courier">
                                                @foreach($kurir_list as $kurir)
                                                <option value="{{$kurir->kode}}">{{$kurir->courier}}</option>
                                                @endforeach
                                            </select>
                                        </div>
    
                                    </div>
    
                                </div>
                                <button type="submit" class="place-order">Place order</button>
                            </div>
                    </form>      

                            <div class="col-lg-5">
                                <div class="row">
                                    
                                    <!-- Cart Total -->
                                    <div class="col-12 mb-60">
                                    
                                        <h4 class="checkout-title">Cart Total</h4>
                                
                                        <div class="checkout-cart-total">
    
                                            <h4>Product <span>Total</span></h4>
                                      
                                            <ul> 
                                                @if(session()->has('cart'))
                                                @foreach(session()->get('cart')->items as $cart)
                                                <li>{{$cart['item']->product_name}} X {{$cart['qty']}} <span>Rp.{{number_format($cart['price'])}}</span></li>
                                                @endforeach
                                                @else
                                                <li>No Items <span>Rp. 0</span></li>
                                                @endif
                                            </ul>

                                            <p>Sub Total <span>Rp.{{number_format(session()->get('cart')->totalPrice)}}</span></p>
                                            
                                            <p>Shipping Fee <span id="ship_cost">Rp.0</span></p>
                                            
                                            <h4>Grand Total <span>Rp.{{number_format(session()->get('cart')->totalPrice)}}</span></h4>
                                            
                                        </div>
                                        
                                    </div>
                                    
                                    <!-- Payment Method -->
      
                                        
                                </div>
                            </div>
                            
                        </div>
                    
                    
                </div>
            </div>
        </div>
    </div>
    

    <!-- scroll to top  -->
    <a href="#" class="scroll-top"></a>
    <!-- end of scroll to top -->


@endsection


@push('javascript')

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>

<script type="text/javascript">

$(document).ready(function() {

    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    
    $('.js-example-basic-single').select2();

    $('#kabupaten').change(function(e){
        
        e.preventDefault();

        var kode_pos = $('#kabupaten').val();
        
        $('#zip_code').attr("value", kode_pos);
        $('#zip_code').attr("placeholder", kode_pos);

    });
    

});



</script>

@endpush