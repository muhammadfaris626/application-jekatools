<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class IndexProduct extends Component
{
    use WithPagination;
    public $search;
    protected $updateQueryString = [
        ['page' => ['except' => 1]],
        ['search' => ['except' => '']]
    ];

    public function render()
    {
        $data = Product::latest()->paginate(20);
        if ($this->search != null) {
            $data = Product::where('name', 'LIKE', '%' . $this->search . '%')
                ->orWhere('desc', 'LIKE', '%' . $this->search . '%')
                ->latest()->paginate(20);
        }
        return view('livewire.product.index-product', [
            'fetch' => $data
        ]);
    }

    public function destroy($id) {
        $data = Product::findOrFail($id);
        $data->delete();
        session()->flash('success', 'Data berhasil dihapus.');
        return back();
    }
}
