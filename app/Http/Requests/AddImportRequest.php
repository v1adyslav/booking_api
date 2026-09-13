<?php

namespace App\Http\Requests;

use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class AddImportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        if ($this->has('sent_at') && ! empty($this->sent_at)) {
            $this->merge([
                'sent_at' => Carbon::parse($this->sent_at)->setTimezone('UTC')->format('Y-m-d H:i:s'),
            ]);
        }

        if ($this->filled('supplier') && ! $this->has('supplier_id')) {
            $supplierId = Supplier::query()->where('name', $this->input('supplier'))->value('id');

            if ($supplierId) {
                $this->merge(['supplier_id' => $supplierId]);
            }
        }

        if (! $this->has('status')) {
            $this->merge(['status' => 'pending']);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'supplier' => ['sometimes', 'exists:suppliers,name'],
            'supplier_id' => ['required_without:supplier', 'exists:suppliers,id'],
            'external_import_id' => ['required', 'string', 'max:255', 'unique:imports,external_import_id'],
            'status' => ['required', 'in:pending,processing,completed,failed'],
            'sent_at' => ['nullable', 'date_format:Y-m-d H:i:s'],
        ];
    }
}
