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
    public function index(Request $request)
    {
        $room = Room::query()
            ->orderBy('id', 'DESC')
            ->paginate(6, pageName: 'pagina');

        return Inertia::render('Room/Index', [
            'room' => $room,
            'page' => $request->get('pagina') ?? '1',
        ]);
    }

    public function show(Room $room, Request $request)
    {
        $hotelName = $room->hotel()->select(['name'])->first()->name;

        $room->created = $room->created_at->format('d/m/Y H:i:s');
        $room->updated = $room->updated_at->format('d/m/Y H:i:s');

        return Inertia::render('Room/Show', [
            'room' => $room,
            'hotelName' => $hotelName,
            'page' => $request->get('pagina') ?? '1',
        ]);
    }

    public function storeScreen(Request $request)
    {
        $hotels = Hotel::query()
            ->select(['id', 'name'])
            ->orderBy('id', 'desc')
            ->get();

        return Inertia::render('Room/Store', [
        ]);
    }

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

    public function updateScreen(Room $room, Request $request)
    {
        $hotels = Hotel::query()
            ->select(['id', 'name'])
            ->orderBy('id', 'desc')
            ->get();

        return Inertia::render('Room/Update', [
            'room' => $room,
            'hotels' => $hotels,
        ]);
    }

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
