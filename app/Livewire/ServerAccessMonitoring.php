<?php

namespace App\Livewire;

use App\Models\AccessLog;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class ServerAccessMonitoring extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedCategory = '';
    public $startDate = '';
    public $endDate = '';

    protected $paginationTheme = 'tailwind';

    // Reset pagination secara otomatis setiap kali ada filter yang berubah
    public function updated($propertyName)
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->reset(['search', 'selectedCategory', 'startDate', 'endDate']);
        $this->resetPage();
    }

    public function render()
    {
        $now = Carbon::now('Asia/Jakarta');

        // Statistik Realtime
        $totalAccess = AccessLog::count();
        $todayAccess = AccessLog::whereDate('logged_at', $now->toDateString())->count();
        $monthAccess = AccessLog::whereMonth('logged_at', $now->month)
            ->whereYear('logged_at', $now->year)
            ->count();

        // Query Log dengan Filter
        $query = AccessLog::query();

        if (!empty(trim($this->search))) {
            $searchTerm = trim($this->search);
            $query->where(function ($q) use ($searchTerm) {
                $q->where('visitor_name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('department', 'like', '%' . $searchTerm . '%')
                  ->orWhere('escort_name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('notes', 'like', '%' . $searchTerm . '%');
            });
        }

        if (!empty($this->selectedCategory)) {
            $query->where('category', $this->selectedCategory);
        }

        if (!empty($this->startDate)) {
            $query->whereDate('logged_at', '>=', $this->startDate);
        }

        if (!empty($this->endDate)) {
            $query->whereDate('logged_at', '<=', $this->endDate);
        }

        $logs = $query->latest('logged_at')->paginate(10);

        return view('livewire.server-access-monitoring', [
            'logs'        => $logs,
            'totalAccess' => $totalAccess,
            'todayAccess' => $todayAccess,
            'monthAccess' => $monthAccess,
        ])
        ->layout('layouts.guest')
        ->title('Dashboard Admin - Pupuk Kujang');
    }
}