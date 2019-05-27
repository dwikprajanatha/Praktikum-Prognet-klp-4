@extends('user.layouts.app')

@section('content')


                        <div class="cart-table table-responsive">
                    @if(!empty($list_transaksi))
                        
                            <table class="table">
                               
                                <thead>
                                    <tr>
                                        <th class="pro-thumbnail">Transaction Date</th>
                                        <th class="pro-subtotal">Total</th>
                                        <th class="pro-subtotal">Status Payment</th>
                                        <th class="pro-subtotal">Expired in</th>
                                        <th class="pro-subtotal">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($list_transaksi as $bar)

                                    <tr>
                                        <td class="pro-title"><a href="{{route('detail.order',$bar->transaction_id)}}">{{$bar->date}}</a></td>
                                        <td class="pro-subtotal"><span>Rp. {{number_format($bar->total)}}</span></td>
                                        <td class="pro-subtotal"><span>{{$bar->status_transaksi}}</span></td>
                                        <td class="pro-subtotal"><span>{{$bar->timeout}}</span></td>
                                        @if($bar->status_transaksi == 'canceled')
                                        <td class="pro-quantity"><button class="btn btn-error">Canceled</button></td>
                                        @else
                                        <td class="pro-quantity"><a href="{{route('cancel.order',$bar->transaction_id)}}"><button class="btn btn-danger">Cancel</button></a></td>
                                        @endif
                                        
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        @else

                            <center><h2>No Transaction Made</h2></center> <br><br>

                        @endif
                        </div>


@endsection