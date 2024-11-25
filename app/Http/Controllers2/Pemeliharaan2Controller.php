<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Pemeliharaan2;
use App\Http\Controllers\Controller;
use App\Http\Resources\Pemeliharaan2Resource;
use App\Http\Resources\Pemeliharaan2Collection;
use App\Http\Requests\Pemeliharaan2StoreRequest;
use App\Http\Requests\Pemeliharaan2UpdateRequest;

class Pemeliharaan2Controller extends Controller
{
    public function index(Request $request): Pemeliharaan2Collection
    {
        $this->authorize('view-any', Pemeliharaan2::class);

        $search = $request->get('search', '');

        $pemeliharaan2s = Pemeliharaan2::search($search)
            ->latest()
            ->paginate();

        return new Pemeliharaan2Collection($pemeliharaan2s);
    }

    public function store(
        Pemeliharaan2StoreRequest $request
    ): Pemeliharaan2Resource {
        $this->authorize('create', Pemeliharaan2::class);

        $validated = $request->validated();

        $pemeliharaan2 = Pemeliharaan2::create($validated);

        return new Pemeliharaan2Resource($pemeliharaan2);
    }

    public function show(
        Request $request,
        Pemeliharaan2 $pemeliharaan2
    ): Pemeliharaan2Resource {
        $this->authorize('view', $pemeliharaan2);

        return new Pemeliharaan2Resource($pemeliharaan2);
    }

    public function update(
        Pemeliharaan2UpdateRequest $request,
        Pemeliharaan2 $pemeliharaan2
    ): Pemeliharaan2Resource {
        $this->authorize('update', $pemeliharaan2);

        $validated = $request->validated();

        $pemeliharaan2->update($validated);

        return new Pemeliharaan2Resource($pemeliharaan2);
    }

    public function destroy(
        Request $request,
        Pemeliharaan2 $pemeliharaan2
    ): Response {
        $this->authorize('delete', $pemeliharaan2);

        $pemeliharaan2->delete();

        return response()->noContent();
    }
}
