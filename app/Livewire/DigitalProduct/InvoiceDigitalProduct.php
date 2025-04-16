<?php

namespace App\Livewire\DigitalProduct;

use App\Models\Transaction;
use Livewire\Component;

class InvoiceDigitalProduct extends Component
{
    public $fetch;

    public function mount($reference) {
        $this->fetch = Transaction::where('reference', $reference)->first();
    }

    public function render()
    {
        return view('livewire.digital-product.invoice-digital-product');
    }
}
