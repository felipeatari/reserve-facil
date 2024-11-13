<?php

namespace App\Http\Controllers;

use App\Http\Requests\HotelRequest;
use App\Models\Hotel;
use App\Services\HotelService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class HotelController extends Controller
{
    /**
     * Carrega todos os hotéis disponíveis com paginação e dados parciais
     *
     * @param Request $request
     *
     * @return void
     */
    public function index(Request $request)
    {
        return (new HotelService)->index($request);
    }

    /**
     * Carrega um hotel especifico com os dados completos
     *
     * @param Hotel $hotel
     * @param Request $request
     *
     * @return void
     */
    public function show(Hotel $hotel, Request $request)
    {
        return (new HotelService)->show($hotel, $request);
    }

    /**
     * Carrega a tela para cadastrar um hotel
     *
     * @return void
     */
    public function storeScreen()
    {
        return Inertia::render('Hotel/Store', [
            'user' => Auth::user(),
        ]);
    }

    /**
     * Cadastra um hotel
     *
     * @param HotelRequest $request
     *
     * @return void
     */
    public function store(HotelRequest $request)
    {
        return (new HotelService)->store($request);
    }

    /**
     * Carrega a tela para editar um hotel
     *
     * @return void
     */
    public function updateScreen(Hotel $hotel)
    {
        return Inertia::render('Hotel/Update', [
            'user' => Auth::user(),
            'hotel' => $hotel
        ]);
    }

    /**
     * Edita um hotel
     *
     * @param Hotel $hotel
     * @param HotelRequest $request
     *
     * @return void
     */
    public function update(Hotel $hotel, HotelRequest $request)
    {
        return (new HotelService)->update($hotel, $request);
    }

    /**
     * Apaga um hotel
     *
     * @param Hotel $hotel
     *
     * @return void
     */
    public function destroy(Hotel $hotel)
    {
        return (new HotelService)->destroy($hotel);
    }
}
