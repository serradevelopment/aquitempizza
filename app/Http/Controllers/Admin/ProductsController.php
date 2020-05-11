<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Image;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'image' => 'image|required|mimes:jpeg,png,jpg,gif,svg'
        ]);

        $data = $request->all();
        $product = new Product;

        $data['category'] = Product::categories()[$data['category']];
        $data['value']    = $this->parseCurrency($data['value']);
        $product->fill($data);


        if ($request->hasFile('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();

            $product->img_extension = $extension;
        }

        $product->save();

        if ($request->hasFile('image')) {
            $image = Image::make($request->file('image'));
            $image->resize(300,300);
            $image->save(public_path('/files/products/').$product->id.'.'.$extension);
        }

        return redirect()->route('home')->with('flash.success', 'Produto cadastrado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->all();

        $data['category'] = Product::categories()[$data['category']];
        $data['value']    = $this->parseCurrency($data['value']);
        $product->fill($data);


        if ($request->hasFile('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();

            $product->img_extension = $extension;
        }

        $product->save();

        if ($request->hasFile('image')) {
            $request->file('image')->move(public_path('/files/products'), sprintf('%s.%s', $product->id, $extension));
        }

        return redirect()->route('home')->with('flash.success', 'Produto editado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if(is_file(public_path('/files/products/'.$product->id.'.'.$product->img_extension))){
            unlink(public_path('/files/products/'.$product->id.'.'.$product->img_extension));
        }
        $product->delete();

        return redirect()->route('home')->with('flash.success', 'Produto deletado com sucesso');
    }

    public function lock(Product $product)
    {
        $product->locked = true;
        $product->save();

        return redirect()->route('home')->with('flash.success', 'Produto bloqueado com sucesso');
    }

    public function unlock(Product $product)
    {
        $product->locked = false;
        $product->save();

        return redirect()->route('home')->with('flash.success', 'Produto desbloqueado com sucesso');
    }
}
