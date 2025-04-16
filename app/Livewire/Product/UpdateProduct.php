<?php

namespace App\Livewire\Product;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Livewire\Component;

class UpdateProduct extends Component
{
    public $id, $name, $desc;

    public function mount($id) {
        $data = Product::findOrFail($id);
        $this->fill($data->only(['id', 'name', 'desc']));
    }

    public function render()
    {
        return view('livewire.product.update-product');
    }

    public function update() {
        $request = new ProductRequest();
        $this->validate($request->rules(), $request->messages());
        Product::findOrFail($this->id)->update([
            'name' => $this->name,
            'desc' => $this->desc
        ]);
        session()->flash('success', 'Data berhasil diubah.');
        return to_route('products.index');
    }
}
