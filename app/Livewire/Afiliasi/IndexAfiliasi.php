<?php

namespace App\Livewire\Afiliasi;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class IndexAfiliasi extends Component
{
    use WithPagination;
    public $search;
    protected $updateQueryString = [
        ['page' => ['except' => 1]],
        ['search' => ['except' => '']]
    ];

    public function render()
    {
        $data = User::where('referred_by', Auth::user()->referral_code)->latest()->paginate(20);
        if ($this->search != null) {
            $data = User::where('referred_by', Auth::user()->referral_code)
                ->orWhere('name', 'LIKE', '%' . $this->search . '%')
                ->latest()->paginate(20);
        }
        return view('livewire.afiliasi.index-afiliasi', [
            'fetch' => $data
        ]);
    }
}
