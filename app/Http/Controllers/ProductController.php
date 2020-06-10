<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->get();
        return response()->json([
            'products' => $products
        ]);
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
        //recibo los datos
        $json = $request->input('json', null);
        $params = json_decode($json);
        $params_array = json_decode($json, true);
        //validar los datos
        $validate = \Validator::make($params_array, [
            'name'     => 'required|unique:products',
            'reference'  => 'required|unique:products',
            'price' => 'required|integer',
            'size' => 'required',
            'stock' => 'required|integer'
        ]);

        if ($validate->fails()) {
            $data = [
                'status'    => 'error',
                'code'      => 404,
                'message'   => 'Registro invalido',
                'errors'    => $validate->errors()
            ];
        }else{

            $product = new Product();
            $product->category_id = $params_array['category'];
            $product->name = $params_array['name'];
            $product->reference = $params_array['reference'];
            $product->price = $params_array['price'];
            $product->size = $params_array['size'];
            $product->stock = $params_array['stock'];
            $product->status = 1;
            
            $product->save();

            $data = [
                'status'    => 'success',
                'code'      => 200,
                'message'   => 'Registro exitoso',
                'user'      => $product
            ];
        }

        return response()->json($data, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
