<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

use DataTables;
use Form;

class ProductController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('products.index');
    }

    /* Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getProducts(Request $request){
        $products = Product::query(); 
        return DataTables::of($products)           
            ->addColumn('action', function ($product) {
                $return ='';

                    // edit
                    $return.='<a href="'.route('products.edit',[$product->id]).'" class="btn btn-success btn-circle btn-sm">Edit</a> ';
                     
                    // Delete
                   $return.= Form::open(array(
                        'style' => 'display: inline-block;',
                        'method' => 'DELETE',
                        'onsubmit'=>"return confirm('Do you really want to delete?')",
                        'route' => ['products.destroy', $product->id])).
                    ' <button type="submit" class="btn btn-danger btn-circle btn-sm">Delete</button>'.
                    Form::close();

                return $return;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.form');
    }
  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);
  
        Product::create($request->all());
        
        $request->session()->flash('success','Product created successfully.');
        return redirect()->route('products.index');
    }
   
    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show',compact('product'));
    }
   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.form',compact('product'));
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
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);
  
        $product->update($request->all());
        
        $request->session()->flash('success','Product updated successfully.');
        return redirect()->route('products.index');
    }
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Product $product)
    {
        $product->delete();
        
        $request->session()->flash('success','Product deleted successfully.');
        return redirect()->route('products.index');
    }
}
