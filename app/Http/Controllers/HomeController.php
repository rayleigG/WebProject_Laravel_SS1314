<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Slideshow;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class HomeController extends Controller
{
    public function index()
    {
        $productsInCart = $this->getProductsInCart();
        $slideshows = Slideshow::where('active', 1)
            ->orderBy('orderNum')
            ->get();
        return view('home', compact('slideshows', 'productsInCart'));
    }
    public function shop()
    {
        $productsInCart = $this->getProductsInCart();
        $products = Product::where('active', 1)
            ->where('quantity', '>', 0)
            ->orderBy('orderNum')->paginate(6);
        return view('shop', compact('products', 'productsInCart'));
    }
    public function about()
    {
        $productsInCart = $this->getProductsInCart();
        return view('about', compact('productsInCart'));
    }
    public function contact()
    {
        $productsInCart = $this->getProductsInCart();
        return view('contact', compact('productsInCart'));
    }
    public function resetPassword()
    {
        return view('authFolder.resetpassword');
    }
    public function resetPasswordPost(Request $request)
    {
        $request->validate([
            'newPassword' => 'required|min:8',
            'confirmPassword' => 'required|same:newPassword',
        ]);
        $user = new User();
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->oldpassword, $request->password)) {
            return back()
                ->withInput()
                ->withErrors(['error' => 'Invalid email or password.']);
        }
        // if ($request->newPassword != $request->confirmPassword) {
        //     return back()
        //         ->withInput()
        //         ->withErrors(['confirmPassword' => 'Confirm Password does not match.']);
        // }
        $user->password = Hash::make($request->newPassword);
        $user->save();
        return back()->with('success', 'Password has been reset!');
    }
    public function cart(Request $request, $product_id)
    {
        if (Auth::check() && Auth::user()->isAdmin === 0) {
            $user = auth()->user();
            $product = Product::find($product_id);
            $cart = Cart::where('user_id', $user->id)
                ->where('product_id', $product->productID)
                ->where('payment_status', 0)
                ->first();
            if ($cart) {
                // If the product already exists in the cart, update the quantity
                $cart->quantity += $request->quantity;
                $product->quantity -= $request->quantity;
                $product->save();
                $cart->save();
            } else {
                // If the product is not already in the cart, create a new cart item
                $cart = new Cart;
                $cart->user_id = $user->id;
                $cart->product_id = $product->productID;
                $cart->quantity = $request->quantity;
                $product->quantity -= $request->quantity;
                $product->save();
                $cart->save();
            }
            return redirect()->back();
        } else {
            session(['previousUrl' => URL::previous()]);
            return redirect('login');
        }
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
    public function getProductsInCartAjax()
    {
        if (Auth::check() && Auth::user()->isAdmin === 0) {
            $productsInCart = Cart::with('product') // Eager load the related product information
                ->where('user_id', auth()->user()->id)
                ->where('payment_status', 0)
                ->get();

            return response()->json(['productsInCart' => $productsInCart]);
        } else {
            return response()->json(['productsInCart' => []]);
        }
    }
    public function getProductInfoAjax(Request $request)
    {
        $product_id = $request->product_id;
        // Retrieve product information based on $product_id
        $product = Product::find($product_id);
        if ($product) {
            return response()->json(['productInfo' => $product]);
        } else {
            return response()->json(['error' => 'Product not found'], 404);
        }
    }
    public function remove_cart(Request $request)
    {
        $cartID = $request->input('cartID');
        $p_id = $request->input('p_id');
        $cart = Cart::find($cartID);
        $product = Product::find($p_id);
        if ($cart && $product) {
            // Increase the product quantity by the quantity in the cart
            $product->quantity += $cart->quantity;
            $product->save();
            // Delete the cart item
            $cart->delete();
            return response()->json(['success' => 'Product has been removed from your cart.']);
        } else {
            return response()->json(['error' => 'Unable to remove product from cart.']);
        }
    }

    public function logoutUser()
    {
        Auth::logout();
        Session::flush();
        Session::regenerate(true);
        return redirect()->route('user.index');
    }
}
