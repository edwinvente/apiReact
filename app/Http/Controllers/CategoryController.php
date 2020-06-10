<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = \DB::table('categories')->orderBy('id', 'desc')->get();

        return response()->json([
            'categories' => $categories
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
            'category'     => 'required|unique:categories',
        ]);

        if ($validate->fails()) {
            $data = [
                'status'    => 'error',
                'code'      => 404,
                'message'   => 'Registro invalido',
                'errors'    => $validate->errors()
            ];
        }else{

            $categortnew = new Category();
            $categortnew->category = $params_array['category'];
            $categortnew->status = 1;
            
            $categortnew->save();

            $data = [
                'status'    => 'success',
                'code'      => 200,
                'message'   => 'Registro exitoso',
                'user'      => $categortnew
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
    public function update(Request $request)
    {
        //recibo los datos
        $json = $request->input('json', null);
        $params = json_decode($json);
        $params_array = json_decode($json, true);
        //validar los datos
        $validate = \Validator::make($params_array, [
            'category'     => 'required',
        ]);

        if ($validate->fails()) {
            $data = [
                'status'    => 'error',
                'code'      => 404,
                'message'   => 'Registro invalido',
                'errors'    => $validate->errors()
            ];
        }else{

            $categortupdate = Category::find($params_array['id']);
            $categortupdate->category = $params_array['category'];
            $categortupdate->status = $params_array['status'];
            
            $categortupdate->update();

            $data = [
                'status'    => 'success',
                'code'      => 200,
                'message'   => 'Registro actualizado',
                'user'      => $categortupdate
            ];
        }

        return response()->json($data, 200);
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
