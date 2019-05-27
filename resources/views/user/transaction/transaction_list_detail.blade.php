@extends('user.layouts.app')

@section('content')

<div class="page-section pb-40">
        <div class="container">
            <div class="row">
                <div class="col-12">


                    @if(session()->has('success'))
                        <div class="alert alert-success">
                        <ul>
                            <li><b><center>Bukti transfer sudah berhasil di upload</center></b></li> 
                        </ul>
                        </div>
                    @endif

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
                                @foreach($data as $dat)
                                    <tr>
                                        <td class="pro-thumbnail"><a href="#"><img src="{{asset('images/'.$dat->image_name)}}" class="img-fluid" alt="Product"></a></td>
                                        <td class="pro-title"><a href="{{route('show.review',$dat->product_id)}}">{{$dat->product_name}}</a></td>
                                        <td class="pro-price"><span>Rp. {{number_format($dat->price)}}</span></td>
                                        <td class="pro-quantity">{{$dat->qty}} Pcs</td> 
                                        <td class="pro-subtotal">Rp. {{number_format($dat->price * $dat->qty)}}</td>
                                        <td class="pro-remove"><a href="{{route('remove.items',$dat->product_id)}}"><button class="btn btn-danger"><i class="fa fa-trash-o"></i></button></a></td>
                                    </tr>
                                @endforeach
                                    </tbody>
                            </table>
                            
                        </div>
                        <br><br>

                        @if($dat->status_transaksi == 'unverified')

                        <form action="{{route('upload.bukti')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <label>Upload Photo Payment</label><br>
                            <input type="file" name="proof_of_payment" accept="image/*"> <br><br>
                            <input type="hidden" name="id_transaksi" value="{{$dat->transaction_id}}">
                            <input type="hidden" name="user_id" value="{{$dat->user_id}}">
                            <input type="submit" value="upload">
                        </form>

                        @endif
                        
                        
                       
                        <!--=======  End of cart table  =======-->
                        
                </div>
            </div>
        </div>
    </div>


@endsection