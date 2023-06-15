<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Slideshow;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
        $products = Product::where('active', 1)->orderBy('orderNum')->paginate(6);;
        return view('shop', compact('products', 'productsInCart'));
    }
    public function about()
    {
        return view('about');
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
    public function cart(Request $request, $id)
    {
        if (Auth::check() && Auth::user()->isAdmin === 0) {
            $user = auth()->user();
            $product = Product::find($id);
            $cart = Cart::where('user_id', $user->id)
                ->where('product_id', $product->productID)
                ->first();

            if ($cart) {
                // If the product already exists in the cart, update the quantity
                $cart->quantity += $request->quantity;
                $cart->save();
            } else {
                // If the product is not already in the cart, create a new cart item
                $cart = new Cart;
                $cart->user_id = $user->id;
                $cart->product_id = $product->productID;
                $cart->quantity = $request->quantity;
                $cart->save();
            }

            return redirect()->back();
        } else {
            return redirect('login');
        }
    }

    public function getProductsInCart()
    {
        if (Auth::check() && Auth::user()->isAdmin === 0) {
            $productsInCart = Cart::where('user_id', auth()->user()->id)->get();
            return $productsInCart;
        } else
            return [];
    }
    public function removeFromCart($product_id)
    {
        $user_id = auth()->user()->id;
        Cart::where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->delete();
        return response()->json(['success' => true]);
    }
    public function logoutUser()
    {
        Auth::logout();
        Session::flush();
        Session::regenerate(true);
        return redirect()->route('user.index');
    }
}
