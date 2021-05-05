@extends('layouts.app')

@section('content')

<div class="container">

    <section>
        @if( session()->has('success'))
            <div class="alert alert-success">{{ session()->get('success') }}</div>
        @endif
            <div class="row">

                @foreach ( $products as $product)
                    <div class="col-md-4 mb-4">
                            
                        <div class="card">
                                
                            <img src="http://localhost:8000/storage/{{ $product->image }}" class="card-img-top">

                            <div class="card-body">
                            <h5 class="card-title">{{ $product->title }}</h5>
                            <p class="card-text">title and make up the bulk of the card's content.</p>
                            <p><strong>NT${{ $product->price }} 元</strong></p>
                            <a href="{{ route('addToCart',$product)}}" class="btn btn-primary">購買</a>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
            
        </section>
    </div>
@endsection
