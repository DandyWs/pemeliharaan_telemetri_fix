<?php

namespace App\Http\Controllers\Api;

use App\Models\Pemeriksaan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\PemeriksaanResource;
use App\Http\Resources\PemeriksaanCollection;
use App\Http\Requests\PemeriksaanStoreRequest;
use App\Http\Requests\PemeriksaanUpdateRequest;

class PemeriksaanController extends Controller
{
    public function index(Request $request): PemeriksaanCollection
    {
        $this->authorize('view-any', Pemeriksaan::class);

        $search = $request->get('search', '');

        $pemeriksaans = Pemeriksaan::search($search)
            ->latest()
            ->paginate();

        return new PemeriksaanCollection($pemeriksaans);
    }

    public function store(PemeriksaanStoreRequest $request): PemeriksaanResource
    {
        $this->authorize('create', Pemeriksaan::class);

        $validated = $request->validated();

        $pemeriksaan = Pemeriksaan::create($validated);

        return new PemeriksaanResource($pemeriksaan);
    }

    public function show(
        Request $request,
        Pemeriksaan $pemeriksaan
    ): PemeriksaanResource {
        $this->authorize('view', $pemeriksaan);

        return new PemeriksaanResource($pemeriksaan);
    }

    public function update(
        PemeriksaanUpdateRequest $request,
        Pemeriksaan $pemeriksaan
    ): PemeriksaanResource {
        $this->authorize('update', $pemeriksaan);

        $validated = $request->validated();

        $pemeriksaan->update($validated);

        return new PemeriksaanResource($pemeriksaan);
    }

    public function destroy(
        Request $request,
        Pemeriksaan $pemeriksaan
    ): Response {
        $this->authorize('delete', $pemeriksaan);

        $pemeriksaan->delete();

        return response()->noContent();
    }
}
