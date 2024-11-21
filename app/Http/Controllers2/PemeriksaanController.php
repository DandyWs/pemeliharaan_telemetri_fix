<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Pemeriksaan;
use Illuminate\Http\Request;
use App\Models\Pemeliharaan2;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\PemeriksaanStoreRequest;
use App\Http\Requests\PemeriksaanUpdateRequest;

class PemeriksaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Pemeriksaan::class);

        $search = $request->get('search', '');

        $pemeriksaans = Pemeriksaan::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.pemeriksaans.index',
            compact('pemeriksaans', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Pemeriksaan::class);

        $pemeliharaan2s = Pemeliharaan2::pluck('periode', 'id');

        return view('app.pemeriksaans.create', compact('pemeliharaan2s'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PemeriksaanStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Pemeriksaan::class);

        $validated = $request->validated();

        $pemeriksaan = Pemeriksaan::create($validated);

        return redirect()
            ->route('pemeriksaans.edit', $pemeriksaan)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Pemeriksaan $pemeriksaan): View
    {
        $this->authorize('view', $pemeriksaan);

        return view('app.pemeriksaans.show', compact('pemeriksaan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Pemeriksaan $pemeriksaan): View
    {
        $this->authorize('update', $pemeriksaan);

        $pemeliharaan2s = Pemeliharaan2::pluck('periode', 'id');

        return view(
            'app.pemeriksaans.edit',
            compact('pemeriksaan', 'pemeliharaan2s')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        PemeriksaanUpdateRequest $request,
        Pemeriksaan $pemeriksaan
    ): RedirectResponse {
        $this->authorize('update', $pemeriksaan);

        $validated = $request->validated();

        $pemeriksaan->update($validated);

        return redirect()
            ->route('pemeriksaans.edit', $pemeriksaan)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Pemeriksaan $pemeriksaan
    ): RedirectResponse {
        $this->authorize('delete', $pemeriksaan);

        $pemeriksaan->delete();

        return redirect()
            ->route('pemeriksaans.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
