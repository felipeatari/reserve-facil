<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Services\HomeService;

class HomeController extends Controller
{
    /**
     * Carrega os hotéis com os quartos disponíveis.
     *
     * @return void
     */
    public function index()
    {
        return (new HomeService)->index();
    }

    /**
     * Carrega um hotel especifico com os quartos disponíveis.
     *
     * @param Hotel $hotel Instância do model Hotel
     *
     * @return void
     */
    public function show(Hotel $hotel)
    {
        return (new HomeService)->show($hotel);
    }

    /**
     * Carrega os quartos disponíveis sob demanda
     *
     * @param Hotel $hotel Instância do model Hotel
     * @param integer $more Quandidade de quartos no carregamento
     *
     * @return void
     */
    public function moreRooms(Hotel $hotel, int $more = 3)
    {
        return response()->json($hotel->rooms()->limit($more)->get());
    }
}
