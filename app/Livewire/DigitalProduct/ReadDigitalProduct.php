<?php

namespace App\Livewire\DigitalProduct;

use App\Models\Plan;
use App\Models\Product;
use Livewire\Component;

class ReadDigitalProduct extends Component
{
    public $id, $show, $fetch;

    public function mount($id) {
        $this->show = Product::find($id);
        $this->fetch = Plan::where('product_id', $id)->get();
    }

    public function render()
    {
        return view('livewire.digital-product.read-digital-product');
    }
}
