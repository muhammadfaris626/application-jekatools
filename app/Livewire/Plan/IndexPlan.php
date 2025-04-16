<?php

namespace App\Livewire\Plan;

use App\Models\Plan;
use Livewire\Component;
use Livewire\WithPagination;

class IndexPlan extends Component
{
    use WithPagination;
    public $search;
    protected $updateQueryString = [
        ['page' => ['except' => 1]],
        ['search' => ['except' => '']]
    ];

    public function render()
    {
        $data = Plan::latest()->paginate(20);
        if ($this->search != null) {
            $data = Plan::where('name', 'LIKE', '%' . $this->search . '%')
                ->orWhere('duration_months', 'LIKE', '%' . $this->search . '%')
                ->orWhere('price', 'LIKE', '%' . $this->search . '%')
                ->orWhereHas('product', function($query) {
                    $query->where('name', 'LIKE', '%' . $this->search . '%');
                })
                ->latest()->paginate(20);
        }
        return view('livewire.plan.index-plan', [
            'fetch' => $data
        ]);
    }

    public function destroy($id) {
        $data = Plan::findOrFail($id);
        $data->delete();
        session()->flash('success', 'Data berhasil dihapus.');
        return back();
    }
}
