<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PaymentMethod extends Component
{
    public function render()
    {
        return view('livewire.payment-method',[
                'intent' => Auth()->User()->createSetupIntent()
        ]);
    }
}
