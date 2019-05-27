@extends('user.layouts.app')

@section('content')

<div class="page-section pb-40">
        <div class="container">
            <div class="row">
                <div class="col-12">
                @php 
                    if(Session::has('cart')){
                        $carts = Session::get('cart')->items;
                    } else {
                        $carts = null;
                    }                                           
                @endphp
     

                        <!--=======  cart table  =======-->
                        
                        <div class="cart-table table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="pro-thumbnail">Image</th>
                                        <th class="pro-title">Product</th>
                                        <th class="pro-price">Price</th>
                                        <th class="pro-quantity">Quantity</th>
                                        <th class="pro-subtotal">Total</th>
                                        <th class="pro-remove">Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($carts as $cart)
                                
                                    <tr>
                                        <td class="pro-thumbnail"><a href="#"><img src="{{asset('images/'.$cart['item']->image_name)}}" class="img-fluid" alt="Product"></a></td>
                                        <td class="pro-title">{{$cart['item']->product_name}}</td>
                                        <td class="pro-price"><span>Rp. {{number_format($cart['item']->price)}}</span></td>
                                        <td class="pro-quantity">{{$cart['qty']}} Pcs</td> 
                                        <td class="pro-subtotal">Rp. {{number_format($cart['price'])}}</td>
                                        <td class="pro-remove"><a href="{{route('remove.from.cart',$cart['item']->product_id)}}"><button class="btn btn-danger"><i class="fa fa-trash-o"></i></button></a></td>
                                    </tr>
                                @endforeach
                                    </tbody>
                            </table>
                            
                        </div>
                        <br><br>
                        <center><a href="{{route('checkout')}}"><button class="btn btn-success">Check Out</button></a></center>
                        
                       
                        <!--=======  End of cart table  =======-->
                        
                </div>
            </div>
        </div>
    </div>


@endsection