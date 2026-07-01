<?php

namespace App\Livewire;

use App\Models\Reservation;
use Livewire\Component;

class ReservationForm extends Component
{
    public string $name             = '';
    public string $email            = '';
    public string $phone            = '';
    public string $date             = '';
    public string $time             = '19:00';
    public int    $party_size       = 2;
    public string $special_requests = '';

    public bool $submitted = false;

    protected function rules(): array
    {
        return [
            'name'             => 'required|string|min:2|max:100',
            'email'            => 'required|email|max:150',
            'phone'            => 'required|string|min:8|max:20',
            'date'             => 'required|date|after_or_equal:today',
            'time'             => 'required',
            'party_size'       => 'required|integer|min:1|max:20',
            'special_requests' => 'nullable|string|max:500',
        ];
    }

    protected array $messages = [
        'name.required'       => 'Your name is required.',
        'name.min'            => 'Name must be at least 2 characters.',
        'email.required'      => 'A valid email address is required.',
        'email.email'         => 'Please enter a valid email.',
        'phone.required'      => 'Phone number is required.',
        'date.required'       => 'Please select a date.',
        'date.after_or_equal' => 'The date must be today or in the future.',
        'time.required'       => 'Please select a time.',
        'party_size.required' => 'Party size is required.',
        'party_size.min'      => 'Party size must be at least 1.',
        'party_size.max'      => 'Party size cannot exceed 20.',
    ];

    public function submit(): void
    {
        $this->validate();

        Reservation::create([
            'name'             => $this->name,
            'email'            => $this->email,
            'phone'            => $this->phone,
            'date'             => $this->date,
            'time'             => $this->time,
            'party_size'       => $this->party_size,
            'special_requests' => $this->special_requests ?: null,
            'status'           => 'pending',
        ]);

        session()->flash('success', 'Your reservation request has been submitted successfully! We will confirm your table shortly.');
        
        $this->dispatch('reservation-submitted');
        $this->submitted = true;

        // Notify admin via Filament database notification synchronously (bypass queue)
        try {
            $admins = \App\Models\User::where('role', 'admin')->get();
            $oldQueue = config('queue.default');
            config(['queue.default' => 'sync']);
            
            foreach ($admins as $admin) {
                \Filament\Notifications\Notification::make()
                    ->title('📅 New Reservation!')
                    ->body("{$this->name} — {$this->party_size} guests on {$this->date} at {$this->time}")
                    ->success()
                    ->sendToDatabase($admin);
            }
            
            config(['queue.default' => $oldQueue]);
        } catch (\Throwable $e) {
            // Graceful degradation
        }
    }

    public function resetForm(): void
    {
        $this->submitted      = false;
        $this->name           = '';
        $this->email          = '';
        $this->phone          = '';
        $this->date           = '';
        $this->time           = '19:00';
        $this->party_size     = 2;
        $this->special_requests = '';
    }

    public function render()
    {
        return view('livewire.reservation-form');
    }
}
