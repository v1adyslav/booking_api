<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddImportRequest;
use App\Http\Resources\{ImportResource, ImportShortResource};
use App\Jobs\ProcessImportJob;
use App\Models\Import;
use App\Models\Supplier;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ImportController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(
            ImportResource::collection(Import::with('supplier')->latest()->get())
        );
    }

    public function store(AddImportRequest $request): JsonResponse
    {
        $data = $request->validated();
        $offers = $data['offers'] ?? [];
        unset($data['offers']);

        $import = Import::create($data);

        ProcessImportJob::dispatch($import, $offers);

        return response()->json(new ImportShortResource($import), 202);
    }

    public function show(Import $import): JsonResponse
    {
        return response()->json(new ImportResource($import->load('supplier')));
    }

    public function update(Request $request, Import $import): JsonResponse
    {
        $data = $request->validate([
            'supplier_id' => ['sometimes', 'exists:suppliers,id'],
            'external_import_id' => ['sometimes', 'string', 'max:255', 'unique:imports,external_import_id,' . $import->id],
            'sent_at' => ['nullable', 'date'],
        ]);

        if (isset($data['supplier_id'])) {
            Supplier::query()->findOrFail($data['supplier_id']);
        }

        $import->update($data);

        return response()->json(new ImportResource($import->fresh()->load('supplier')));
    }

    public function destroy(Import $import): JsonResponse
    {
        $import->delete();

        return response()->json(['message' => 'Import deleted successfully']);
    }
}
