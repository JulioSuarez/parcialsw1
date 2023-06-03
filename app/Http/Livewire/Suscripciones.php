<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Http\Controllers\PagoController;



//  este no esta funcionando ni en uso




class Suscripciones extends Component
{
    public function metodoPagoPredeterminado()
    {
        return auth()->user()->defaultPaymentMethod();
    }

    public function nuevaSuscripcion($nombre, $plan)
    {
        // dd($nombre, $plan);
        $predeterminado = auth()->user()->defaultPaymentMethod()->id;
        auth()->user()->newSubscription($nombre, $plan)->create($predeterminado);

        if (auth()->user()->subscribedToPrice($plan,$nombre)) {

            if ($nombre == "Organizador") {
                $rol = 3;   //fotoestudio
            }else{
                $rol = 4;   //organizador
            }
            $id = auth()->user()->id;
            $user = User::where('id', $id)->first();
            $user->syncRoles($rol);
            $user->save();
            return redirect()->route('felicidades');
        } else {
            return redirect()->route('suscripcion.fallida');
        }

    }

    public function render()
    {
        return view('livewire.suscripciones');
    }
}
