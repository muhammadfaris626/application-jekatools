<?php

namespace App\Livewire\Dashboard;

use App\Models\Transaction;
use Carbon\Carbon;
use Livewire\Component;

class IndexDashboard extends Component
{
    public $startDate, $endDate;

    public function mount() {
        $this->startDate = now()->startOfYear()->toDateString();
        $this->endDate = now()->endOfYear()->toDateString();
    }

    public function render()
    {
        return view('livewire.dashboard.index-dashboard', [
            'totalOmzet'     => $this->getOmzetByRange(Carbon::parse($this->startDate), Carbon::parse($this->endDate)),
            'omzetHariIni'   => $this->getOmzetByDate(Carbon::today()),
            'omzetKemarin'   => $this->getOmzetByDate(Carbon::yesterday()),
            'omzetMingguIni' => $this->getOmzetByRange(now()->startOfWeek(), now()->endOfWeek()),
        ]);
    }

    // Untuk omzet per hari tertentu
    protected function getOmzetByDate(Carbon $date)
    {
        return Transaction::where('status', 'PAID')
            ->whereDate('updated_at', $date)
            ->sum('amount');
    }
    // Untuk omzet per range tanggal
    protected function getOmzetByRange(Carbon $start, Carbon $end)
    {
        return Transaction::where('status', 'PAID')
            ->whereBetween('updated_at', [$start->startOfDay(), $end->endOfDay()])
            ->sum('amount');
    }
}
