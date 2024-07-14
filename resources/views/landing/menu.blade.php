@extends('app')

@section('title', 'CNUUY STORE | All Product')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center mb-2">
        <div class="col-8">
            <h2 class="text-center tagline mb-4 mt-2">All Product</h2>
            <div class="input-grup">
                <form action="{{ route('product.search') }}" class="d-flex">
                    @csrf
                    <input type="text" placeholder="Search Item..." class="search-bar" name="keyword">
                    <button class="primaryBtn">Search</button>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        @foreach ($toys as $toy)
            <div class="col-3 my-3">
                <a href="{{ route('product.detail', $toy) }}" style="text-decoration: none">
                    <div class="product-card">
                        <div class="">
                            <img src="{{ asset("image/product images/" . $toy->image )}}"  class="w-100 product-image" />
                        </div>
                        <div>
                            <span class="product-category mt-2">{{ $toy->category->name }}</span>
                            <span class="product-title">{{ $toy->name }}</span>
                            <span class="product-description mt-2 mb-3">{{ Str::limit($toy->description, 50, '...') }}</span>
                        </div>
                        <div class="price-card d-flex justify-content-between align-items-center">
                            <span class="price-tag">Rp {{ number_format($toy->price) }}</span>
                            <a href="{{ route('toy.order', $toy) }}" style="text-decoration: none"><button class="sm-buy-btn d-flex justify-content-between">Buy<i class="bi bi-cart-plus"></i></button></a>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
        <div class="page d-flex justify-content-center mt-3">{{ $toys->links() }}</div>
    </div>
</div>
@endsection
