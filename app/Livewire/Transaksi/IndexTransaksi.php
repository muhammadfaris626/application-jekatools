<?php

namespace App\Livewire\Transaksi;

use App\Models\Transaction;
use Livewire\Component;
use Livewire\WithPagination;

class IndexTransaksi extends Component
{
    use WithPagination;
    public $search;
    protected $updateQueryString = [
        ['page' => ['except' => 1]],
        ['search' => ['except' => '']]
    ];

    public function render()
    {
        $data = Transaction::latest()->paginate(20);
        if ($this->search != null) {
            $data = Transaction::whereHas('user', function($query) {
                $query->where('name', 'LIKE', '%' . $this->search . '%');
            })
            ->latest()->paginate(20);
        }
        return view('livewire.transaksi.index-transaksi', [
            'fetch' => $data
        ]);
    }

    public function destroy($id) {
        $data = Transaction::findOrFail($id);
        $data->delete();
        session()->flash('success', 'Data berhasil dihapus.');
        return back();
    }
}
