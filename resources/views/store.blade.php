@extends('layouts.app')


@section('content')

<div class="container">
    <div class="section">
        <div class="jumbotron">
            <h1 class="display-4">Hello, world!</h1>
            <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
            <hr class="my-4">
            <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
            <a class="btn btn-primary btn-lg" href="{{ route('product.index')}}" role="button">瀏覽更多...</a>
          </div>
    </div>
    <script src="https://kit.fontawesome.com/886350cba8.js" crossorigin="anonymous"></script>
    <section class="row">
        @foreach ( $latestProducts as $product)
            <div class="col-md-4">
                <div class="card">
                    <img src="http://localhost:8000/storage/{{ $product->image }}" class="card-img-top">
                    <div class="card-body">
                      <h5 class="card-title">{{ $product->title }}</h5>
                      <p class="card-text">NT${{ $product->price }} 元</p>
                    </div>
                  </div>
            </div>
        @endforeach
    </section>
    
</div>
@endsection