<?php

namespace App\Http\Controllers;


use App\Models\Clip;
use App\Models\Company;
use App\Models\Destaque;
use App\Models\Event;
use App\Http\Services\FacebookApiConversoesService;
use Illuminate\Support\Facades\Session;

class InstitucionalController extends Controller
{

    /**
     * @var FacebookApiConversoesService
     */
    private $apiConversoesService;

    /**
     * InstitucionalController constructor.
     */
    public function __construct(FacebookApiConversoesService $apiConversoesService)
    {
        if(Session::has('cart')){
            $cart = Session::get('cart');
        }else{
            $cart = NULL;
        }

        $this->apiConversoesService = $apiConversoesService;
    }

    public function index()
    {
        $cart = $this->cart();
        $this->PageView($this->apiConversoesService);
        return view('institucional.index',compact('cart'));
    }

    public function devolucao_reembolso()
    {
        $cart = $this->cart();
        $this->PageView($this->apiConversoesService);
        return view('institucional.devolucao_reembolso',compact('cart'));
    }
    public function termos_de_servico()
    {
        $cart = $this->cart();
        $this->PageView($this->apiConversoesService);
        return view('institucional.termos_de_servico',compact('cart'));
    }
    public function frete()
    {
        $cart = $this->cart();
        $this->PageView($this->apiConversoesService);
        return view('institucional.frete',compact('cart'));
    }
    public function garantia()
    {
        $cart = $this->cart();
        $this->PageView($this->apiConversoesService);
        return view('institucional.garantia',compact('cart'));
    }

    public function politica_de_privacidade()
    {
        $cart = $this->cart();
        $this->PageView($this->apiConversoesService);
        return view('institucional.politica_de_privacidade',compact('cart'));
    }

    public function designer()
    {
        $cart = $this->cart();
        $company_main = Company::where('main', 1)->first();
        $apresentacao =$company_main->images->where('image_type_id',100)->sortByDesc('id')->first();
        $this->PageView($this->apiConversoesService);
        return view('institucional.designer',compact('cart','apresentacao'));
    }

    public function destaque(Destaque $destaque)
    {
        $cart = $this->cart();
        $image = $destaque->images->where('image_type_id',102)->sortByDesc('id')->first();
        $this->PageView($this->apiConversoesService);
        return view('institucional.destaque',compact('cart','destaque', 'image'));

    }
    public function enderecos()
    {
        $cart = $this->cart();
        $this->PageView($this->apiConversoesService);
        return view('institucional.enderecos',compact('cart'));
    }

    public function clipping()
    {
        $cart = $this->cart();
        $clips = Clip::all();
        $this->PageView($this->apiConversoesService);
        return view('institucional.clipping',compact('clips','cart'));
    }

    public function clip(Clip $clip)
    {
        $cart = $this->cart();
        $this->PageView($this->apiConversoesService);
        return view('institucional.clip',compact('clip','cart'));
    }

    public function events()
    {
        $events = Event::all();
        $cart = $this->cart();
        $this->PageView($this->apiConversoesService);
        return view('institucional.events',compact('events','cart'));
    }

    public function event(Event $event)
    {
        $cart = $this->cart();
        $this->PageView($this->apiConversoesService);
        return view('institucional.event',compact('event','cart'));
    }

    public function peoples()
    {
        $clips = Clip::all();
        $cart = $this->cart();
        $this->PageView($this->apiConversoesService);
        return view('institucional.peoples',compact('clips','cart'));
    }

    public function people(Clip $clip)
    {
        $cart = $this->cart();
        $this->PageView($this->apiConversoesService);
        return view('institucional.people',compact('clip','cart'));
    }

    /**
     * @return mixed|null
     */
    public function cart()
    {
        if (Session::has('cart')) {
            $cart = Session::get('cart');
        } else {
            $cart = NULL;
        }
        return $cart;
    }

    /**
     * @param FacebookApiConversoesService $apiConversoesService
     */
    public function PageView(FacebookApiConversoesService $apiConversoesService): void
    {
        $event_name = 'PageView';
        $event_url = url()->current();


        if (auth()->check()) {
            $user = auth()->user();
            $apiConversoesService->check($user, $event_name, $event_url);
        } else {
            $apiConversoesService->dont_check($event_name, $event_url);
        }
    }

}
