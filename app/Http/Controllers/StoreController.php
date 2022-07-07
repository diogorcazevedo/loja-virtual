<?php

namespace App\Http\Controllers;


use App\Http\Services\CartService;
use App\Http\Services\FacebookApiConversoesService;
use App\Models\Lead;
use App\Models\OperadoraCartoes;
use App\Models\Order;
use App\Models\OrderData;
use App\Models\OrderItems;
use App\Models\Product;
use App\Models\State;
use App\Models\TinyPedido;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use App\Models\Collection;


class StoreController extends Controller
{

    public function index(){

        $carrinho = $this->carrinho();

        $collections = Collection::whereHas('images' , function($q) {
            $q->where('image_type_id',3 );
            })->whereHas('products' , function($q) {
            $q->where('sale',1 )->whereHas('images',function($q){
                $q->where('image_type_id',50 );
            })->has('stock');
             });

        $collections = $collections->with(['images' => function($q) {
            $q->where('image_type_id',3 );
            }])->with(['products' => function($q) {
            $q->where('sale',1 )->with(['images'=>function($q){
                $q->where('image_type_id',50 );
            }])->with('stock');
             }])
            ->where('principal',1)->orderBy('line_up','asc')
            ->get();

        return Inertia::render('Store/Index',[
            'carrinho'=>$carrinho,
            'collections'=>$collections,
        ]);
    }


    public function collections(){

        $carrinho = $this->carrinho();

        $destaques = Collection::with(['images' => function($q) {
            $q->where('image_type_id',3 );
        }]) ->where('principal',1)
            ->orderBy('line_up','desc')
            ->get();

        $outras = Collection::with(['images' => function($q) {
            $q->where('image_type_id',3 );
        }])->where('principal','!=',1)
            ->orderBy('line_up','asc')
            ->get();


        return Inertia::render('Store/Collections',[
            'carrinho'=>$carrinho,
            'destaques'=>$destaques,
            'outras'=>$outras,
        ]);
    }


    public function collection(Collection $collection){

        $carrinho = $this->carrinho();
        $image = $collection->images->where('image_type_id',3 )->first();

        $products = $collection->products()->whereHas('images', function($q){
            $q->where('image_type_id',50 );
        })->has('stock');

        $products = $products->with('images')->with('stock')->get();

        
        return Inertia::render('Store/Collection',[
            'carrinho'=>$carrinho,
            'collection'=>$collection,
            'products'=>$products,
            'image'=>$image,
        ]);
    }


    public function product(Product $product){

        $carrinho = $this->carrinho();
        $stock = $product->stock;
        if ($product->images->where('image_type_id',503)->count()>0){
            $images = $product->images->whereIn('image_type_id',['503','502']);
        }else{
            $images = $product->images->whereIn('image_type_id',['50','502']);
        }

        return Inertia::render('Store/Product',[
            'carrinho'=>$carrinho,
            'product'=>$product,
            'images'=>$images,
            'stock'=>$stock,
        ]);
    }



    public function cart(CartService $cartService)
    {
        if(!Session::has('cart')){
            Session::put('cart',$cartService);
        }

        $session    = Session::get('cart');
        $cart       = $session->all();
        $total      = $session->getTotal();


    
        return Inertia::render('Store/Cart',[
            'cart'=>$cart,
            'total'=>$total
        ]);
    }


    public function order()
    {
        $states = State::all();
        return Inertia::render('Store/Order',[
            'states'=>$states,
        ]);

    }
    public function checkout(Order $order,$operadora=null)
    {
        $user  = $order->user;
        $items = OrderItems::where('order_id',$order->id)->with('product')->get();

        if($operadora == null){
            $operadora = OperadoraCartoes::where('main',1)->first();
        }else{
            $operadora = OperadoraCartoes::find($operadora);
        }
        return Inertia::render('Store/Checkout',[
            'order'     => $order,
            'user'      => $user,
            'items'     => $items,
            'operadora' => $operadora,
        ]);

    }

    public function exception(OrderData $orderData)
    {
        $order   = Order::find($orderData->order_id);
        $client  = User::find($orderData->user_id);
        $items = OrderItems::where('order_id',$order->id)->with('product')->get();


        return Inertia::render('Store/Exception',[
            'order_data'=> $orderData,
            'order'     => $order,
            'client'    => $client,
            'items'     => $items,
        ]);

    }

    public function success(OrderData $orderData)
    {
        $order          = Order::find($orderData->order_id);
        $client         = User::find($orderData->user_id);
        $items          = OrderItems::where('order_id',$order->id)->with('product')->get();
        $tiny_pedido    = TinyPedido::find($order->tiny_pedido->id);

        return Inertia::render('Store/Success',[
            'order_data'    => $orderData,
            'order'         => $order,
            'client'        => $client,
            'items'         => $items,
            'tiny_pedido'   => $tiny_pedido,
        ]);

    }


    public function carrinho()
    {
        if (Session::has('cart')) {
            $cart = Session::get('cart');
        } else {
            $cart = NULL;
        }
        return $cart;
    }


}
