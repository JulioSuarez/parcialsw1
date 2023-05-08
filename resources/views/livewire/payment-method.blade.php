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
                    <input id="card-holder-name" class="mb-4" placeholder="Nombre del Titular de la Tarjeta">

                    <!-- Stripe Elements Placeholder -->
                    <div id="card-element" class="mb-4"></div>

                </div>

            </div>

        </div>
        <footer class="bg-slate-300 px-8 py-6">
            <div class="flex justify-end">

                {{-- boton --}}
                <button id="card-button" data-secret="{{ $intent->client_secret }}"
                    class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md bg-150 bg-gradient-to-tl from-gray-900 to-slate-800 hover:shadow-soft-xs active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25">
                    Update Payment Method
                </button>

            </div>
        </footer>
    </section>


    @push('js')
        <script src="https://js.stripe.com/v3/"></script>

        <script>
            const stripe = Stripe("{{env('STRIPE_KEY')}}");
            const elements = stripe.elements();
            const cardElement = elements.create('card');
            cardElement.mount('#card-element');
        </script>

        <script>
            const cardHolderName = document.getElementById('card-holder-name');
            const cardButton = document.getElementById('card-button');
            const clientSecret = cardButton.dataset.secret;

            cardButton.addEventListener('click', async (e) => {
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

                if (error) {
                    // Display "error.message" to the user...
                } else {
                    // The card has been verified successfully...
                }
            });
        </script>
    @endpush

</div>
