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
                    <form action="{{route('transaksi.beli')}}" method="POST" class="checkout-form">
                    @csrf
                        <div class="row row-40">
                            
                            <div class="col-lg-7 mb-20">
                                
                                <!-- Billing Address -->
                                <div id="billing-form" class="mb-40">
                                    <h4 class="checkout-title">Shipping & Billing Address</h4>
    
                                    <div class="row">
                                   

                                        <div class="col-12 mb-20">
                                            <label>Address*</label>
                                            <input type="text" name="address" placeholder="Address line 1" value="{{$request->address}}" disabled>
                                            <input type="hidden" name="address" value="{{$request->address}}">
                                        </div>

                                        <div class="col-md-12 col-12 mb-20">
                                            <label>Town/City*</label>
                                            <select class="js-example-basic-single" name="kabupaten" id="kabupaten">
                                                <option value="{{$kabupaten['postal_code']}}" disabled selected>{{$kabupaten['city_name']}}, {{$kabupaten['province']}}</option>
                                            </select>
                                            <input type="hidden" name="kabupaten" value="{{$kabupaten['city_name']}}">
                                            <input type="hidden" name="provinsi" value="{{$kabupaten['province']}}">
                                        </div>
    
                                        <div class="col-md-6 col-12 mb-20">
                                            <label>Zip Code*</label>
                                            <input type="text" placeholder="{{$kabupaten['postal_code']}}" value="{{$kabupaten['postal_code']}}" id="zip_code" disabled>
                                        </div>

                                        <div class="col-md-6 col-12 mb-20">
                                            <label>Courier*</label>
                                            <select class="js-example-basic-single" name="courier" id="courier">
                                                <option value="{{$request->courier}}" disabled selected>{{$request->courier}}</option>
                                            </select>
                                            <input type="hidden" name="courier" value="{{$request->courier}}">
                                        </div>

                                        

                                        <div class="col-md-6 col-12 mb-20">
                                            <label>Courier*</label>
                                            <select class="js-example-basic-single" id="packet">
                                                <option value="" disabled selected>Choose Packet Shipping</option>
                                                @foreach($ongkir[0]['costs'] as $ship)
                                                <option value="{{$ship['cost'][0]['value']}}">{{ $ship['service'] }} | {{ $ship['cost'][0]['etd'] }} Days | Rp. {{ number_format($ship['cost'][0]['value'])}} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        
                                      

                                    </div>
    
                                </div>
                                
                            </div>
                          

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

                                            <p>Sub Total <span>Rp.{{session()->get('cart')->totalPrice}}</span></p>
                                            
                                            <input type="hidden" id="sub_total" name="sub_total" value="{{session()->get('cart')->totalPrice}}">
                                            
                                            <p>Shipping Fee <span id="ship_cost">Rp.0</span></p>

                                            <input type="hidden" name="ship_cost" id="ongkir" value="">
                                            
                                            <h4>Grand Total <span id="grand_total">Rp.{{session()->get('cart')->totalPrice}}</span></h4>

                                            <input type="hidden" name="grand_total" id="totalSemua" value="">
                                            
                                        </div>
                                        
                                    </div>
                                    
                                    <!-- Payment Method -->
      
                                        
                                </div>
                            </div>
                            <button type="submit" class="place-order">Place order</button>
                        </div>
                    </form>
                    
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

    $('#packet').change(function(e){
        
        e.preventDefault();
        var sub_total = $('#sub_total').val();
        var ship_price = $('#packet').val();

        var grand_total = parseInt(sub_total) + parseInt(ship_price);

        $('#ship_cost').text("Rp." + ship_price);
        $('#grand_total').text("Rp." + grand_total);

        $('#ongkir').val(ship_price);
        $('#totalSemua').val(grand_total);

    });
    

});



</script>

@endpush