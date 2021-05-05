@extends('layouts.app')

@section('content')
    <div class="container">
        @if( session()->has('success'))
            <div class="alert alert-success">{{ session()->get('success') }}</div>
        @endif
        <div class="row">
            @if($cart)
            <div class="col-md-8">
                @if($cart)
                <div class="col-md-8">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ( $errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
                @endif


            @foreach ( $cart->items as $product)
                <div class="card mb-2">
                    <div class="card-body">
                        <h5 class="card-title">
                            {{ $product['title']}}
                        </h5>
                        <div class="card-text">
                            共 ${{ $product['price']}} 元

                            <form action="{{ route('product.update',$product['id'])}}" method="post">
                                @csrf
                                @method('put')
                                <input type="text" name="qty" id="qty" value={{ $product['qty']}}>
                                <button type="submit" class="btn btn-secondary btn-sm">修改</button>
    
                            </form>

                            <form action="{{ route('product.remove',$product['id'])}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm ml-4 float-right" style="margin-top: 0px;">刪除</button>
                            </form>
                            
                        </div>
                    </div>
                </div>
            @endforeach
                    <p><strong>總共 ${{$cart->totalPrice}} 元</strong></p>

            </div>
            <div class="col-md-4">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h3 class="card-titel">
                            確認訂單項目
                            <hr>    
                        </h3>
                        <div class="card-text">
                            <p>
                            總共 NT${{$cart->totalPrice}} 元
                            </p>
                            <p>
                            總共 {{$cart->totalQty}} 個
                            </p>
                            <a href="{{ route('checkout', $cart->totalPrice)}}" class="btn btn-info">結帳</a>                        
                        </div>
                    </div>
                </div>
            </div>
                @else
            <p>目前購物車裡沒有東西...</p>

            @endif
        </div>
    </div>

@endsection