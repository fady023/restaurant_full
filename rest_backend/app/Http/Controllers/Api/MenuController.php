<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $items = MenuItem::all();
        return response()->json($items);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string',
            'description' => 'nullable|string',
            'price'    => 'required|numeric|min:0',
            'category' => 'required|in:Breakfast,Main Dishes,Drinks,Desserts',
            'image'    => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
        $data['image'] = 'storage/'.$request->file('image')->store('menu', 'public');
    }

        $item = MenuItem::create($data);
        return response()->json($item, 201);
    }

    public function update(Request $request, $id)
    {
        $item = MenuItem::findOrFail($id);

           $data = $request->validate([
            'name'     => 'sometimes|string',
            'description' => 'nullable|string',
            'price'    => 'sometimes|numeric|min:0',
            'category' => 'sometimes|string',
            'image'    => 'nullable|string'
        ]);


        $item->update($data);
        return response()->json($item);
    }

    public function destroy($id)
    {
        $item = MenuItem::findOrFail($id);
        $item->delete();
        return response()->json(['message' => 'Item deleted successfully']);
    }
}