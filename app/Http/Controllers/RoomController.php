<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomRequest;
use App\Models\Hotel;
use App\Models\Room;
use App\Services\RoomService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class RoomController extends Controller
{
    /**
     * Carrega todos os quartos disponíveis com paginação e dados parciais
     *
     * @param Request $request
     *
     * @return void
     */
    public function index(Request $request)
    {
        return (new RoomService)->index($request);
    }

    /**
     * Carrega um quarto especifico com os dados completos
     *
     * @param Room $room
     * @param Request $request
     *
     * @return void
     */
    public function show(Room $room, Request $request)
    {
        return (new RoomService)->show($room, $request);
    }

    /**
     * Carrega a tela para cadastrar um quarto
     *
     * @return void
     */
    public function storeScreen()
    {
        $hotels = Hotel::query()
            ->select(['id', 'name'])
            ->orderBy('id', 'desc')
            ->get();

        return Inertia::render('Room/Store', [
            'user' => Auth::user(),
            'hotels' => $hotels,
        ]);
    }

    /**
     * Cadastra um quarto
     *
     * @param RoomRequest $request
     *
     * @return void
     */
    public function store(RoomRequest $request)
    {
        return (new RoomService)->store($request);
    }

    /**
     * Carrega a tela para editar um quarto
     *
     * @return void
     */
    public function updateScreen(Room $room)
    {
        $hotels = Hotel::query()
        ->select(['id', 'name'])
        ->orderBy('id', 'desc')
        ->get();

        return Inertia::render('Room/Update', [
            'user' => Auth::user(),
            'room' => $room,
            'hotels' => $hotels,
        ]);
    }

    /**
     * Edita um quarto
     *
     * @param Room $room
     * @param RoomRequest $request
     *
     * @return void
     */
    public function update(Room $room, RoomRequest $request)
    {
        return (new RoomService)->update($room, $request);
    }

    /**
     * Apaga um quarto
     *
     * @param Room $room
     *
     * @return void
     */
    public function destroy(Room $room)
    {
        return (new RoomService)->destroy($room);
    }
}
