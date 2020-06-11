<?php

namespace App\Http\Controllers;

use App\Sale;
use App\Detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$sales = Sale::orderBy('id', 'desc')->get();
        
        $sales = DB::select(DB::raw("SELECT s.status, s.price, s.created_at, c.name, c.phone, @compras:=(SELECT COALESCE(SUM(price), 0) FROM sales WHERE client_id = 1) AS compras FROM sales s INNER JOIN clients c ON s.client_id = c.id"));

        $records = count($sales);

        $data = [
            'status'    => 'success',
            'code'      => 200,
            'message'   => 'Lista cargada correctamente',
            'sales'      => $sales,
            'records'   => $records
        ];

        return response()->json($data, $data['code']);
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
        $json = $request->input('json', null);
        $params = json_decode($json);
        $params_array = json_decode($json, true);

        //validar los datos
        $validate = \Validator::make($params_array, [
            'client_id'     => 'required|integer',
            'status'  => 'required',
            'price' => 'required|integer',
        ]);


        $sale = new Sale();
        $sale->client_id = 1;
        $sale->status = 1;
        $sale->price = $params_array['price'];
        
        if ($sale->save()) {
            foreach ($params_array["poducts"] as $key) {
                Detail::create([
                    'product_id' => $key['id'],
                    'sale_id'  => $sale->id,
                    'quantity' => $key['cantidad'], // or  $key . 'st array';
                ]);
            }
        }


        $data = [
            'status'    => 'success',
            'code'      => 200,
            'message'   => 'Venta exitosa',
            'products'    => $params_array
        ];

        /* $params_array["poducts"] */

        return response()->json($data, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
