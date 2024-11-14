<?php

namespace App\Http\Controllers;

use App\Helpers\PaginationHelper;
use App\Http\Requests\HotelRequest;
use App\Models\Hotel;
use App\Services\HotelService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $hotels = Hotel::query()
            ->orderBy('id', 'DESC')
            ->paginate(6, pageName: 'pagina'); // Altera nome padrão de "page" para "página"

        return Inertia::render('Hotel/Index', [
            'user' => fn () => $request->user()
                ? $request->user()->only('id', 'name', 'email')
                : null,
            'hotels' => $hotels,
            'pagination' => (new PaginationHelper($hotels, 3)),
            'page' => $request->get('pagina') ?? '1',
        ]);
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
        $hotel->created = $hotel->created_at->format('d/m/Y H:i:s');
        $hotel->updated = $hotel->updated_at->format('d/m/Y H:i:s');

        return Inertia::render('Hotel/Show', [
            'user' => fn () => $request->user()
                ? $request->user()->only('id', 'name', 'email')
                : null,
            'hotel' => $hotel,
            'page' => $request->get('pagina') ?? '1',
        ]);
    }

    /**
     * Carrega a tela para cadastrar um hotel
     *
     * @return void
     */
    public function storeScreen()
    {
        return Inertia::render('Hotel/Store', [
            'user' => fn () => $request->user()
                ? $request->user()->only('id', 'name', 'email')
                : null,
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

    /**
     * Carrega a tela para editar um hotel
     *
     * @return void
     */
    public function updateScreen(Hotel $hotel)
    {
        return Inertia::render('Hotel/Update', [
            'user' => fn () => $request->user()
                ? $request->user()->only('id', 'name', 'email')
                : null,
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

    /**
     * Apaga um hotel
     *
     * @param Hotel $hotel
     *
     * @return void
     */
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
