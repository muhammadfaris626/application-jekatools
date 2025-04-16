<?php

namespace App\Livewire\DigitalProduct;

use App\Models\Plan;
use App\Models\Transaction;
use App\Services\TripayService;
use Livewire\Component;
use Illuminate\Support\Facades\Redirect;
class TransactionDigitalProduct extends Component
{
    public $fetch, $detail, $check, $product;
    protected $listeners = ['refreshComponent' => '$refresh'];
    public function mount($id, $ref) {

        $this->fetch = Plan::find($id);
        $tripay = new TripayService();
        $this->detail = $tripay->getTransactionDetail($ref)['data'];
        $this->check = Transaction::where('reference', $this->detail['reference'])->first();
    }
    public function render()
    {

        return view('livewire.digital-product.transaction-digital-product');
    }
}
