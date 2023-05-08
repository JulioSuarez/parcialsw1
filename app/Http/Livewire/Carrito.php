<?php

namespace App\Http\Livewire;

use Livewire\Component;
// use Stripe\PaymentMethod;

class Carrito extends Component
{
    public function addPaymentMethod($paymentMethod){
        auth()->user()->addPaymentMethod($paymentMethod);
        if(!auth()->user()->hasDefaultPaymentMethod()){
            auth()->user()->updateDefaultPaymentMethod($paymentMethod);
        }
    }
    //delete paymentmethod
    public function deletePaymentMethod($paymentMethod){
        // dd($paymentMethod);
        auth()->user()->deletePaymentMethod($paymentMethod);
    }
    //default paymethod
    public function defaultPaymentMethod($paymentMethod){
        // dd($paymentMethod);
        auth()->user()->updateDefaultPaymentMethod($paymentMethod);
    }

    public function render()
    {
        // return view('livewire.carrito');
        return view('livewire.carrito',
            [
                'intent' => auth()->user()->createSetupIntent(),
                'paymentMethods' => auth()->user()->paymentMethods()
                // 'paymentMethod' => auth()->user()->payment_methods[0]
            ]
        );
    }
}
