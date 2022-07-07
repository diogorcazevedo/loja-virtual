<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Product;
use Inertia\Inertia;


class HomeController extends Controller
{

    public function index(){

        $destaques = Collection::with(['images' => function($q) {
                                    $q->where('image_type_id',3 );
                                }]) ->where('principal',1)
                                    ->orderBy('line_up')
                                    ->get();


        return Inertia::render('Index',[
            'destaques'=>$destaques,
        ]);
    }
}
