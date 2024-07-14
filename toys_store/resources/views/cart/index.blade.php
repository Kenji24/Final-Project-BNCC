@extends('app')

@section('title', 'CNUUY STORE | My Cart')



@section('content')
    @if ($toys)
        <div style="text-align:center; margin-top: 62px; padding-bottom: 20px">
            <h2 style="padding: 40px 40px; color: #1E87C8;">Your Shopping Cart</h2>

            <div class="container" style="padding: 10px; background: white; filter: drop-shadow(0px 4px 20px rgba(97, 97, 97, 0.15));">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" style="width:600px">Description</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Remove</th>
                            <th scope="col">Price</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php $subTotal = 0; ?>
                        @foreach ($toys as $toy)
                            <tr>
                                <th scope="row" class="align-middle" style="width:600px">
                                    <div style="display:flex; flex-direction:row; flex-direction: row; justify-content:start; gap: 10px; margin-left: 70px">
                                        <div class="image-container">
                                            <img style="display:block; width: 100px; height:100px;" src="{{ asset("image/product images/" . $toy['image']) }}">
                                        </div>
                                        <div style="align-self: center">{{ $toy['name'] }}</div>
                                    </div>
                                </th>
                                <td class="align-middle">
                                    <div style="display: flex; flex-direction:row; justify-content:center;">
                                        <div style="color:#1E87C8; width: 30px; text-align:center;">{{ $toy['quantity'] }}</div>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <form action="{{ route('toy.order.delete', $toy['id']) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="border: none; background: none;">
                                            <i class="bi bi-cart-x" style="font-size: 24px"></i>
                                        </button>
                                    </form>
                                </td>
                                <td class="align-middle">Rp {{ number_format($toy['price']) }}</td>
                            </tr>
                            <?php $subTotal += $toy['price'] * $toy['quantity']; ?>
                        @endforeach
                    </tbody>
                </table>

                <div class="seputar-duit">
                    <div style="display: flex; justify-content:space-between;">
                        <div style="align-self: center; margin-left:50px">Sub Total</div>
                        <div class="duit-total">Rp {{ number_format($subTotal) }}</div>
                    </div>
                    <div style="display: flex; justify-content:space-between;">
                        <div style="align-self: center; margin-left:50px">Administration Fee</div>
                        <div class="duit-total">Rp 12,000</div>
                    </div>
                    <div style="display: flex; justify-content: end; ">
                        <div class="duit-total" style="border: 2px solid black;">Rp {{ number_format($subTotal + 12000) }}</div>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-3">
                    <div class="d-flex" style="flex-direction: column; gap: 4px; width: 200px; margin-right:20px;">
                        <form action="{{ route('cart.checkout') }}" method="POST">
                            @csrf
                            <input type="hidden" name="total_price" value="{{ $subTotal + 12000 }}">
                            <button class="primaryBtn" style="width: 200px;">Checkout</button>
                        </form>

                        @if (session('success'))
                            <script>
                                Swal.fire({
                                    icon: 'success',
                                    title: '{{ session('success') }}',
                                    customClass: {
                                        confirmButton: 'primaryBtn'
                                    }
                                });
                            </script>
                        @elseif(session('failed'))
                            <script>
                                Swal.fire({
                                    icon: 'error',
                                    title: '{{ session('failed') }}',
                                    customClass: {
                                        confirmButton: 'primaryBtn'
                                    }
                                });
                                {{ session()->forget('failed') }};
                            </script>
                        @endif

                        <a href="{{ route('product.menu') }}" style="text-decoration:none;"><button class="secondaryBtn" style="width: 200px;">Continue Shopping</button></a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div style="text-align:center; margin-top: 62px;" >
            <h2 style="padding: 40px 40px; color: #1E87C8;">There's Nothing Here!</h2>
        </div>
    @endif
@endsection
