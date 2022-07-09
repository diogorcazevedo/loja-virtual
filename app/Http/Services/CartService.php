<?php
/**
 * Created by PhpStorm.
 * User: diogoazevedo
 * Date: 23/11/15
 * Time: 22:30
 */

namespace App\Http\Services;


use App\Models\Product;
use Illuminate\Support\Facades\Session;

class CartService
{

    private $items;

    public function __construct()
    {
       $this->items =[];
    }


    public function add($id,$name,$price,$aro1,$aro2)
    {
        $product = Product::find($id);
        $urlImg = $product->images->where('image_type_id',50 )->first()->id.'.'.$product->images->where('image_type_id',50 )->first()->extension;
        if (isset($this->items[$id]['qtd'])){
            $qtd = $this->items[$id]['qtd'] +1;
        }else{
            $qtd = 1;
        }
        unset($this->items[$id]);

        $this->items += [
            $id =>[
                'qtd'     =>$qtd,
                'price'   =>$price,
                'aro1'    =>$aro1,
                'aro2'    =>$aro2,
                'name'    =>$name,
                'urlImg'  =>$urlImg,
            ]
        ];

        return $this->items;
    }

    public function remove($id)
    {
        unset($this->items[$id]);

    }


    public function all()
    {
        return $this->items;

    }

    public function getTotal()
    {
        $total = 0;
        foreach($this->items as $items){
            $total+=$items['qtd'] * $items['price'];
        }
        return $total;
    }

    public function getTotalItems()
    {
        $qtd = 0;
        foreach($this->items as $items){
            $qtd=  $items['qtd'] + $qtd;
        }
        return $qtd;
    }

    public function clear()
    {
        $this->items = [];

    }


}
