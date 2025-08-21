<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->paginate(12);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name'                => 'required|string|max:255',
                'description'         => 'nullable|string',
                'price'               => 'required|numeric|min:0',
                'image'               => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'additional_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'category_id'         => 'nullable|exists:categories,id',
                'quantity'            => 'required|integer|min:0',
                'sku'                 => 'required|string|unique:products,sku',
            ]);

            $data = $request->all();
            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('products', 'public');
            }

            $product = Product::create($data);

            if ($request->hasFile('additional_images')) {
                foreach ($request->file('additional_images') as $image) {
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image'      => $image->store('product_images', 'public'),
                    ]);
                }
            }

            return redirect()->route('admin.products.index')->with('success', 'Sản phẩm đã được tạo!');
        } catch (\Exception $e) {
            Log::error('Lỗi khi tạo sản phẩm: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi tạo sản phẩm. Vui lòng thử lại.');
        }
    }

    public function edit($id)
    {
        $product    = Product::with('additionalImages')->findOrFail($id);
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        try {
            $product = Product::findOrFail($id);

            $request->validate([
                'name'                => 'required|string|max:255',
                'description'         => 'nullable|string',
                'price'               => 'required|numeric|min:0',
                'image'               => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'additional_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'category_id'         => 'nullable|exists:categories,id',
                'quantity'            => 'required|integer|min:0',
                'sku'                 => 'required|string|unique:products,sku,' . $id,
            ]);

            $data = $request->all();
            if ($request->hasFile('image')) {
                if ($product->image) {
                    Storage::disk('public')->delete($product->image);
                }
                $data['image'] = $request->file('image')->store('products', 'public');
            }

            $product->update($data);

            // Xử lý xóa ảnh phụ được chọn
            if ($request->has('delete_images')) {
                $imagesToDelete = $request->input('delete_images', []);
                foreach ($imagesToDelete as $imageId) {
                    $image = ProductImage::where('product_id', $product->id)->find($imageId);
                    if ($image) {
                        Storage::disk('public')->delete($image->image);
                        $image->delete();
                    }
                }
            }

            // Xử lý thêm ảnh phụ mới
            if ($request->hasFile('additional_images')) {
                foreach ($request->file('additional_images') as $image) {
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image'      => $image->store('product_images', 'public'),
                    ]);
                }
            }

            return redirect()->route('admin.products.index')->with('success', 'Sản phẩm đã được cập nhật!');
        } catch (\Exception $e) {
            Log::error('Lỗi khi cập nhật sản phẩm: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi cập nhật sản phẩm. Vui lòng thử lại.');
        }
    }

    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            foreach ($product->additionalImages as $image) {
                Storage::disk('public')->delete($image->image);
                $image->delete();
            }
            $product->delete();

            return redirect()->route('admin.products.index')->with('success', 'Sản phẩm đã được xóa!');
        } catch (\Exception $e) {
            Log::error('Lỗi khi xóa sản phẩm: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi xóa sản phẩm. Vui lòng thử lại.');
        }
    }

    /**
     * Xóa ảnh phụ của sản phẩm
     */
    public function destroyImage($productId, $imageId)
    {
        try {
            $product = Product::findOrFail($productId);
            $image   = ProductImage::where('product_id', $productId)->findOrFail($imageId);

            // Xóa file ảnh khỏi storage
            Storage::disk('public')->delete($image->image);

            // Xóa bản ghi khỏi database
            $image->delete();

            return redirect()->back()->with('success', 'Ảnh phụ đã được xóa thành công!');
        } catch (\Exception $e) {
            Log::error('Lỗi khi xóa ảnh phụ: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi xóa ảnh phụ. Vui lòng thử lại.');
        }
    }
}
