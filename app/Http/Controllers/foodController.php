<?php

namespace App\Http\Controllers;

use App\Models\food;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class foodController extends Controller
{
    public function index()
    {
        $foods = Food::all();
        return response()->json($foods);
    }
    public function getFood($id)
    {
        $product = Food::find($id);
        if (!$product) {
            return response()->json(['error' => 'Food not found'], 404);
        }
        return response()->json($product);
    }
    public function newFood(Request $request)
    {
        $food = Food::create($request->all());
        return response()->json($food);
    }
    public function updateFood(Request $request, $id)
    {
        $product = Food::find($id);
        if (!$product) {
            return response()->json(['error' => 'Food not found'], 404);
        }
        $product->update($request->all());
        return response()->json($product);
    }
    public function destroyFood($id)
    {
        $product = Food::find($id);
        if (!$product) {
            return response()->json(['error' => 'Food not found'], 404);
        }
        $product->delete();
        return response()->json(['message' => 'Food deleted successfully']);
    }

}
