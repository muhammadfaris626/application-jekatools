<?php

namespace App\Livewire\Plan;

use App\Http\Requests\PlanRequest;
use App\Models\ListPlanFeature;
use App\Models\Plan;
use App\Models\Product;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Component;

class UpdatePlan extends Component
{
    public $id, $product_id, $name, $duration_months, $price, $search = "";
    public $fetchProduct, $allFeatures = [];

    public function mount($id) {
        $this->id = $id;
        $data = Plan::findOrFail($id);
        $this->fill($data->only(['id', 'product_id', 'name', 'duration_months', 'price']));
        $this->fetchProduct = Product::all();
        $this->allFeatures = ListPlanFeature::where('plan_id', $id)
            ->get()
            ->map(function($list) {
                return [
                    'name' => $list->name,
                    'status' => $list->status
                ];
            })->toArray();
    }

    public function render()
    {
        return view('livewire.plan.update-plan');
    }

    public function addFeature() {
        $this->validate([
            'allFeatures.*.name' => 'required',
            'allFeatures.*.status' => 'required'
        ], [
            'allFeatures.*.name.required' => 'Kolom nama fitur wajib diisi.',
            'allFeatures.*.status.required' => 'Kolom status wajib diisi.'
        ]);
        $this->allFeatures[] = ['name' => '', 'status' => ''];
    }

    public function removeFeature($index) {
        unset($this->allFeatures[$index]);
        $this->allFeatures = array_values($this->allFeatures);
    }

    public function update() {
        $request = new PlanRequest();
        $this->validate($request->rules(), $request->messages());

        if (empty($this->allFeatures)) {
            LivewireAlert::text('Silahkan tambah fitur terlebih dahulu.')->error()->toast()->position('top-end')->show();
            return back();
        }

        $this->validate([
            'allFeatures.*.name' => 'required',
            'allFeatures.*.status' => 'required'
        ], [
            'allFeatures.*.name.required' => 'Kolom nama fitur wajib diisi.',
            'allFeatures.*.status.required' => 'Kolom status wajib diisi.'
        ]);

        $update = Plan::findOrFail($this->id)->update([
            'product_id' => $this->product_id,
            'name' => $this->name,
            'duration_months' => $this->duration_months,
            'price' => str_replace('.', '', $this->price)
        ]);

        ListPlanFeature::where('plan_id', $this->id)->delete();

        foreach ($this->allFeatures as $feature) {
            ListPlanFeature::create([
                'plan_id' => $this->id,
                'name' => $feature['name'],
                'status' => $feature['status'],
            ]);
        }

        session()->flash('success', 'Data berhasil diubah.');
        return to_route('plans.index');
    }
}
