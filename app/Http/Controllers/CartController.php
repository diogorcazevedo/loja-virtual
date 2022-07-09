<?php

namespace App\Http\Controllers;

use App\Http\Services\CartService;
use App\Http\Services\FacebookApiConversoesService;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * @var CartService
     */
    private $cartService;

    /**
     * @var FacebookApiConversoesService
     */
    private $apiConversoesService;

    public function __construct(CartService $cartService,FacebookApiConversoesService $apiConversoesService)
    {
        $this->cartService = $cartService;
        $this->apiConversoesService = $apiConversoesService;
    }



    public function get_session()
    {
        if(!Session::has('cart')){
            Session::put('cart',$this->cartService);
        }

        if(count(Session::get('cart')->all()) < 1){
            return redirect()->back()->with('message','carrinho vazio');
        }

        return redirect()->route('payment.index');
    }

    public function add(Product $product,$redirect)
    {
        $this->put($product);
        if ($redirect==1){
            return redirect()->back()->with('message','ADICIONADO AO CARRINHO');
        }else{
            return redirect()->route('store.cart')->with('message','ADICIONADO AO CARRINHO');
        }
    }

    public function remove($id)
    {
        $cart = $this->getCart();
        $cart->remove($id);
        Session::put('cart',$cart);
        return redirect()->route('cart.home')->with('message','Removido com sucesso');
    }

    public function aro($aro, $tamanho)
    {
        Session::put($aro, $tamanho);
        return redirect()->back();
    }

    public function aro_destruir($aro)
    {
        Session::forget($aro);
        return redirect()->back();
    }




    /**
     * @param Product $product
     */
    private function put(Product $product,$aro1=NULL,$aro2=NULL)
    {
        $cart = $this->getCart();

        if (Session::has('aro1')) {
            $aro1 = Session::get('aro1');
        }
        if (Session::has('aro2')) {
            $aro2 = Session::get('aro2');
        }
        $cart->add($product->id, $product->name, $product->stock->offered_price,$aro1,$aro2);
        Session::put('cart', $cart);

    }

    /**
     * @return Cart
     */
    public function getCart()
    {
        if (Session::has('cart')) {
            $cart = Session::get('cart');
        } else {
            $cart = $this->cartService;
        }
        return $cart;
    }


}
