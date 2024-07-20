@extends('app')

@section('title', 'CNUUY STORE | Detail')

@section('script')
<script>
    $(document).on('click', '.submit', function(e){
        e.preventDefault();

        var productQuantity = $('.quantityDisplay').val();
        var productPrice = $('.product_price').val();
        var productId = $('.product_id').val();

        $.ajax({
            method: "POST",
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
              },
            url: "{{ route('checkout') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                "id": productId,
                "quantity": productQuantity,
                "price": productPrice,
            },
            success: function(response) {

                if (response.message === 'successfully added to your invoice') {

                    Swal.fire({
                        title: response.message,
                        icon: 'success',
                        customClass: {
                            confirmButton: 'primaryBtn'
                        }
                    }).then(function() {
                        location.reload();
                    });

                } else if (response.message === 'insufficient money') {

                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response.message,
                        showCloseButton: true,
                        showCancelButton: false,
                        focusConfirm: false,
                        customClass: {
                            confirmButton: 'primaryBtn'
                        }
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error('Gagal mengirim data: ' + error);
            }
        });

    });

    $(document).on('click', '.addCart', function(e){
        e.preventDefault();

        var productQuantity = $('.quantityDisplay').val();
        var productPrice = $('.product_price').val();
        var productId = $('.product_id').val();

        $.ajax({
            method: "POST",
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
              },
            url: "{{ route('detail.order') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                "id": productId,
                "quantity": productQuantity,
                "price": productPrice,
            },
            success: function(response) {
                console.log('Data berhasil dikirim ke server');
                localStorage.setItem('notification', 'true');
                Swal.fire({
                        title: response.message,
                        icon: 'success',
                        customClass: {
                            confirmButton: 'primaryBtn'
                        }
                    }).then(function() {
                        location.reload();
                    });
            },
            error: function(xhr, status, error) {
                console.error('Gagal mengirim data: ' + error);
            }
        });

    });
</script>

@endsection

@section('content')
    <div class="container d-flex justify-content-center" style="margin-top: 70px; padding: 10px">
        <div style="background-color: white; display:flex; flex-direction:row; width: 90%; gap: 7px; padding: 10px; filter: drop-shadow(20px 4px 20px rgba(97, 97, 97, 0.15));">
            <div style="min-width: 500px; min-height: 500px; max-width: 500px; max-height: 500px; object-fit: cover; background: grey;">
                <img style="" src="{{ $toy->image ? asset('image/product images/' . $toy->image) : asset('image/product images/1720451263_81790-dream-tech-figure-17-kurisu-makise-lab-coat-style-steinsgate.jpg') }}">
            </div>
            <div style="display:flex; flex-direction:column; gap: 5px; width: 100%; padding: 5px">
                <div style="border-block-end: 2px solid black; margin-top: 10px">
                    <h3>{{ $toy->name }}</h3>
                    <div class="px-2" style="background: white; display:ruby; border-radius: 50px;">
                        <p>{{ $toy->category->name }}</p>
                    </div>
                </div>
                <div style="color: #1E87C8; font-weight: 500; font-size: 32px; margin-bottom: 10px">
                    Rp {{ number_format($toy->price) }}
                </div>
                <div style="display:flex; flex-direction:row; gap: 10px; align-items:center;">
                    <div class="quantityBox" style="display: flex; flex-direction:row;">
                        <button class="decreaseBtn" style="color:#1E87C8; background: white; border: 2px solid #1E87C8"><i class="bi bi-dash-lg"></i></button>
                        <input type="text" class="quantityDisplay" style="border: 2px solid #1E87C8; width:30px; text-align:center;" value="1" />
                        <button class="increaseBtn" style="color:#1E87C8; background: white; border: 2px solid #1E87C8"><i class="bi bi-plus-lg"></i></button>
                    </div>

                    @if ($toy->stock>0)
                        <div class="stock-display">stock: {{ $toy->stock }}</div>
                    @else
                        <div class="stock-display">Stok Habis</div>
                    @endif

                </div>
                <div style="display: flex; flex-direction: row; gap: 5px; padding-top: 10px; padding-bottom: 20px; border-block-end: 2px solid black;">
                    <input type="hidden" name="pro_id" value="{{ $toy->id }}" class="product_id">
                    <input type="hidden" name="total_price" value="{{ $toy->price + 12000 }}" class="product_price">
                    <div class="addToCart">
                        <button class="addCart primaryBtn" style="width: 315px">Add to Cart<i class="bi bi-cart-plus"></i></button>
                    </div>
                    <div class="buyNow">
                        @if ($toy->stock>0)
                            <button class="submit primaryBtn" style="width: 315px">Buy Now!</button>
                        @else
                            <button class="submit primaryBtn" style="width: 315px; background-color: grey;" disabled>Stok habis</button>
                        @endif
                    </div>
                </div>
                <div>
                    {{ $toy->description }}
                </div>
            </div>
        </div>
    </div>
@endsection
