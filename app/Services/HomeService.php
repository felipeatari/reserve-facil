<?php

namespace App\Services;

use App\Helpers\PaginationHelper;
use App\Models\Hotel;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class HomeService
{
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
}
