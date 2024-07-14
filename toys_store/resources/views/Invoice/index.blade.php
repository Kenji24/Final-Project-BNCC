@extends('app')

@section('title', 'CNUUY STORE | Invoice')

@section('content')
    @if ($finalInvoice)
        @foreach ($finalInvoice as $item)
            <div style="text-align:center; margin-top: 100px; padding-bottom: 20px">
                <div class="container" style="padding: 10px; background: white; filter: drop-shadow(0px 4px 20px rgba(97, 97, 97, 0.15));">
                    <div style="text-align:start; padding-top:0px">
                        <div style="color: #1E87C8; display:flex; flex-direction:row; gap:10px">
                            <h4>Invoice ID: </h4>
                            <h4>{{ $item["invoiceHeader"]->id }}</h4>
                        </div>
                        <div style="display:flex; flex-direction:row; gap:10px;">
                            <p class="mb-0">To:</p>
                            <p class="mb-0">{{ auth()->user()->firstName }}</p>
                        </div>
                        <div style="display:flex; flex-direction:row; gap:10px">
                            <p class="mb-0">Payment:</p>
                            <p class="mb-0">Cash</p>
                        </div>
                        <div style="display:flex; flex-direction:row; gap:10px">
                            <p class="mb-0">Date:</p>
                            <p class="mb-3">{{ $item["invoiceHeader"]->created_at->format('D, d M Y') }}</p>
                        </div>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col" style="width:500px">Description</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Price</th>
                                <th scope="col">Sub Total</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php $subTotal = 0; ?>
                            @foreach ($item["invoiceDetail"] as $value)
                                <tr>
                                    <th scope="row" class="align-middle">1</th>
                                    <td scope="row" class="align-middle" style="width:500px">
                                        <div style="display:flex; flex-direction:row; flex-direction: row; justify-content:center;">
                                            <div style="align-self: center">{{ $value->toy->name }}</div>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <div style="display: flex; flex-direction:row; justify-content:center;">
                                            <div style="padding: 0px 10px 0px 10px">{{ $value->quantity }}</div>
                                        </div>
                                    </td>
                                    <td class="align-middle">{{ $value->toy->price }}</td>
                                    <td class="align-middle">{{ $value->subTotal }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="seputar-duit">
                        <div style="display: flex; justify-content:space-between;">
                            <div style="align-self: center; margin-left:20px">Sub Total</div>
                            <div class="duit-total">Rp {{ number_format($item["invoiceHeader"]->total_price - 12000) }}</div>
                        </div>
                        <div style="display: flex; justify-content:space-between;">
                            <div style="align-self: center; margin-left:20px">Administration Fee</div>
                            <div class="duit-total">Rp 12,000</div>
                        </div>
                        <div style="display: flex; justify-content: end; ">
                            <div class="duit-total" style="border: 2px solid black;">Rp {{ number_format($item["invoiceHeader"]->total_price) }}</div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div style="text-align:center; margin-top: 62px;" >
            <h2 style="padding: 40px 40px; color: #1E87C8;">There's Nothing Here!</h2>
        </div>
    @endif
@endsection
