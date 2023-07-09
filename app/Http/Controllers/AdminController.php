<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\product;
use App\Models\currncy;
use App\Models\Cart;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{

    function home(){
        $products=DB::table('products')
        ->where('id', '>', '9')
        ->get();
        $result = DB::table('products')
        ->where('sale', 'sale')->get();
        // return $result;
        return view('user.home',compact('products'),compact('result'));
    }

    //admin page
    function allProducts(Request $request)
    {
        $products = product::all();
        $request->session()->forget('currencies');
        return view('admin.all', compact('products'));
    }
    function create()
    {
        return view('admin.create');
    }
    function store(Request $request)
    {

        $data = $request->validate([
            'name' => 'required',
            'desc' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'string',
            'salePrice' => 'numeric',
            'sale' => 'string',
            'image1' => 'required|image|mimes:jpg,png,jpeg',
            'image2' => 'required|image|mimes:jpg,png,jpeg',
            'image3' => 'image|mimes:jpg,png,jpeg',
            'image4' => 'image|mimes:jpg,png,jpeg',
            'image5' => 'image|mimes:jpg,png,jpeg',
            'category' => 'required',
        ]);
        if ($request->has('image1')) {
            $data['image1'] = Storage::putFile('products', $data['image1']);
        }
        if ($request->has('image2')) {
            $data['image2'] = Storage::putFile('products', $data['image2']);
        }
        if ($request->has('image3')) {
            $data['image3'] = Storage::putFile('products', $data['image3']);
        }
        if ($request->has('image4')) {
            $data['image4'] = Storage::putFile('products', $data['image4']);
        }
        if ($request->has('image5')) {
            $data['image5'] = Storage::putFile('products', $data['image5']);
        }
        product::create($data);
        return redirect(url('create'))->with('success', 'data inserted ssuccessfully');
    }
    function delete($id)
    {
        $product = product::findOrFail($id);
        if ($product->image1) {
            storage::delete($product->image1);
        }
        if ($product->image2) {
            storage::delete($product->image2);
        }
        if ($product->image3) {
            storage::delete($product->image3);
        }
        if ($product->image4) {
            storage::delete($product->image4);
        }
        if ($product->image5) {
            storage::delete($product->image5);
        }

        $product->delete();
        return redirect(url('products'))->with('success', 'data deleted ssuccessfully');
    }
    function edit($id)
    {
        $product = product::findOrFail($id);

        return view('admin.edit', compact('product'));
    }
    function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'string',
            'desc' => 'string',
            'price' => 'numeric',
            'quantity' => 'string',
            'salePrice' => 'numeric',
            'sale' => 'string',
            'image1' => 'image|mimes:jpg,png,jpeg',
            'image2' => 'image|mimes:jpg,png,jpeg',
            'image3' => 'image|mimes:jpg,png,jpeg',
            'image4' => 'image|mimes:jpg,png,jpeg',
            'image5' => 'image|mimes:jpg,png,jpeg',
            'category' => 'string',
        ]);
        $product = product::findOrFail($id);
        if ($request->has('image1')) {
            Storage::delete($product->image);
            $data['image1'] = Storage::putFile('products', $data['image1']);
        }
        if ($request->has('image2')) {
            Storage::delete($product->image);
            $data['image2'] = Storage::putFile('products', $data['image2']);
        }
        if ($request->has('image3')) {
            Storage::delete($product->image);
            $data['image3'] = Storage::putFile('products', $data['image3']);
        }
        if ($request->has('image4')) {
            Storage::delete($product->image);
            $data['image4'] = Storage::putFile('products', $data['image4']);
        }
        if ($request->has('image5')) {
            Storage::delete($product->image);
            $data['image5'] = Storage::putFile('products', $data['image5']);
        }
        $product->update($data);

        return redirect(url('products'))->with('success', 'data updated ssuccessfully');
    }
    function curnncy()
    {
        $currncy = currncy::all();
        return view('admin.currncy', compact('currncy'));
    }
    function editCurrncy($id)
    {
        $currncy = currncy::findOrFail($id);

        return view('admin.editCurnncy',compact('currncy'));
    }
    function updateCurnncy( Request $request,$id)
    {
        $data = $request->validate([
            'exchange_rate' => 'string',

        ]);
        $currncy = currncy::findOrFail($id);
        $currncy->update($data);
        // $currncy = currncy::all();
        return redirect(url('curnncy'))->with('success', 'data updated ssuccessfully');
    }




    //user page
    function userAllProducts()
    {
        $products = product::all();

        return view('user.allProducts', compact('products'));
    }
    function productDetail($id)
    {
        $product = product::findOrFail($id);
        $allProducts = product::all();
        return view('user.productDetail', compact('product'), compact('allProducts'));
    }





    //categories
    function skirt()
    {
        $products = DB::table('products')->where('category', 'skirt')->get();
        return view('user.skirt')->with('products', $products);
    }
    function dress()
    {
        $products = DB::table('products')->where('category', 'dress')->get();
        return view('user.dress')->with('products', $products);
    }
    function swimmingWear()
    {
        $products = DB::table('products')->where('category', 'swimming wear')->get();
        return view('user.dress')->with('products', $products);
    }
    function blouses()
    {
        $products = DB::table('products')->where('category', 'blouses')->get();
        return view('user.dress')->with('products', $products);
    }
    function sales()
    {
        // $products = product::all();
        $products = DB::table('products')->where('sale', 'sale')->get();
        return view('user.sales')->with('products', $products);
    }

















    //cart page
    function addToCart(Request $request)
    {

        if ($request->salePrice) {
            if ($request->session()->has('user')) {
                $cart = new Cart;
                $cart->user_id = $request->session()->get('user')['id'];
                $cart->product_id = $request->product_id;
                $cart->size = $request->size;
                $cart->quantity = $request->quantity;
                $cart->price = $request->salePrice;
                $cart->category = $request->category;
                $cart->image1 = $request->image1;
                $cart->name = $request->name;
                $cart->description = $request->desc;
                $cart->save();

                $products = product::all();
                Session::flash('addedToCart', 'your product is added to cart ');
                return view('user.allProducts', compact('products'));
            } else {
                $request->session()->put('message', 'plesae login so you can add product to your cart');
                return view('Auth.login');
            }
        } else {


            if ($request->session()->has('user')) {
                $cart = new Cart;
                $cart->user_id = $request->session()->get('user')['id'];
                $cart->product_id = $request->product_id;
                $cart->size = $request->size;
                $cart->quantity = $request->quantity;
                $cart->price = $request->price;
                $cart->category = $request->category;
                $cart->image1 = $request->image1;
                $cart->name = $request->name;
                $cart->description = $request->desc;
                $cart->save();

                $products = product::all();
                Session::flash('addedToCart', 'your product is added to cart ');
                return view('user.allProducts', compact('products'));
            } else {
                $request->session()->put('message', 'plesae login so you can add product to your cart');
                return view('Auth.login');
            }
        }
    }
    static function cartItem()
    {
        $userId = Session::get('user')['id'];
        return Cart::where('user_id', $userId)->count();
    }
    function cartList()
    {

        if (Session::has('user')) {

            $userId = Session::get('user')['id'];
            $products = DB::table('cart')->where('cart.user_id', $userId)->get();
            $totalPrice = DB::table('cart')->where('cart.user_id', $userId)->sum('price');
            $result = DB::table('cart')
                ->where('user_id', $userId)
                ->select(DB::raw('SUM(price * quantity)  as Result'))
                ->first();
            return view('user.cartList')->with('products', $products)->with('result', $result);
        } else {
            $products = product::all();
            $time = '4500';
            return view('user.allProducts')->with('products', $products)->with('time', $time);
        }
    }
    function removeCart($id)
    {
        Cart::destroy($id);

        $userId = Session::get('user')['id'];
        $products = DB::table('cart')->where('cart.user_id', $userId)->get();
        $result = DB::table('cart')
            ->where('user_id', 2)
            ->select(DB::raw('SUM(price * quantity)  as Result'))
            ->first();
        return view('user.cartList')->with('products', $products)->with('result', $result);
    }






    //chechkout
    function chechkOut()
    {
        $userId = Session::get('user')['id'];
        $products = DB::table('cart')->where('cart.user_id', $userId)->get();
        $totalPrice = DB::table('cart')->where('cart.user_id', $userId)->sum('price');
        $result = DB::table('cart')
            ->where('user_id', $userId)
            ->select(DB::raw('SUM(price * quantity)  as Result'))
            ->first();
        return view('user.chechkOut')->with('products', $products)->with('result', $result);
        // return view('user.chechkOut');
    }
    function order(Request $request)
    {


        $data = $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'phoneNumber' => 'required',
            'secondPhoneNumber' => 'string',
            'adress' => 'required',
            'country' => 'required',
            'city' => 'required',
        ]);


        $userId = $request->session()->get('user')['id'];

        $order = new Order;
        $order->firstName = $request->firstName;
        $order->lastName = $request->lastName;
        $order->phoneNumber = $request->phoneNumber;
        $order->secondPhoneNumber = $request->secondPhoneNumber;
        $order->adress = $request->adress;
        $order->country = $request->country;
        $order->city = $request->city;

        $order->save();

        $cartItem = Cart::where('user_id', $userId)->get();
        foreach ($cartItem as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'name' => $item->name,
                'quantity' => $item->quantity,
                'size' => $item->size,
                'price' => $item->price,
                'image' => $item->image1,
            ]);
        }

        Cart::destroy($cartItem);
        $products = product::all();
        Session::flash('orderStatus', 'order placed succusfully ');
        return view('user.allProducts')->with('products', $products);
    }







    //admin order
    function adminOrders()
    {
        $orders = Order::all();
        return view('admin.order', compact('orders'));
    }
    function editOrder($id)
    {
        $orders = Order::findOrFail($id);

        return view('admin.orderEdit', compact('orders'));
    }
    function updateOrder(Request $request, $id)
    {
        $data = $request->validate([
            'status' => 'string',
        ]);
        $orders = Order::findOrFail($id);
        $orders->update($data);
        return redirect('adminOrders')->with('success', 'data updated succfully');
    }
    function viewOrder($id)
    {
        $orderId = $id;
        $orderItems = DB::table('order_items')->where('order_id', $orderId)->get();
        return view('admin.veiwOrder', compact('orderItems'));
    }
    function pendingOrder()
    {
        $orders = DB::table('orders')->where('status', 'pending')->get();
        return view('admin.pendingOrder', compact('orders'));
    }
    function deliveredOrder()
    {
        $orders = DB::table('orders')->where('status', 'delivered')->get();
        return view('admin.deliveredOrder', compact('orders'));
    }






    //currency
    function convertCurrnecy(Request $request)
    {
        $products = product::all();
        // return $request->currnecy;
        $currencies = DB::table('currncies')
            ->where('currncy_code', $request->currnecy)
            ->value('exchange_rate');
        $currenciesWord = $request->currnecy;
        $request->session()->pull('currencies', 'correct');
        return view('user.CallProducts')->with('currencies', $currencies)->with('currenciesWord', $currenciesWord)->with('products', $products);
    }
    function convertCurrnecyDet(Request $request, $id)
    {
        $product = product::findOrFail($id);
        $allProducts = product::all();
        // return $request->currnecy;
        $currencies = DB::table('currncies')
            ->where('currncy_code', $request->currnecy)
            ->value('exchange_rate');
        $currenciesWord = $request->currnecy;
        $request->session()->pull('currencies', 'correct');
        return view('user.currncyDet')->with('currencies', $currencies)->with('currenciesWord', $currenciesWord)->with('product', $product)->with('allProducts', $allProducts);
    }
    function convertCurrnecyCart(Request $request)
    {

        if (Session::has('user')) {
            $currencies = DB::table('currncies')
                ->where('currncy_code', $request->currnecy)
                ->value('exchange_rate');
            $currenciesWord = $request->currnecy;
            $userId = Session::get('user')['id'];
            $products = DB::table('cart')->where('cart.user_id', $userId)->get();
            $totalPrice = DB::table('cart')->where('cart.user_id', $userId)->sum('price');
            $result = DB::table('cart')
                ->where('user_id', $userId)
                ->select(DB::raw('SUM(price * quantity)  as Result'))
                ->first();
            return view('user.cartlistCurrn')->with('products', $products)->with('currencies', $currencies)->with('currenciesWord', $currenciesWord)->with('result', $result);
        } else {
            $products = product::all();
            $time = '4500';
            return view('user.allProducts')->with('products', $products)->with('time', $time);
        }
    }
}
