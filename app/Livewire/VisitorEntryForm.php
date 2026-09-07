<?php

namespace App\Livewire;

use App\Models\AccessLog;
use App\Models\QrToken;
use App\Models\User;
use Livewire\Component;

class VisitorEntryForm extends Component
{
    public $token;
    public $isTokenValid = true;
    public $isSubmitted = false;

    // Field Form
    public $ticket_number = '';
public $visitor_name = '';
public $department = '';
public $escort_name = '';
public $category = '';

// Titik Suhu & Kelembaban (Ruangan & Rak 1-6)
public $temp_room = '';
public $hum_room = '';
public $temp_rack_1 = '';
public $hum_rack_1 = '';
public $temp_rack_2 = '';
public $hum_rack_2 = '';
public $temp_rack_3 = '';
public $hum_rack_3 = '';
public $temp_rack_4 = '';
public $hum_rack_4 = '';
public $temp_rack_5 = '';
public $hum_rack_5 = '';
public $temp_rack_6 = '';
public $hum_rack_6 = '';

public $visual_check = '';
public $notes = '';

    public function mount($token = null)
    {
        $this->token = $token;

        if ($token) {
            $qrToken = QrToken::where('token', $token)
                ->where('expires_at', '>', now())
                ->first();

            $this->isTokenValid = (bool) $qrToken;
        } else {
            $this->isTokenValid = false;
        }
    }

    public function updatedCategory()
    {
        // Reset catatan, visual check, dan 7 titik suhu/kelembaban baru
        $this->reset([
            'notes',
            'visual_check',
            'temp_room',
            'hum_room',
            'temp_rack_1', 'hum_rack_1',
            'temp_rack_2', 'hum_rack_2',
            'temp_rack_3', 'hum_rack_3',
            'temp_rack_4', 'hum_rack_4',
            'temp_rack_5', 'hum_rack_5',
            'temp_rack_6', 'hum_rack_6',
        ]);

        $this->resetValidation();
    }

    public function submit()
    {
        $this->validate([
            'ticket_number' => 'required|string|max:50',
            'visitor_name'  => 'required|string|max:100',
            'department'    => 'required|string|max:100',
            'category'      => 'required|string',
        ]);

        AccessLog::create([
            'ticket_number' => $this->ticket_number,
            'visitor_name'  => $this->visitor_name,
            'department'    => $this->department,
            'escort_name'   => $this->escort_name,
            'category'      => $this->category,
            'temp_room'     => $this->category === 'Maintenance Rutin' ? $this->temp_room : null,
            'hum_room'      => $this->category === 'Maintenance Rutin' ? $this->hum_room : null,
            'temp_rack_1'   => $this->category === 'Maintenance Rutin' ? $this->temp_rack_1 : null,
            'hum_rack_1'    => $this->category === 'Maintenance Rutin' ? $this->hum_rack_1 : null,
            'temp_rack_2'   => $this->category === 'Maintenance Rutin' ? $this->temp_rack_2 : null,
            'hum_rack_2'    => $this->category === 'Maintenance Rutin' ? $this->hum_rack_2 : null,
            'temp_rack_3'   => $this->category === 'Maintenance Rutin' ? $this->temp_rack_3 : null,
            'hum_rack_3'    => $this->category === 'Maintenance Rutin' ? $this->hum_rack_3 : null,
            'temp_rack_4'   => $this->category === 'Maintenance Rutin' ? $this->temp_rack_4 : null,
            'hum_rack_4'    => $this->category === 'Maintenance Rutin' ? $this->hum_rack_4 : null,
            'temp_rack_5'   => $this->category === 'Maintenance Rutin' ? $this->temp_rack_5 : null,
            'hum_rack_5'    => $this->category === 'Maintenance Rutin' ? $this->hum_rack_5 : null,
            'temp_rack_6'   => $this->category === 'Maintenance Rutin' ? $this->temp_rack_6 : null,
            'hum_rack_6'    => $this->category === 'Maintenance Rutin' ? $this->hum_rack_6 : null,
            'visual_check'  => $this->visual_check,
            'notes'         => $this->notes,
            'logged_at'     => now('Asia/Jakarta'),
        ]);

        $this->reset();

        $this->isSubmitted = true;
    }

    public function render()
    {
        try {
            $escorts = User::pluck('name')->toArray();
        } catch (\Throwable $e) {
            $escorts = [];
        }

        if (empty($escorts)) {
            $escorts = [
                'AOS WASULFALAH ',
                'HERLAMBANG ADI BUDIMAN',
                'TONO SARTONO',
                'SUMONO',
                'I MADE WIRATAMA M YUSUF',
            ];
        }

        return view('livewire.visitor-entry-form', [
            'escorts' => $escorts,
        ])
        ->layout('layouts.guest')
        ->title('Form Akses Ruang Server - Pupuk Kujang');
    }
}