<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Component;

class ReadProduct extends Component
{
    public $id, $show;

    public function mount($id) {
        $list = Product::find($id);
        $fieldNames = [
            'name' => 'Nama Produk',
            'desc' => 'Keterangan Produk',
            'created_at' => 'Tanggal Dibuat',
            'updated_at' => 'Tanggal Diubah',
        ];
        $data = $list ? $list->toArray() : [];
        $filteredData = array_intersect_key($data, $fieldNames);
        $this->show = array_map(function ($key, $value) use ($list, $fieldNames) {
            return [
                'name' => $fieldNames[$key],
                'value' => match ($key) {
                    default => $value ?? '-',
                }
            ];
        }, array_keys($filteredData), $filteredData);
    }

    public function render()
    {
        return view('livewire.product.read-product');
    }
}
