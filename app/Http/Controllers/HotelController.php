<?php

namespace App\Http\Controllers;

use App\Http\Requests\HotelRequest;
use App\Models\Hotel;
use App\Services\HotelService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class HotelController extends Controller
{
    public function index(Request $request)
    {
        $hotel = Hotel::query()
            ->orderBy('id', 'DESC')
            ->paginate(6, pageName: 'pagina');

        return Inertia::render('Hotel/Index', [
            'hotel' => $hotel,
            'page' => $request->get('pagina') ?? '1',
        ]);
    }

    public function show(Hotel $hotel, Request $request)
    {
        $hotel->created = $hotel->created_at->format('d/m/Y H:i:s');
        $hotel->updated = $hotel->updated_at->format('d/m/Y H:i:s');

        return Inertia::render('Hotel/Show', [
            'hotel' => $hotel,
            'page' => $request->get('pagina') ?? '1',
        ]);
    }

    public function storeScreen(Request $request)
    {
        return Inertia::render('Hotel/Store');
    }

    public function store(HotelRequest $request)
    {
        if (! $inputs = $request->validated()) {
            return back();
        }

        DB::beginTransaction();

        try {
            Hotel::create([
                'name' => $inputs['name'],
                'address' => $inputs['address'],
                'city' => $inputs['city'],
                'state' => $inputs['state'],
                'zip_code' => $inputs['zip_code'],
                'website' => $inputs['website'],
            ]);

            DB::commit();

            return redirect('/hotel/listar');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withErrors([
                'error505' => $e->getMessage(),
            ]);
        }
    }

    public function updateScreen(Hotel $hotel, Request $request)
    {
        return Inertia::render('Hotel/Update', [
            'hotel' => $hotel
        ]);
    }

    public function update(Hotel $hotel, HotelRequest $request)
    {
        if (! $inputs = $request->validated()) return back();

        DB::beginTransaction();

        try {
            $hotel->name = $inputs['name'];
            $hotel->address = $inputs['address'];
            $hotel->city = $inputs['city'];
            $hotel->state = $inputs['state'];
            $hotel->zip_code = $inputs['zip_code'];
            $hotel->website = $inputs['website'];
            $hotel->save();

            DB::commit();

            return redirect('/hotel/ver/' . $hotel->id);
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withErrors([
                'error505' => $e->getMessage(),
            ]);
        }
    }

    public function destroy(Hotel $hotel)
    {
        DB::beginTransaction();

        try {
            $hotel->delete();

            DB::commit();

            return redirect('/hotel/listar');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withErrors([
                'error505' => $e->getMessage(),
            ]);
        }
    }
}
