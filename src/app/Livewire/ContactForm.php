<?php

namespace App\Livewire;

use App\Models\Contact;
use Livewire\Component;
use Livewire\Attributes\Validate;

class ContactForm extends Component
{
    #[Validate('required|min:2|max:100')]
    public $name = '';
    
    #[Validate('required|email|max:255')]
    public $email = '';
    
    #[Validate('required|min:5|max:100')]
    public $subject = '';
    
    #[Validate('required|min:10|max:1000')]
    public $message = '';
    
    public $submitted = false;

    public function submit()
    {
        $this->validate();
        
        Contact::create([
            'name' => $this->name,
            'email' => $this->email,
            'subject' => $this->subject,
            'message' => $this->message,
            'metadata' => [
                'ip' => request()->ip(),
                'user_agent' => request()->userAgent(),
                'submitted_at' => now()->toISOString(),
            ],
            'status' => 'new',
        ]);
        
        // Reset form
        $this->reset(['name', 'email', 'subject', 'message']);
        $this->submitted = true;
        
        // Auto-hide success message after 5 seconds
        $this->dispatch('contact-submitted');
    }
    
    public function resetForm()
    {
        $this->submitted = false;
        $this->reset();
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
