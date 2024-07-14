<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;
use App\Models\InvoiceHeader;
use App\Models\InvoiceDetail;
use App\Models\Toy;
use App\Models\User;

class CheckoutController extends Controller
{
    public function cart(){

        $toys = session()->get('cart', []);
        return view('cart.index', compact('toys'));
    }

    public function checkout(Request $request){

        $user_id = auth()->user()->id;
        $user = User::find($user_id);

        if($user->money > $request->input('quantity') * ($request->input('price') - 12000)){
            $invoice = InvoiceHeader::create([
                "user_id" => $user_id,
                "total_price" => $request->input('price'),
            ]);

            $subTotal = $request->input('quantity') * ($request->input('price') - 12000);

            InvoiceDetail::create([
                "invoice_headers_id" => $invoice->id,
                "toy_id" => $request->input('id'),
                "quantity" => $request->input('quantity'),
                "subTotal" => $subTotal,
            ]);

            $toy = Toy::findOrFail($request->input('id'));
            $toy->update([
                "stock" => $toy->stock - $request->input('quantity'),
            ]);

            $user->update([
                "money" => $user->money - ($subTotal + 12000),
            ]);
            $user->save();

            $subTotal = 0;

            return response()->json(['message' => 'successfully added to your invoice']);
        }
        else{
            return response()->json(['message' => 'insufficient money']);
        }

        return true;
    }

    public function Cartcheckout(Request $request){
        $cart = session()->get('cart', []);

        $user_id = auth()->user()->id;
        $user = User::find($user_id);

        if($user->money > $request->input('total_price') + 12000 ){
            $invoice = InvoiceHeader::create([
                "user_id" => $user_id,
                "total_price" => $request->input('total_price'),
            ]);

            $subTotal = 0;
            foreach ($cart as $item) {

                $subTotal = $subTotal + $item['quantity'] * $item["price"];

                InvoiceDetail::create([
                    "invoice_headers_id" =>$invoice->id,
                    "toy_id" => $item['id'],
                    "quantity" => $item['quantity'],
                    "subTotal" => $item['quantity'] * $item["price"],
                ]);
            }
            session()->forget("cart");

            $user->update([
                "money" => $user->money - ($subTotal + 12000),
            ]);
            $user->save();
            $subTotal = 0;

            return redirect()->route('home')->with('success', 'successfully added to your invoice');
        }
        else{
            return redirect()->route('cart')->with('failed', 'insufficient money');
        }

        return true;
    }
}
