<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $sort  = $request->query('sort', 'default');
        $query = Product::query();

        if ($sort === 'price') {
            $query->orderBy('price', 'asc');
        }

        $products = $query->paginate(12);

        return view('products', compact('products'));
    }

    public function show($id)
    {
        $product       = Product::with(['category', 'additionalImages'])->find($id);
        $mainImage     = $product->image ?? 'https://via.placeholder.com/400';
        $productImages = $product->additionalImages->pluck('image')->toArray();
        if (! in_array($mainImage, $productImages)) {
            $productImages[] = $mainImage; // Add main image if not already included
        }
        return view('product-detail', compact('product','mainImage','productImages'));
    }
}
