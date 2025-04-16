<?php

namespace App\Livewire\Member;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class IndexMember extends Component
{
    use WithPagination;
    public $search;
    protected $updateQueryString = [
        ['page' => ['except' => 1]],
        ['search' => ['except' => '']]
    ];

    public function render()
    {
        $data = User::latest()->paginate(20);
        if ($this->search != null) {
            $data = User::where('name', 'LIKE', '%' . $this->search . '%')
                ->orWhere('email', 'LIKE', '%' . $this->search . '%')
                ->orWhere('referral_code', 'LIKE', '%' . $this->search . '%')
                ->latest()->paginate(20);
        }
        return view('livewire.member.index-member', [
            'fetch' => $data
        ]);
    }

    public function destroy($id) {
        $data = User::findOrFail($id);
        $data->delete();
        session()->flash('success', 'Data berhasil dihapus.');
        return back();
    }
}
