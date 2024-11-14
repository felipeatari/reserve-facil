<?php

namespace App\Http\Controllers;

use App\Helpers\PaginationHelper;
use App\Http\Requests\RoomRequest;
use App\Models\Hotel;
use App\Models\Room;
use App\Services\RoomService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $rooms = Room::query()
            ->orderBy('id', 'DESC')
            ->paginate(6, pageName: 'pagina'); // Altera nome padrão de "page" para "página"

        return Inertia::render('Room/Index', [
            'user' => fn () => $request->user()
                ? $request->user()->only('id', 'name', 'email')
                : null,
            'rooms' => $rooms,
            'pagination' => (new PaginationHelper($rooms, 3)),
            'page' => $request->get('pagina') ?? '1',
        ]);
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
        $hotelName = $room->hotel()->select(['name'])->first()->name;

        $room->created = $room->created_at->format('d/m/Y H:i:s');
        $room->updated = $room->updated_at->format('d/m/Y H:i:s');

        return Inertia::render('Room/Show', [
            'user' => fn () => $request->user()
                ? $request->user()->only('id', 'name', 'email')
                : null,
            'room' => $room,
            'hotelName' => $hotelName,
            'page' => $request->get('pagina') ?? '1',
        ]);
    }

    /**
     * Carrega a tela para cadastrar um quarto
     *
     * @return void
     */
    public function storeScreen(Request $request)
    {
        $hotels = Hotel::query()
            ->select(['id', 'name'])
            ->orderBy('id', 'desc')
            ->get();

        return Inertia::render('Room/Store', [
            'user' => fn () => $request->user()
                ? $request->user()->only('id', 'name', 'email')
                : null,            'hotels' => $hotels,
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
        if (! $inputs = $request->validated()) {
            return back();
        }

        DB::beginTransaction();

        try {
            Room::create([
                'hotel_id' => $inputs['hotel_id'],
                'name' => $inputs['name'],
                'description' => $inputs['description'],
            ]);

            DB::commit();

            return redirect('/quarto/listar');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withErrors([
                'error505' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Carrega a tela para editar um quarto
     *
     * @return void
     */
    public function updateScreen(Room $room, Request $request)
    {
        $hotels = Hotel::query()
            ->select(['id', 'name'])
            ->orderBy('id', 'desc')
            ->get();

        return Inertia::render('Room/Update', [
            'user' => fn () => $request->user()
                ? $request->user()->only('id', 'name', 'email')
                : null,            'room' => $room,
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
        if (! $inputs = $request->validated()) return back();

        DB::beginTransaction();

        try {
            $room->hotel_id = $inputs['hotel_id'];
            $room->name = $inputs['name'];
            $room->description = $inputs['description'];
            $room->save();

            DB::commit();

            return redirect('/quarto/ver/' . $room->id);
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withErrors([
                'error505' => $e->getMessage(),
            ]);
        }
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
        DB::beginTransaction();

        try {
            $room->delete();

            DB::commit();

            return redirect('/quarto/listar');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withErrors([
                'error505' => $e->getMessage(),
            ]);
        }
    }
}
