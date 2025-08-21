<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
        try {
            // Tải sản phẩm cùng với category và additionalImages
            $product = Product::with(['category', 'additionalImages', 'reviews'])->findOrFail($id);

            // Xác định ảnh chính, sử dụng fallback nếu không có
            $mainImage = $product->image ?? 'https://via.placeholder.com/400';

            // Lấy tất cả ảnh phụ từ additionalImages và thêm ảnh chính vào đầu mảng
            $productImages = $product->additionalImages->pluck('image')->toArray();
            if (! in_array($mainImage, $productImages)) {
                array_unshift($productImages, $mainImage); // Thêm ảnh chính vào đầu mảng
            }

            // Kiểm tra số lượng ảnh, đảm bảo có ít nhất 1 ảnh
            if (empty($productImages)) {
                $productImages = [$mainImage]; // Fallback nếu không có ảnh
            }

            // Truyền dữ liệu vào view
            return view('product-detail', compact('product', 'mainImage', 'productImages'));
        } catch (ModelNotFoundException $e) {
            // Trả về view với $product = null nếu không tìm thấy sản phẩm
            return view('product-detail')->with('product', null);
        }
    }
}
