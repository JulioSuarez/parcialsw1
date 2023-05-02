@extends('template.profile')

@section('jcst')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <div class="my-2 bg-white dark:bg-gray-900 rounded-xl">
        <div class="container px-6 py-8 mx-auto">
            <p class="text-xl text-center text-gray-500 dark:text-gray-300">
                A que te dedicas
            </p>

            <h1 class="mt-4 text-3xl font-semibold text-center text-gray-800 lg:text-4xl dark:text-white">Precios y
                Planes</h1>


            <div class="mt-6 space-y-8 xl:mt-12">
                <div class="flex items-center justify-between max-w-2xl px-8 py-4 mx-auto border cursor-pointer rounded-xl dark:border-gray-700"
                    data-selected="false" onclick="toggleSelection(event)">


                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400 sm:h-9 sm:w-9"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>

                        <div class="flex flex-col items-center mx-5 space-y-1">
                            <h2 class="text-lg font-medium text-gray-700 sm:text-2xl dark:text-gray-200">Organizador</h2>
                            <div
                                class="px-2 text-xs text-blue-500 bg-gray-100 rounded-full sm:px-4 sm:py-1 dark:bg-gray-700 ">
                                Save 20%
                            </div>
                        </div>
                    </div>

                    <h2 class="text-2xl font-semibold text-gray-500 sm:text-4xl dark:text-gray-300">$49 <span
                            class="text-base font-medium">/Anual</span></h2>
                </div>

                <div
                    class="flex items-center justify-between max-w-2xl px-8 py-4 mx-auto border border-blue-500 cursor-pointer rounded-xl">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600 sm:h-9 sm:w-9"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>

                        <div class="flex flex-col items-center mx-5 space-y-1">
                            <h2 class="text-lg font-medium text-gray-700 sm:text-2xl dark:text-gray-200">Estudio Fotografico
                            </h2>
                            <div
                                class="px-2 text-xs text-blue-500 bg-gray-100 rounded-full sm:px-4 sm:py-1 dark:bg-gray-700 ">
                                Save 20%
                            </div>
                        </div>
                    </div>

                    <h2 class="text-2xl font-semibold text-blue-600 sm:text-4xl">$49 <span
                            class="text-base font-medium">/Anual</span></h2>
                </div>

                <div
                    class="flex items-center justify-between max-w-2xl px-8 py-4 mx-auto border cursor-pointer rounded-xl dark:border-gray-700">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400 sm:h-9 sm:w-9"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>

                        <div class="flex flex-col items-center mx-5 space-y-1">
                            <h2 class="text-lg font-medium text-gray-700 sm:text-2xl dark:text-gray-200">Enterprise</h2>
                            <div
                                class="px-2 text-xs text-blue-500 bg-gray-100 rounded-full sm:px-4 sm:py-1 dark:bg-gray-700 ">
                                Save 20%
                            </div>
                        </div>
                    </div>

                    <h2 class="text-2xl font-semibold text-gray-500 sm:text-4xl dark:text-gray-300">$149 <span
                            class="text-base font-medium">/Month</span></h2>
                </div>

                <div class="flex justify-center">
                    <button
                        class="px-8 py-2 tracking-wide text-white capitalize transition-colors duration-200 transform bg-blue-600 rounded-md hover:bg-blue-500 focus:outline-none focus:bg-blue-500 focus:ring focus:ring-blue-300 focus:ring-opacity-80">
                        Choose Plan
                    </button>
                </div>
            </div>

            <SPan>
                una vez elige su rol, tendra que rellenar/registrar nueva informacion requerida
            </SPan>
            {{-- formulario --}}
            <div class="flex flex-col justify-center items-center h-[100vh]">
                <div
                    class="!z-5 relative flex flex-col rounded-[20px] max-w-[300px] md:max-w-[400px] bg-white bg-clip-border shadow-3xl shadow-shadow-500 flex flex-col w-full !p-6 3xl:p-![18px] bg-white undefined">

                    <div class="relative flex flex-row justify-between">
                        <h4 class="text-xl font-bold text-navy-700 dark:text-white mb-3">
                            Horizon UI Inputs
                        </h4>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="text-sm text-navy-700 dark:text-white font-bold">Default</label>
                        <input type="text" id="email" placeholder="@horizon.ui"
                            class="mt-2 flex h-12 w-full items-center justify-center rounded-xl border bg-white/0 p-3 text-sm outline-none border-gray-200">
                    </div>
                    <div class="mb-3">
                        <label for="email2" class="text-sm text-navy-700 dark:text-white font-bold">Success</label>
                        <input type="text" id="email2" placeholder="Success input"
                            class="mt-2 flex h-12 w-full items-center justify-center rounded-xl border bg-white/0 p-3 text-sm outline-none border-green-500 text-green-500 placeholder:text-green-500 dark:!border-green-400 dark:!text-green-400 dark:placeholder:!text-green-400">
                    </div>
                    <div class="mb-3">
                        <label for="email3" class="text-sm text-navy-700 dark:text-white font-bold">Error</label>
                        <input type="text" id="email3" placeholder="Error input"
                            class="mt-2 flex h-12 w-full items-center justify-center rounded-xl border bg-white/0 p-3 text-sm outline-none border-red-500 text-red-500 placeholder:text-red-500 dark:!border-red-400 dark:!text-red-400 dark:placeholder:!text-red-400">
                    </div>
                    <div>
                        <label for="email4" class="text-sm text-navy-700 dark:text-white font-bold">Disabled</label>
                        <input disabled="" type="text" id="email4" placeholder="@horizon.ui"
                            class="mt-2 flex h-12 w-full items-center justify-center rounded-xl border bg-white/0 p-3 text-sm outline-none !border-none !bg-gray-100 cursor-not-allowed dark:!bg-white/5 ">
                    </div>
                </div>
            </div>
            {{-- /formulario --}}
        </div>
    </div>
    {{-- /escoger un plan --}}
@endsection
