<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

Use Alert;
use Cart;
use Session;
use Auth;
use View;
use App\Product;
use App\ShoppingCart;
use App\CartItem;
use App\Category;

class CartController extends Controller
{
    public function __construct()
    {
        // Sharing categories object to all views
        $categories = Category::all();
        View::share('categories', $categories);
    }

	public function index()
    {
        Session::forget('couponDiscount');
        Session::forget('couponCode');
        $cartCollection = Cart::instance('shopping')->content();
        return view('site.cart.index')->with(['cartCollection' => $cartCollection]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'size' => 'required'
        ]);

        if(!Auth::check())
        {
            return redirect()->back()->with('flash_message_loginerror', 'Please login to add product in your Wishlist or Cart!');
        }
        
        $data = $request->all();

        if (!empty($request->cartbutton) && $request->cartbutton == "shopping cart") 
        {
            //check wheather item added or not
            $cartItem = CartItem::where(['product_id' => $data['id'],'product_size' => $data['size'],'user_id' => Auth::user()->id, 'type' => 'cart'])->count();
            if ($cartItem > 0) {
                return redirect()->back()->with('flash_message_error', 'Item has already been added!');
            }

            Cart::instance('shopping')->add([
            'id' => $data['id'], 
            'name' => $data['name'], 
            'price' => $data['price'], 
            'qty' => $data['quantity'],  
            'weight' => 0, 

            'options' => [
                'image' => $data['img'],
                'user_id' => Auth::user()->id,
                'p_code' => $data['p_code'],
            	'description' => $data['description'],
                'size' => explode('-', $data['size'])
                ]
            ]);

            //store details to cart table
            CartItem::create([
                'product_id' => $data['id'],
                'user_id' => Auth::user()->id,
                'product_name' => $data['name'],
                'product_code' => $data['p_code'],
                'product_price' => $data['price'],
                'product_description' => $data['description'],
                'product_qty' => $data['quantity'],
                'product_size' => $data['size'],
                'product_image' => $data['img']
            ]);
        }  

        //wishlist
        if (!empty($request->wishlist) && $request->wishlist == "wishlist") 
        {
            //check wheather item added or not
            $wishlistItem = CartItem::where(['product_id' => $data['id'],'product_size' => $data['size'],'user_id' => Auth::user()->id, 'type' => 'wishlist'])->count();
            if ($wishlistItem > 0) {
                return redirect()->back()->with('flash_message_error', 'Item has already been added!');
            }

            Cart::instance('wishlist')->add([
                'id' => $request->id, 
                'name' => $request->name, 
                'price' => $request->price, 
                'qty' => $request->quantity,  
                'weight' => 0, 

                'options' => [
                    'image' => $request->img,
                    'user_id' => Auth::user()->id,
                    'p_code' => $request->p_code,
                    'description' => $request->description,
                    'size' => explode('-', $request->size)
                ]
            ]);

            //store wishlist details to cart table
            CartItem::create([
                'product_id' => $data['id'],
                'user_id' => Auth::user()->id,
                'type' => 'wishlist',
                'product_name' => $data['name'],
                'product_code' => $data['p_code'],
                'product_price' => $data['price'],
                'product_description' => $data['description'],
                'product_qty' => $data['quantity'],
                'product_size' => $data['size'],
                'product_image' => $data['img']
            ]);

            return redirect()->back()->with('flash_message_success_wishlist', 'Added to Wishlist!');
        }

        return redirect()->back()->with('flash_message_success_cart', 'Added to cart!');
    }

    public function show(Request $request)
    {
    	//
    }

    public function edit(Request $request,$id)
    {
        //update quantity
        $qty = Cart::instance('shopping')->get($id)->qty;
        Cart::instance('shopping')->update($id,$qty-1);
        //update quantity in table
        $size = Cart::instance('shopping')->get($id)->options->size;
        CartItem::where(['product_id' => Cart::instance('shopping')->get($id)->id, 'product_size' => $size[0].'-'.$size[1], 'user_id' => Auth::user()->id, 'type' => 'cart'])->update(['product_qty' => $qty-1]);

        return redirect()->back()->with('flash_message_success','Item quantity updated successfully!');
    }

    public function update(Request $request, $id)
    {
        //update quantity
        $qty = Cart::instance('shopping')->get($id)->qty;
        Cart::instance('shopping')->update($id,$qty+1);
        //update quantity in table
        $size = Cart::instance('shopping')->get($id)->options->size;
        CartItem::where(['product_id' => Cart::instance('shopping')->get($id)->id,'product_size' => $size[0].'-'.$size[1],'user_id' => Auth::user()->id, 'type' => 'cart'])->update(['product_qty' => $qty+1]);

        return redirect()->back()->with('flash_message_success','Item quantity updated successfully!');
    }

    public function destroy($id)
    {
        $product_id = Cart::instance('shopping')->get($id)->id;
        $size = Cart::instance('shopping')->get($id)->options->size;
        //delete item
        Cart::instance('shopping')->remove($id);
        //delete item in table
        CartItem::where(['product_id' => $product_id,'product_size' => $size[0].'-'.$size[1],'user_id' => Auth::user()->id, 'type' => 'cart'])->delete();

        return redirect()->back()->with('delete_success', 'Item has been removed successfully!');
    }
}
