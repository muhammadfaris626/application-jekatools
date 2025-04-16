<?php

namespace App\Livewire\Plan;

use App\Models\ListPlanFeature;
use App\Models\Plan;
use Livewire\Component;

class ReadPlan extends Component
{
    public $id, $show, $fetch;

    public function mount($id) {
        $list = Plan::find($id);
        $fieldNames = [
            'product_id' => 'Nama Produk',
            'name' => 'Jenis Langganan',
            'duration_months' => 'Durasi Langganan',
            'price' => 'Harga',
            'created_at' => 'Tanggal Dibuat',
            'updated_at' => 'Tanggal Diubah',
        ];
        $data = $list ? $list->toArray() : [];
        $filteredData = array_intersect_key($data, $fieldNames);
        $this->show = array_map(function ($key, $value) use ($list, $fieldNames) {
            return [
                'name' => $fieldNames[$key],
                'value' => match ($key) {
                    'product_id' => $list->product->name,
                    'duration_months' => $list->duration_months . ' Bulan',
                    'price' => 'Rp ' . number_format($list->price, 0, ',', '.'),
                    default => $value ?? '-',
                }
            ];
        }, array_keys($filteredData), $filteredData);
        $this->fetch = ListPlanFeature::where('plan_id', $id)->get();
    }

    public function render()
    {
        return view('livewire.plan.read-plan');
    }
}
