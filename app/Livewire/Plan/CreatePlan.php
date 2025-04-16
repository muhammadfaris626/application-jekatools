<?php

namespace App\Livewire\Plan;

use App\Http\Requests\PlanRequest;
use App\Models\ListPlanFeature;
use App\Models\Plan;
use App\Models\Product;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Component;

class CreatePlan extends Component
{
    public $product_id, $name, $duration_months, $price, $action, $search = "";
    public $fetchProduct, $allFeatures = [];

    public function mount() {
        $this->fetchProduct = Product::all();
    }

    public function render()
    {
        return view('livewire.plan.create-plan');
    }

    public function setAction($action)
    {
        $this->action = $action;
        $this->store();
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

    public function store() {
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

        $create = Plan::create([
            'product_id' => $this->product_id,
            'name' => $this->name,
            'duration_months' => $this->duration_months,
            'price' => str_replace('.', '', $this->price)
        ]);

        for ($i=0; $i < count($this->allFeatures); $i++) {
            ListPlanFeature::create([
                'plan_id' => $create->id,
                'name' => $this->allFeatures[$i]['name'],
                'status' => $this->allFeatures[$i]['status'],
            ]);
        }

        $this->dispatch('resetDropdown');
        $this->reset(['product_id', 'name', 'duration_months', 'price', 'allFeatures']);
        if ($this->action === 'save_and_add') {
            LivewireAlert::text('Data berhasil ditambahkan.')->success()->toast()->position('top-end')->show();
            return back();
        } else {
            session()->flash('success', 'Data berhasil ditambahkan.');
            return to_route('plans.index');
        }
    }
}
