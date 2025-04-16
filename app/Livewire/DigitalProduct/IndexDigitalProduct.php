<?php

namespace App\Livewire\DigitalProduct;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class IndexDigitalProduct extends Component
{
    use WithPagination;
    public $search;
    protected $updateQueryString = [
        ['page' => ['except' => 1]],
        ['search' => ['except' => '']]
    ];

    public function render()
    {
        $data = Product::latest()->paginate(9);
        if ($this->search != null) {
            $data = Product::where('name', 'LIKE', '%' . $this->search . '%')
                ->orWhere('desc', 'LIKE', '%' . $this->search . '%')
                ->latest()->paginate(20);
        }
        return view('livewire.digital-product.index-digital-product', [
            'fetch' => $data
        ]);
    }
}
