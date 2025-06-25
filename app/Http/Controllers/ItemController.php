<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $statusFilter = $request->query('status');
        $searchQuery = $request->query('search');

        $items = Item::when($statusFilter, function ($query, $statusFilter) {
                return $query->where('status', $statusFilter);
            })
            ->when($searchQuery, function ($query, $searchQuery) {
                return $query->where('name', 'like', '%' . $searchQuery . '%');
            })
            ->latest()
            ->paginate(10);

        return view('items.index', compact('items', 'statusFilter', 'searchQuery'));
    }

    public function create()
    {
        return view('items.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'nullable|string',
            'contact' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:lost,found,claimed',
        ]);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('items', 'public');
        }

        Item::create([
            'name' => $request->name,
            'description' => $request->description,
            'location' => $request->location,
            'contact' => $request->contact,
            'status' => $request->status,
            'image' => $imagePath,
        ]);

        return redirect()->route('items.index')->with('success', 'Item reported successfully.');
    }

    public function show(Item $item)
    {
        return view('items.show', compact('item'));
    }

    public function edit(Item $item)
    {
        return view('items.edit', compact('item'));
    }

    public function update(Request $request, Item $item)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'nullable|string',
            'contact' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:lost,found,claimed',
        ]);

        // Handle image update
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('items', 'public');
            $item->update(['image' => $imagePath]);
        }

        $item->update($request->except('image'));
        return redirect()->route('items.show', $item)->with('success', 'Item updated successfully.');
    }

    public function destroy(Item $item)
    {
        if ($item->image) {
            \Storage::delete('public/' . $item->image);
        }

        $item->delete();
        return redirect()->route('items.index')->with('success', 'Item deleted successfully.');
    }
}
