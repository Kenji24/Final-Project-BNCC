@extends('app')

@section('title', 'CNUUY STORE | Welcome')

@section('content')
<div class="container">
    <div id="carouselExampleAutoplaying" class="carousel slide puter" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{asset('image/banner images/Frame 11 (1).png')}}" class="d-block w-100 banner-image" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{asset('image/banner images/Frame 12.png')}}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{asset('image/banner images/Frame 11 (1).png')}}" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
            {{-- <span class="carousel-control-prev-icon"></span> --}}
            <i class="bi bi-arrow-left-circle-fill" aria-hidden="true"></i>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
            {{-- <span class="carousel-control-next-icon"></span> --}}
            <i class="bi bi-arrow-right-circle-fill" aria-hidden="true"></i>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

<div class="container my-5">
    <div class="category-title">
        <h6>Product Category</h6>
    </div>

    <div class="row my-4">
        <div class="col-md-2">
            <a href="{{ route('product.filter',  $categories[0]) }}" style="text-decoration:none;">
                <div class="card-category w-100 text-center">
                    <img src="{{asset('image/category images/image 10.png')}}" class="card-image"/>
                    <div class="card-label fw-semibold">Scaled Figure</div>
                </div>
            </a>
        </div>
        <div class="col-md-2">
            <a href="{{ route('product.filter',  $categories[1]) }}" style="text-decoration:none;">
            <div class="card-category w-100 text-center">
                <img src="{{asset('image/category images/image 11.png')}}" class="card-image"/>
                <div class="card-label fw-semibold">Figma</div>
            </div>
            </a>
        </div>
        <div class="col-md-2">
            <a href="{{ route('product.filter',  $categories[2]) }}" style="text-decoration:none;">
                <div class="card-category w-100 text-center">
                    <img src="{{asset('image/category images/image 12.png')}}" class="card-image"/>
                    <div class="card-label fw-semibold">Prize Figure</div>
                </div>
            </a>
        </div>
        <div class="col-md-2">
            <a href="{{ route('product.filter',  $categories[3]) }}" style="text-decoration:none;">
                <div class="card-category w-100 text-center">
                    <img src="{{asset('image/category images/image 13.png')}}" class="card-image"/>
                    <div class="card-label fw-semibold">Pop up Parade</div>
                </div>
            </a>
        </div>
        <div class="col-md-2">
            <a href="{{ route('product.filter',  $categories[4]) }}" style="text-decoration:none;">
                <div class="card-category w-100 text-center">
                    <img src="{{asset('image/category images/image 14.png')}}" class="card-image"/>
                    <div class="card-label fw-semibold">Model Kit</div>
                </div>
            </a>
        </div>
        <div class="col-md-2">
            <a href="{{ route('product.filter',  $categories[5]) }}" style="text-decoration:none;">
                <div class="card-category w-100 text-center">
                    <img src="{{asset('image/category images/image 15.png')}}" class="card-image"/>
                    <div class="card-label fw-semibold">Nendoroid</div>
                </div>
            </a>
        </div>
    </div>
</div>

<div class="container my-5">
    <div class="row justify-content-center mb-2">
        <div class="col-8">
            <h2 class="text-center tagline mb-4 mt-2">All Product</h2>
            <div class="input-grup">
                <form action="{{ route('product.search') }}" class="d-flex">
                    @csrf
                    <input type="text" placeholder="Search Item..." class="search-bar" name="keyword" value="{{ $search ?? '' }}">
                    <button class="primaryBtn">Search</button>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        @foreach ($toys as $toy)
            <div class="col-3 my-3">
                <a href="{{ route('product.detail', $toy) }}" style="text-decoration: none; outline:none; border:none;">
                    <div class="product-card">
                        <div style="border:none;">
                            <img src="{{ $toy->image ? asset('image/product images/' . $toy->image) : asset('image/product images/1720887954_121640-limited-production-figma-eris-boreas-greyrat-mushoku-tensei.jpg') }}" class="w-100 product-image" style="border:none;"/>
                        </div>
                        <div>
                            <span class="product-category mt-2">{{ $toy->category->name }}</span>
                            <span class="product-title">{{ $toy->name }}</span>
                            <span class="product-description mt-2 mb-3">{{ Str::limit($toy->description, 50, '...') }}</span>
                        </div>
                        <div class="price-card d-flex justify-content-between align-items-center">
                            <span class="price-tag">Rp  {{ number_format($toy->price) }}</span>
                            @if($toy->stock>0)
                                <a href="{{ route('toy.order', $toy) }}" style="text-decoration: none"><button class="sm-buy-btn d-flex justify-content-between">Buy<i class="bi bi-cart-plus"></i></button></a>

                            @else
                                <div class="sm-buy-btn d-flex justify-content-between">stock habis</div>
                            @endif
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '{{ session('success') }}',
                customClass: {
                    confirmButton: 'primaryBtn'
                }
            });
        </script>
    @endif
</div>

@endsection
