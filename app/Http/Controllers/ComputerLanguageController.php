<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComputerLanguage;
use App\Models\ComputerLanguage;
use Illuminate\Http\Request;

class ComputerLanguageController extends Controller
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
        $lang = ComputerLanguage::all();
        return response()->json([
            'message' => 'ok',
            'data' => $lang
        ], 200, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreComputerLanguage $request)
    {
        $lang = ComputerLanguage::create($request->all());
        return response()->json([
            'message' => 'Register Successfully',
            'data' => $lang
        ], 201, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lang = ComputerLanguage::find($id);
        if ($lang) {
            return response()->json([
                'message' => 'ok',
                'data' => $lang
            ], 200, [], JSON_UNESCAPED_UNICODE);
        } else {
            return response()->json([
                'message' => 'Language not found',
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreComputerLanguage $request, $id)
    {
        $update = [
            'name' => $request->name,
            'description' => $request->description
        ];
        $lang = ComputerLanguage::where('id', $id)->update($update);
        if ($lang) {
            return response()->json([
                'message' => 'Language updated successfully',
            ], 200);
        } else {
            return response()->json([
                'message' => 'Language not found',
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lang = ComputerLanguage::where('id', $id)->delete();
        if ($lang) {
            return response()->json([
                'message' => 'Language deleted successfully',
            ], 200);
        } else {
            return response()->json([
                'message' => 'Language not found',
            ], 404);
        }
    }
}
