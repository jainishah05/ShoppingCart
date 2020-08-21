<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Category;
use App\CartItem;
use Cart;
use Session;
use View;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */


    use AuthenticatesUsers;
    
    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    protected function redirectTo()
    {
        if (Auth::user()->hasAnyRoles(['Admin','Super Admin']))  
        {
           return RouteServiceProvider::ADMIN;
        } 
        else 
        {
            if(Auth::check())
            {
                //Old Cart
                $cartCollection = Cart::instance('shopping')->content();
                $oldcart = CartItem::where('user_id',Auth::user()->id)->where('type','cart')->get();
                if(count($cartCollection) == 0)
                {
                    foreach ($oldcart as $cart) 
                    { 
                        Cart::instance('shopping')->add([
                            'id' => $cart['product_id'], 
                            'name' => $cart['product_name'], 
                            'price' => $cart['product_price'], 
                            'qty' => $cart['product_qty'],  
                            'weight' => 0, 

                            'options' => [
                                'image' => $cart['product_image'],
                                'user_id' => Auth::user()->id,
                                'p_code' => $cart['product_code'],
                                'description' => $cart['product_description'],
                                'size' => explode('-', $cart['product_size'])
                                ]
                        ]);
                    }
                }

                //Old Wishlist
                $wishlistCollection = Cart::instance('wishlist')->content();
                $oldWishlist = CartItem::where('user_id',Auth::user()->id)->where('type','wishlist')->get();
                if(count($wishlistCollection) == 0)
                {
                    foreach ($oldWishlist as $wishlist) 
                    { 
                        Cart::instance('wishlist')->add([
                            'id' => $wishlist['product_id'], 
                            'name' => $wishlist['product_name'], 
                            'price' => $wishlist['product_price'], 
                            'qty' => $wishlist['product_qty'],  
                            'weight' => 0, 

                            'options' => [
                                'image' => $wishlist['product_image'],
                                'user_id' => Auth::user()->id,
                                'p_code' => $wishlist['product_code'],
                                'description' => $wishlist['product_description'],
                                'size' => explode('-', $wishlist['product_size'])
                                ]
                         ]);
                    }
                }
            }
            return RouteServiceProvider::HOME;
        }  
        
    }

    public function logout() 
    {
        Cart::instance('shopping')->destroy();
        Cart::instance('wishlist')->destroy();
        Auth::logout();
        return redirect('/login');
    }                                                                                           
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Sharing categories object to all views
        $categories = Category::all();
        View::share('categories', $categories);
        $this->middleware('guest')->except('logout');
    }
}
