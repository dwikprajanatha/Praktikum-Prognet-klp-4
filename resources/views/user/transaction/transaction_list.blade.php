@extends('user.layouts.app')

@section('content')

                        <div class="cart-table table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="pro-thumbnail">Image</th>
                                        <th class="pro-title">Product</th>
                                        <th class="pro-price">Price (pcs)</th>
                                        <th class="pro-quantity">Quantity</th>
                                        <th class="pro-subtotal">Total</th>
                                        <th class="pro-subtotal">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($barang[0] as $bar)
                                    <tr>
                                        <td class="pro-thumbnail"><a href="index.php?page=productdetail"><img src="assets/img/products/small1-1.jpg" class="img-fluid" alt="Product"></a></td>
                                        <td class="pro-title"><a href="{{route('detail.order',$bar->id_transaction_details)}}">{{$bar->product_name}}</a></td>
                                        <td class="pro-price"><span>Rp.{{number_format($bar->price)}}</span></td>
                                        <td class="pro-quantity">{{$bar->qty}}</td> 
                                        <td class="pro-subtotal"><span>{{number_format($bar->total)}}</span></td>
                                        @if($bar->status_barang == 'Canceled')
                                        <td class="pro-quantity"><button class="btn btn-error">Canceled</button></td>
                                        @else
                                        <td class="pro-quantity"><a href="{{route('cancel.order',$bar->id_transaction_details)}}"><button class="btn btn-danger">Cancel</button></a></td>
                                        @endif
                                        
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>


@endsection