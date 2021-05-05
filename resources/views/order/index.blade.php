@extends('layouts.app')


@section('content')



<div class="container">
    <div class="row">
        <div class="col-md-9">
            @foreach($carts ?? '' as $cart)
            <div class="card mb-3">
                <div class="card-body">
                   
                    <table class="table table-striped mt-2 mb-2">
                        <thead>
                            <tr>
                                
                                <th scope="col">名稱</th>
                                <th scope="col">價格</th>
                                <th scope="col">數量</th>
                                <th scope="col">付款狀態</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($cart->items as $item)
                            <tr>
                                
                                <td>{{$item['title'] }}</td>
                                <td>NT${{$item['price'] }}</td>
                                <td>{{$item['qty'] }}</td>
                                <td> 付款成功</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                  
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection