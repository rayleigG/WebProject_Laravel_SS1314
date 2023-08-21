<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function updateProduct(Request $request)
    {
        $product = Product::find($request->product_id);
        $validator = Validator::make($request->all(), [
            'product_name' => 'required',
            'product_price' => 'required',
            'product_qty' => 'required',
            'category_product' => 'required',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            $message = $errors->first();
            return redirect()->back()->withErrors($errors)->withInput()->with('error', $message);
        }
        if ($request->has('img') && $request->file('img')->isValid()) {
            $productImage = $request->file('img');
            $productImageName = time() . '_' . $productImage->getClientOriginalName();
            $productImagePath = public_path("image/product");
            // Thumbnail
            $thumbnailImage = Image::make($productImage);
            $thumbnailImage->resize(50, 50);
            $thumbnailPath = $productImagePath . "/thumbnail/" . $productImageName;
            $thumbnailImage->save($thumbnailPath);
            // Move Image
            $productImage->move($productImagePath, $productImageName);

            // Remove old Image
            $oldImage = $product->img;
            if ($oldImage) {
                $path = public_path("image/product");
                unlink($path . '/' . $oldImage);
                $thumbnaiPath = public_path("image/product/thumbnail");
                unlink($thumbnaiPath . '/' . $oldImage);
            }
            $product->img = $productImageName;
        }
        $product->pname = $request->product_name;
        $product->quantity = $request->product_qty;
        $product->price = $request->product_price;
        $product->category_id = $request->category_product;
        $product->active = $request->has('chkenable') ? 1 : 0;
        $product->orderNum = Product::max('orderNum') + 1;
        if ($product->save()) {
            return redirect()->route('product')->with('success', 'Prduct has been updated!.');
        }
    }
    public function deleteProduct($id)
    {
        $product = Product::find($id);
        if ($product != null) {
            $product->delete();
            if ($product->img) {
                unlink("image/product/" . $product->img);
                unlink("image/product/thumbnail/" . $product->img);
            }
            return redirect()->route('product')->with('success', "Product has been deleted!");
        } else {
            return redirect()->back()->with("error", "product not found!");
        }
    }
    public function toggleProduct(String $id, String $action)
    {
        $product = Product::where('productID', $id)->first();
        $product->active = ($action == '1' ? 0 : 1);
        $product->save();
        return redirect()->route('product');
    }
    public function addProduct(Request $request)
    {
        $product = new Product();
        $validator = Validator::make($request->all(), [
            'product_name' => 'required',
            'product_price' => 'required',
            'product_qty' => 'required',
            'category_product' => 'required',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust allowed mime types and max size
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            $message = $errors->first();
            return redirect()->back()->withErrors($errors)->withInput()->with('error', $message);
        }
        if ($request->hasFile('img') && $request->file('img')->isValid()) {
            $productImage = $request->file('img');
            $productImageName = time() . '_' . $productImage->getClientOriginalName();
            $productImagePath = public_path("image/product");
            // Thumbnail
            $thumbnailImage = Image::make($productImage);
            $thumbnailImage->resize(50, 50);
            $thumbnailPath = $productImagePath . "/thumbnail/" . $productImageName;
            $thumbnailImage->save($thumbnailPath);
            // Move Image
            $productImage->move($productImagePath, $productImageName);
            $product->img = $productImageName;
        } else {
            $product->img = null;
            return redirect()->back()->with('error', 'Please upload a valid image file.');
        }
        $product->pname = $request->product_name;
        $product->quantity = $request->product_qty;
        $product->price = $request->product_price;
        $product->category_id = $request->category_product;
        $product->active = $request->has('chkenable') ? 1 : 0;
        $product->orderNum = Product::max('orderNum') + 1;
        $product->save();

        return redirect()->route('product')->with('success', 'Prduct has been added!.');
    }
    public function index()
    {
        $products = Product::orderBy('orderNum')
            ->paginate(5);
        $categories = Category::where('active', 1)->get();
        return view('admin.product', compact('products', 'categories'));
    }

    public function productDetail($ProductID)
    {
        $productsInCart = $this->getProductsInCart();
        $product = Product::find($ProductID);
        return view('product-detail', compact('product', 'productsInCart'));
    }
    public function getProductsInCart()
    {
        if (Auth::check() && Auth::user()->isAdmin === 0) {
            $productsInCart = Cart::where('user_id', auth()->user()->id)
                ->where('payment_status', 0)
                ->get();

            return $productsInCart;
        } else
            return [];
    }

    public function addCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_name' => 'required',
            'category_desc' => 'required'
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            $message = $errors->first();
            return redirect()->back()->withErrors($errors)->withInput()->with('error', $message);
        }
        $category = new Category();
        $category->catName = $request->category_name;
        $category->catDesc = $request->category_desc;
        $category->active = $request->has('chkenable') ? 1 : 0;
        $category->save();

        return redirect()->route('category');
    }
    public function toggleCategory(String $id, String $action)
    {
        $slideshow = Category::where('category_id', $id)->first();
        $slideshow->active = ($action == '1' ? 0 : 1);
        $slideshow->save();
        return redirect()->route('category');
    }

    public function updateCategory(Request $request)
    {
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'category_name' => 'required',
            'category_desc' => 'required'
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            $message = $errors->first();
            return redirect()->back()->withErrors($errors)->withInput()->with('error', $message);
        }
        $category = Category::find($request->category_id);
        $category->catName = $request->category_name;
        $category->catDesc = $request->category_desc;
        $category->active = $request->has('chkenable') ? 1 : 0;
        $category->save();

        return redirect()->route('category')->with('success', 'Category has been updated!');
    }
}
