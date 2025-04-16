<?php

namespace App\Livewire\Product;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Component;

class CreateProduct extends Component
{
    public $name, $desc, $action;
    public function render()
    {
        return view('livewire.product.create-product');
    }

    public function setAction($action)
    {
        $this->action = $action;
        $this->store();
    }

    public function store() {
        $request = new ProductRequest();
        $this->validate($request->rules(), $request->messages());
        Product::create([
            'name' => $this->name,
            'desc' => $this->desc,
        ]);
        $this->reset(['name', 'desc']);
        if ($this->action === 'save_and_add') {
            LivewireAlert::text('Data berhasil ditambahkan.')->success()->toast()->position('top-end')->show();
            return back();
        } else {
            session()->flash('success', 'Data berhasil ditambahkan.');
            return to_route('products.index');
        }
    }
}
