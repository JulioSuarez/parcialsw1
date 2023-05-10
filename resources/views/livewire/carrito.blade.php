<div>


    <section class="bg-white rounded shadow-lg">
        <div class="px-8 py-6">

            <h1 class="text-gray-700 text-lg font-bold mb-4">
                Agregar Metodo de pago
            </h1>

            <div class="flex" wire:ignore>

                <p class="text-gray-600 mr-6">Informacion de tarjeta</p>

                <div class="flex-1">

                    {{-- titular de la tarjeta --}}
                    <input id="card-holder-name" class="jcst-form w-full mb-4"
                        placeholder="Nombre del Titular de la Tarjeta">

                    <!-- Stripe Elements Placeholder -->
                    <div id="card-element" class="jcst-form w-full mb-4"></div>

                    <span id="card-error-message" class="text-red-600 text-sm"></span>

                </div>

            </div>

        </div>
        <footer class="bg-slate-300 px-8 py-6">
            <div class="flex justify-end">

                {{-- boton --}}
                <button id="card-button" data-secret="{{ $intent->client_secret }}"
                    class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md bg-150 bg-gradient-to-tl from-gray-900 to-slate-800 hover:shadow-soft-xs active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25 disabled:opacity-25">
                    Update Payment Method
                </button>

            </div>
        </footer>
    </section>

    <section class="bg-white rounded shadow-lg">

        <header class="px-8 py-6 bg-gray-50 border-b border-gray-200">
            <h1 class="text-gray-700 text-lg font-semibold">metodos de pagos agregados</h1>
        </header>

        <p></p>
        <ul class="divide-y divide-gray-200">
            @foreach ($paymentMethods as $p)
                <li class="py-4 pb-4">
                    <div class="w-full max-w-full px-3 mb-4 xl:mb-0 xl:w-1/2 xl:flex-none">
                        <div
                            class="relative flex flex-col min-w-0 break-words bg-transparent border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border">
                            <div class="relative overflow-hidden rounded-2xl"
                                style="background-image: url('../assets/img/curved-images/curved14.jpg')">
                                <span
                                    class="absolute top-0 left-0 w-full h-full bg-center bg-cover bg-gradient-to-tl from-gray-900 to-slate-800 opacity-80"></span>
                                <div class="relative z-10 flex-auto p-4">
                                    <div class="flex justify-between">
                                        <div>
                                            <i class="p-2 text-white fas fa-wifi"></i>
                                            @if (auth()->user()->defaultPaymentMethod()->id == $p->id)
                                                <span
                                                    class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-1 py-1 rounded dark:bg-blue-900 dark:text-blue-300">Activa</span>
                                            @endif
                                        </div>
                                        <div>
                                            <button wire:click="defaultPaymentMethod('{{ $p->id }}')"
                                                wire:target="defaultPaymentMethod('{{ $p->id }}')"
                                                wire:loading.attr="disabled">
                                                <i class="p-2 text-white fas fa-star"></i>
                                            </button>
                                            <button wire:click="deletePaymentMethod('{{ $p->id }}')"
                                                wire:target="deletePaymentMethod('{{ $p->id }}')"
                                                wire:loading.attr="disabled">
                                                <i class="p-2 text-white fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <h5 class="pb-2 mt-6 mb-12 text-white">
                                        xxxx&nbsp;&nbsp;&nbsp;xxxx&nbsp;&nbsp;&nbsp;xxxx&nbsp;&nbsp;&nbsp;{{ $p->card->last4 }}
                                    </h5>
                                    <div class="flex">
                                        <div class="flex">
                                            <div class="mr-6">
                                                <p class="mb-0 leading-normal text-white text-sm opacity-80">Card Holder
                                                </p>
                                                <h6 class="mb-0 text-white">{{ $p->billing_details->name }}</h6>
                                            </div>
                                            <div>
                                                <p class="mb-0 leading-normal text-white text-sm opacity-80">Expires</p>
                                                <h6 class="mb-0 text-white">
                                                    {{ $p->card->exp_month }}/{{ $p->card->exp_year }}
                                                </h6>
                                            </div>
                                        </div>
                                        <div class="flex items-end justify-end w-1/5 ml-auto">
                                            <img class="w-3/5 mt-2" src="../assets/img/logos/mastercard.png"
                                                alt="logo" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </li>
            @endforeach
            <p class="py-6"></p>
        </ul>


</div>

</section>

<script src="https://js.stripe.com/v3/"></script>

<script>
    // console.log('stripe-public-key');
    const stripe = Stripe(
        'pk_test_51MF8jhEeOK3PttV3lGJEa7Wxxjq8hiD2BheALyvNCkhlKbIageMb41VfyOXMufsy0nSLrGS75VfOqXUIXscWgjmo00jKZYuyoO'
    );
    // const stripe = Stripe('stripe-public-key');
    // const stripe = Stripe("'".{{ env('STRIPE_KEY') }}."'");

    const elements = stripe.elements();
    const cardElement = elements.create('card');

    cardElement.mount('#card-element');
</script>

<script>
    const cardHolderName = document.getElementById('card-holder-name');
    const cardButton = document.getElementById('card-button');

    cardButton.addEventListener('click', async (e) => {

        // deshabilitar boton
        cardButton.disabled = true;

        const clientSecret = cardButton.dataset.secret;

        const {
            setupIntent,
            error
        } = await stripe.confirmCardSetup(
            clientSecret, {
                payment_method: {
                    card: cardElement,
                    billing_details: {
                        name: cardHolderName.value
                    }
                }
            }
        );

        cardButton.disabled = false;

        if (error) {
            let span = document.getElementById('card-error-message');
            span.textContent = error.message;
            // console.log(error.message)
        } else {
            console.log(setupIntent.payment_method)
            // limpiar formulario
            @this.addPaymentMethod(setupIntent.payment_method);
            cardHolderName.value = '';
            cardElement.clear();
        }
    });
</script>
</div>
