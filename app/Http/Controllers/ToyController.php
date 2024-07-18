<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Toy;
use Illuminate\Http\Request;

class ToyController extends Controller
{
    public function create(){
        $categories = Category::all();
        return view('toys.create', compact('categories'));
    }

    public function store(Request $request){

        $request->validate([
            'image' => 'nullable',
            'name' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        $image = $request->file('image');
        $imgName = time() . "_" . $image -> getClientOriginalName();
        $image->move(public_path("image/product images"), $imgName);


        Toy::create([
            "image" => $imgName,
            "category_id" => $request -> input('category_id'),
            "name" => $request -> input('name'),
            "description" => $request -> input('description'),
            "price" => $request -> input('price'),
            "stock" => $request -> input('stock'),
        ]);
        return redirect()->route('admin.home')->with('success', 'berhasil wak!');

    }

    public function edit(Toy $toy){
        $categories = Category::all();
        return view('toys.edit', compact(['toy', 'categories']));
    }

    public function update(Request $request, Toy $toy){
        $request->validate([
            'image' => 'nullable',
            'name' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        if($request->hasFile('image')){

            $image = $request->file('image');
            $imgName = time() . "_" . $image -> getClientOriginalName();
            $image->move(public_path("image/product images"), $imgName);

            $toy->update([
                "image" => $imgName,
                "category_id" => $request -> input('category_id'),
                "name" => $request -> input('name'),
                "description" => $request -> input('description'),
                "price" => $request -> input('price'),
                "stock" => $request -> input('stock'),
            ]);
            $toy->save();
        }
        else{
            $toy->update([
                "category_id" => $request -> input('category_id'),
                "name" => $request -> input('name'),
                "description" => $request -> input('description'),
                "price" => $request -> input('price'),
                "stock" => $request -> input('stock'),
            ]);
            $toy->save();
        }

        return redirect()->route('admin.home')->with('success', 'berhasil wak!');
    }

    public function delete(Toy $toy){

        $toy->delete();
        return redirect()->route('admin.home');
    }

    public function order(Toy $toy){
        $toy_id = $toy->id;
        $cart = session()->get('cart', []);

        if(isset($cart[$toy_id])){
            $cart[$toy_id]["quantity"]++;
        }
        else{
            $cart[$toy_id] = [
                "id" => $toy_id,
                "name" => $toy->name,
                "image" => $toy->image,
                "category" => $toy->category->name,
                "price" => $toy->price,
                "quantity" => 1
            ];

        }

        session()->put('cart', $cart);
        // dd($cart);
        return redirect()->route('product.menu');
    }

    public function addOrder(Request $request){
        $toy_id = $request->input('id');
        $toy = Toy::find($toy_id);

        $cart = session()->get('cart', []);

        if(isset($cart[$toy_id])){
            $cart[$toy_id]["quantity"]++;
        }
        else{
            $cart[$toy_id] = [
                "id" => $toy_id,
                "name" => $toy->name,
                "image" => $toy->image,
                "category" => $toy->category->name,
                "price" => $toy->price,
                "quantity" => $request->input('quantity'),
            ];

        }
        // dd($cart);
        session()->put('cart', $cart);
        return response()->json(['message' => 'successfully added to your cart']);
    }

    public function deleteOrder($id){
        $cart = session()->get('cart', []);

        if(isset($cart[$id])){
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->route('cart');
    }

    public function clearOrder(){
        session()->forget('cart');
        session()->flush();

        return redirect()->route('cart');
    }

    public function detail(Toy $toy){

        return view('toys.detail', compact('toy'));
    }
}
