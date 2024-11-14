<?php

namespace App\Http\Controllers;

use App\Helpers\PaginationHelper;
use App\Models\Hotel;
use App\Services\HomeService;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class HomeController extends Controller
{
    /**
     * Carrega os hotéis com os quartos disponíveis.
     *
     * @return void
     */
    public function index()
    {
        $hotel = Hotel::query()
        ->orderBy('id', 'DESC')
        ->paginate(9, pageName: 'pagina'); // Altera nome padrão de "page" para "página"

        foreach ($hotel->items() as $hotelItem) {
            $hotelItem->roomsCount = $hotelItem->rooms()->count();
        }

        return Inertia::render('Home/Index', [
            'user' => Auth::user(),
            'hotel' => $hotel,
            'pagination' => (new PaginationHelper($hotel, 3))
        ]);
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
        $rooms = $hotel->rooms()->limit(3)->get();
        $countRooms = $hotel->rooms()->count();

        return Inertia::render('Home/Show', [
            'user' => Auth::user(),
            'hotel' => $hotel,
            'countRooms' => $countRooms,
            'rooms' => $rooms,
        ]);
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
