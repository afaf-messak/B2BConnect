<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        $product = $this->route('product');

        return $this->user()?->role === 'supplier'
            && $product
            && (int) $product->fournisseur_id === (int) $this->user()->id;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:5000'],
            'price' => ['sometimes', 'required', 'numeric', 'min:0'],
            'stock' => ['sometimes', 'required', 'integer', 'min:0'],
            'image' => ['nullable', 'image', 'max:2048'],
            'remove_image' => ['sometimes', 'boolean'],
        ];
    }
}
