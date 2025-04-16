<?php

namespace App\Livewire\DigitalProduct;


use App\Models\ListPlanFeature;
use App\Models\Plan;
use App\Models\Product;
use App\Models\Subscription;
use App\Models\Transaction;
use App\Services\TripayService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CheckoutDigitalProduct extends Component
{
    public $id, $show, $channels, $method;

    public function mount($id) {
        $this->id = $id;
        $this->show = Plan::find($id);
        $tripay = new TripayService();
        $this->channels = $tripay->getChannels()['data'] ?? [];
    }

    public function render()
    {
        return view('livewire.digital-product.checkout-digital-product');
    }

    public function transaction($methodData) {
        $tripay = new TripayService();
        $user = Auth::user();
        $plan = Plan::findOrFail($this->id);
        $ref = 'INV-JEKATOOLS-' . date('Ymd-His');
        $payload = [
            'method' => $methodData,
            'merchant_ref' => $ref,
            'amount' => $plan->price,
            'customer_name' => $user->name,
            'customer_email' => $user->email,
            'order_items' => [[
                'sku' => $plan->id,
                'name' => $plan->name,
                'price' => $plan->price,
                'quantity' => 1
            ]],
            'callback_url' => url('/api/tripay/callback'),
            'return_url' => url('/payment/thanks'),
            'expired_time' => now()->addHours(24)->timestamp,
        ];

        $response = $tripay->createTransaction($payload);

        if ($response['success']) {
            Transaction::create([
                'user_id' => $user->id,
                'product_id' => $plan->product_id,
                'plan_id' => $plan->id,
                'merchant_ref' => $ref,
                'reference' => $response['data']['reference'],
                'amount' => $plan->price,
                'status' => 'UNPAID',
                'payment_url' => $response['data']['checkout_url'],
            ]);
        }

        return to_route('digital-products.transaction', parameters: [
            'id' => $this->id,
            'ref' => $response['data']['reference']
        ]);
    }
}
