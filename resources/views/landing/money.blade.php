@extends('app')

@section('title', 'CNUUY STORE | Add Fund')

@section('content')
<div style="text-align:center; margin-top: 62px;">
    <h2 style="padding: 40px 40px; color: #1E87C8;">Add Fund To Your Wallet</h2>
    <div class="container" style="padding: 10px; background: white; filter: drop-shadow(0px 4px 20px rgba(97, 97, 97, 0.15));">
        <div style="display: flex; justify-content:start;">
            Saldo ini dapat anda gunakan untuk membeli produk kami
        </div>
        <div style="display: flex; flex-direction:row; gap: 2px">
            <div style="width: 70%; background:#1E87C8; display:flex; justify-content:start; align-items: center">
                <div class="p-2 d-flex" style="flex-direction: column;">
                    <div style="display:flex; justify-content:start; color:white">Add</div>
                    <form action="{{ route('user.money.add') }}" method="POST">
                        @csrf
                        <input type="text" placeholder="masukan nominal" style="width: 890px; border-color: #1E87C8" name="money">
                        <div style="display: flex; justify-content:end; padding-top: 5px">
                            <button class="addM secondaryBtn">Tambah</button>
                        </div>
                    </form>

                    @if (session('success'))
                        <script>
                            swal('{{ session('success') }}');
                        </script>
                    @elseif (session('failed'))
                        <script>
                            swal('{{ session('failed') }}');
                        </script>
                    @endif

                </div>
            </div>
            <div style="width: 30%; border: 2px solid #1E87C8; display:flex; align-items:center; padding: 10px">
                Saldo Anda saat ini: Rp {{ number_format(Auth::user()->money) }}
            </div>
        </div>
    </div>
</div>
@endsection
