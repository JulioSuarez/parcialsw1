@extends('dashboard')

@section('content')
    {{-- escoger un plan --}}
    <div class="bg-white dark:bg-gray-900">
        <div class="container px-6 py-8 mx-auto">
            <p class="text-xl text-center text-gray-500 dark:text-gray-300">
                A que te dedicas
            </p>

            <h1 class="mt-4 text-3xl font-semibold text-center text-gray-800 lg:text-4xl dark:text-white">Precios y
                Planes</h1>


            <div class="mt-6 space-y-8 xl:mt-12">
                <div
                    class="flex items-center justify-between max-w-2xl px-8 py-4 mx-auto border cursor-pointer rounded-xl dark:border-gray-700">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400 sm:h-9 sm:w-9" viewBox="0 0 20 20"
                            fill="currentColor">
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

                {{-- <div
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
                </div> --}}

                <div class="flex justify-center">
                    <button
                        class="px-8 py-2 tracking-wide text-white capitalize transition-colors duration-200 transform bg-blue-600 rounded-md hover:bg-blue-500 focus:outline-none focus:bg-blue-500 focus:ring focus:ring-blue-300 focus:ring-opacity-80">
                        Choose Plan
                    </button>
                </div>
            </div>
        </div>
    </div>
    {{-- /escoger un plan --}}


    una vez elige su rol, tendra que rellenar/registrar nueva informacion requerida

    <div class="bg-white px-8 py-6 rounded-lg shadow-lg mx-auto my-8 max-w-xl">
        <div class="flex flex-col md:flex-row justify-center items-center md:justify-start">
            <div class="md:w-2/3 mb-8 md:mb-0">
                <form action="#" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="photo">Foto de Perfil</label>
                        <input class="border-gray-400 p-2 w-full" type="file" name="photo" id="photo">
                    </div>
                    <div class="mb-4">
                        <button class="bg-blue-500 text-white px-4 py-2 rounded font-medium w-full hover:bg-blue-600"
                            type="submit">Subir Foto</button>
                    </div>
                </form>
            </div>
            <div class="md:w-1/3">
                <img class="rounded-lg shadow-lg mb-4" src="{{ asset('img/default.png') }}" alt="Foto de Perfil">
            </div>
        </div>
    </div>

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
    </div>
    {{-- /formulario --}}

    {{-- tarjeta central --}}
    <div class="flex flex-col justify-center items-center h-[100vh]">
        <div
            class="!z-5 relative flex flex-col rounded-[20px] max-w-[640px] bg-white bg-clip-border shadow-3xl shadow-shadow-500 flex flex-col w-full !p-4 3xl:p-![18px] bg-white undefined">
            <div class="h-full w-full">
                <div class="relative w-full">
                    <img src="{{ asset('img/default2.png') }}" class="mb-3 h-full w-full rounded-xl 3xl:h-full 3xl:w-full"
                        alt="">
                    {{-- <button
                        class="absolute top-3 right-3 flex items-center justify-center rounded-full bg-white p-2 text-brand-500 hover:cursor-pointer">
                        <div class="flex h-full w-full items-center justify-center rounded-full text-xl hover:bg-gray-50">
                            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512"
                                height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                <path fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"
                                    d="M352.92 80C288 80 256 144 256 144s-32-64-96.92-64c-52.76 0-94.54 44.14-95.08 96.81-1.1 109.33 86.73 187.08 183 252.42a16 16 0 0018 0c96.26-65.34 184.09-143.09 183-252.42-.54-52.67-42.32-96.81-95.08-96.81z">
                                </path>
                            </svg>
                        </div>
                    </button> --}}
                </div>
                <div class="mb-3 flex items-center justify-between px-1 md:items-start">
                    <div class="mb-2">
                        <p class="mt-1 text-sm font-medium text-blue-600 md:mt-2">Creo que apareces en esta foto: </p>
                        <p class="text-lg font-bold text-navy-700"> Boda de Jorge y Alejandra </p>
                        <p class="mt-1 text-sm font-medium text-gray-600 md:mt-1">29-04-2023 </p>
                    </div>
                    {{-- <div class="flex flex-row-reverse md:mt-2 lg:mt-0">
                        <span
                            class="z-0 ml-px inline-flex h-8 w-8 items-center justify-center rounded-full border-2 border-white bg-[#E0E5F2] text-xs text-navy-700 ">+5</span><span
                            class="z-10 -mr-3 h-8 w-8 rounded-full border-2 border-white">
                            <img class="h-full w-full rounded-full object-cover"
                                src="https://horizon-tailwind-react-git-tailwind-components-horizon-ui.vercel.app/static/media/avatar1.eeef2af6dfcd3ff23cb8.png"
                                alt="">
                        </span>
                        <span class="z-10 -mr-3 h-8 w-8 rounded-full border-2 border-white">
                            <img class="h-full w-full rounded-full object-cover"
                                src="https://horizon-tailwind-react-git-tailwind-components-horizon-ui.vercel.app/static/media/avatar2.5692c39db4f8c0ea999e.png"
                                alt="">
                        </span>
                        <span class="z-10 -mr-3 h-8 w-8 rounded-full border-2 border-white">
                            <img class="h-full w-full rounded-full object-cover"
                                src="https://horizon-tailwind-react-git-tailwind-components-horizon-ui.vercel.app/static/media/avatar3.9f646ac5920fa40adf00.png"
                                alt="">
                        </span>
                    </div> --}}
                </div>
                <div class="flex items-center justify-between md:items-center lg:justify-between ">
                    <button href=""
                        class="linear rounded-[20px] bg-brand-900 px-4 py-2 text-base font-medium text-white transition duration-200 hover:bg-brand-800 active:bg-brand-700">
                        Comprar Foto</button>
                    {{-- <div class="flex">
                        <p class="!mb-0 text-sm font-bold text-brand-500">Current Bid: 0.91 <span>ETH</span></p>
                    </div> --}}

                </div>
            </div>
        </div>
    </div>
    {{-- /tarjeta central --}}


    {{-- tarjeta para pefil del foto estudio o fotografo --}}
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="flex flex-col items-center w-full max-w-xs p-4 bg-white rounded-3xl md:flex-row">
            <div class="-mt-28 md:-my-16 md:-ml-32" style="clip-path: url(#roundedPolygon)">
                <img class="w-auto h-48"
                    src="https://avatars.githubusercontent.com/u/57622665?s=460&u=8f581f4c4acd4c18c33a87b3e6476112325e8b38&v=4"
                    alt="Ahmed Kamel" />
            </div>
            <div class="flex flex-col space-y-4">
                <div class="flex flex-col items-center md:items-start">
                    <h2 class="text-xl font-medium">Ahmed Kamel</h2>
                    <p class="text-base font-medium text-gray-400">Full Stack Developer</p>
                </div>
                <div class="flex items-center justify-center space-x-3 md:justify-start">
                    <!-- Icons source => https://boxicons.com/ -->
                    <a href="https://twitter.com/ak_kamona" target="_blank"
                        class="transition-transform transform hover:scale-125">
                        <span class="sr-only">Twitter</span>
                        <svg aria-hidden="true" class="w-8 h-8 text-blue-500" fill="currentColor"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path
                                d="M19.633,7.997c0.013,0.175,0.013,0.349,0.013,0.523c0,5.325-4.053,11.461-11.46,11.461c-2.282,0-4.402-0.661-6.186-1.809 c0.324,0.037,0.636,0.05,0.973,0.05c1.883,0,3.616-0.636,5.001-1.721c-1.771-0.037-3.255-1.197-3.767-2.793 c0.249,0.037,0.499,0.062,0.761,0.062c0.361,0,0.724-0.05,1.061-0.137c-1.847-0.374-3.23-1.995-3.23-3.953v-0.05 c0.537,0.299,1.16,0.486,1.82,0.511C3.534,9.419,2.823,8.184,2.823,6.787c0-0.748,0.199-1.434,0.548-2.032 c1.983,2.443,4.964,4.04,8.306,4.215c-0.062-0.3-0.1-0.611-0.1-0.923c0-2.22,1.796-4.028,4.028-4.028 c1.16,0,2.207,0.486,2.943,1.272c0.91-0.175,1.782-0.512,2.556-0.973c-0.299,0.935-0.936,1.721-1.771,2.22 c0.811-0.088,1.597-0.312,2.319-0.624C21.104,6.712,20.419,7.423,19.633,7.997z">
                            </path>
                        </svg>
                    </a>
                    <a href="https://github.com/Kamona-WD" target="_blank"
                        class="transition-transform transform hover:scale-125">
                        <span class="sr-only">Github</span>
                        <svg aria-hidden="true" class="w-8 h-8 text-black" fill="currentColor"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M12.026,2c-5.509,0-9.974,4.465-9.974,9.974c0,4.406,2.857,8.145,6.821,9.465 c0.499,0.09,0.679-0.217,0.679-0.481c0-0.237-0.008-0.865-0.011-1.696c-2.775,0.602-3.361-1.338-3.361-1.338 c-0.452-1.152-1.107-1.459-1.107-1.459c-0.905-0.619,0.069-0.605,0.069-0.605c1.002,0.07,1.527,1.028,1.527,1.028 c0.89,1.524,2.336,1.084,2.902,0.829c0.091-0.645,0.351-1.085,0.635-1.334c-2.214-0.251-4.542-1.107-4.542-4.93 c0-1.087,0.389-1.979,1.024-2.675c-0.101-0.253-0.446-1.268,0.099-2.64c0,0,0.837-0.269,2.742,1.021 c0.798-0.221,1.649-0.332,2.496-0.336c0.849,0.004,1.701,0.115,2.496,0.336c1.906-1.291,2.742-1.021,2.742-1.021 c0.545,1.372,0.203,2.387,0.099,2.64c0.64,0.696,1.024,1.587,1.024,2.675c0,3.833-2.33,4.675-4.552,4.922 c0.355,0.308,0.675,0.916,0.675,1.846c0,1.334-0.012,2.41-0.012,2.737c0,0.267,0.178,0.577,0.687,0.479 C19.146,20.115,22,16.379,22,11.974C22,6.465,17.535,2,12.026,2z">
                            </path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>



        <svg width="0" height="0" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <!-- rounded polygon generator => https://weareoutman.github.io/rounded-polygon/ -->
                <!-- polygon size 190 * 190 almost the same size as the image -->
                <clipPath id="roundedPolygon">
                    <path
                        d="M79 6.237604307034a32 32 0 0 1 32 0l52.870489570875 30.524791385932a32 32 0 0 1 16 27.712812921102l0 61.049582771864a32 32 0 0 1 -16 27.712812921102l-52.870489570875 30.524791385932a32 32 0 0 1 -32 0l-52.870489570875 -30.524791385932a32 32 0 0 1 -16 -27.712812921102l0 -61.049582771864a32 32 0 0 1 16 -27.712812921102" />
                </clipPath>
            </defs>
        </svg>
    </div>


    {{-- <div class="fixed bottom-5 right-5 flex items-center space-x-4">
        <a href="https://twitter.com/ak_kamona" target="_blank" class="transition-transform transform hover:scale-125">
            <span class="sr-only">Twitter</span>
            <svg aria-hidden="true" class="w-8 h-8 text-blue-500" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24">
                <path
                    d="M19.633,7.997c0.013,0.175,0.013,0.349,0.013,0.523c0,5.325-4.053,11.461-11.46,11.461c-2.282,0-4.402-0.661-6.186-1.809 c0.324,0.037,0.636,0.05,0.973,0.05c1.883,0,3.616-0.636,5.001-1.721c-1.771-0.037-3.255-1.197-3.767-2.793 c0.249,0.037,0.499,0.062,0.761,0.062c0.361,0,0.724-0.05,1.061-0.137c-1.847-0.374-3.23-1.995-3.23-3.953v-0.05 c0.537,0.299,1.16,0.486,1.82,0.511C3.534,9.419,2.823,8.184,2.823,6.787c0-0.748,0.199-1.434,0.548-2.032 c1.983,2.443,4.964,4.04,8.306,4.215c-0.062-0.3-0.1-0.611-0.1-0.923c0-2.22,1.796-4.028,4.028-4.028 c1.16,0,2.207,0.486,2.943,1.272c0.91-0.175,1.782-0.512,2.556-0.973c-0.299,0.935-0.936,1.721-1.771,2.22 c0.811-0.088,1.597-0.312,2.319-0.624C21.104,6.712,20.419,7.423,19.633,7.997z">
                </path>
            </svg>
        </a>
        <a href="https://github.com/Kamona-WD" target="_blank" class="transition-transform transform hover:scale-125">
            <span class="sr-only">Github</span>
            <svg aria-hidden="true" class="w-8 h-8 text-black" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M12.026,2c-5.509,0-9.974,4.465-9.974,9.974c0,4.406,2.857,8.145,6.821,9.465 c0.499,0.09,0.679-0.217,0.679-0.481c0-0.237-0.008-0.865-0.011-1.696c-2.775,0.602-3.361-1.338-3.361-1.338 c-0.452-1.152-1.107-1.459-1.107-1.459c-0.905-0.619,0.069-0.605,0.069-0.605c1.002,0.07,1.527,1.028,1.527,1.028 c0.89,1.524,2.336,1.084,2.902,0.829c0.091-0.645,0.351-1.085,0.635-1.334c-2.214-0.251-4.542-1.107-4.542-4.93 c0-1.087,0.389-1.979,1.024-2.675c-0.101-0.253-0.446-1.268,0.099-2.64c0,0,0.837-0.269,2.742,1.021 c0.798-0.221,1.649-0.332,2.496-0.336c0.849,0.004,1.701,0.115,2.496,0.336c1.906-1.291,2.742-1.021,2.742-1.021 c0.545,1.372,0.203,2.387,0.099,2.64c0.64,0.696,1.024,1.587,1.024,2.675c0,3.833-2.33,4.675-4.552,4.922 c0.355,0.308,0.675,0.916,0.675,1.846c0,1.334-0.012,2.41-0.012,2.737c0,0.267,0.178,0.577,0.687,0.479 C19.146,20.115,22,16.379,22,11.974C22,6.465,17.535,2,12.026,2z">
                </path>
            </svg>
        </a>
    </div> --}}
    {{-- /tarjeta para pefil del foto estudio o fotografo --}}

    {{-- social feet --}}
    <!-- component nav -->
    <nav class="flex dark:bg-slate-900 items-center relative justify-between bg-white px-5 py-6 w-full">
        <div>
            <svg width="41" height="39" viewBox="0 0 41 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path class="dark:fill-white"
                    d="M8.63077 14.8549C8.82584 14.8549 9.01902 14.8165 9.19926 14.7418C9.37949 14.6672 9.54324 14.5578 9.68119 14.4198C9.81914 14.2819 9.92858 14.1182 10.0032 13.9379C10.0779 13.7577 10.1163 13.5645 10.1163 13.3695C10.1163 10.6116 11.2119 7.9667 13.162 6.0166C15.112 4.0665 17.757 2.97094 20.5148 2.97094C23.2727 2.97094 25.9176 4.0665 27.8677 6.0166C29.8178 7.9667 30.9134 10.6116 30.9134 13.3695C30.9172 13.7609 31.0754 14.1349 31.3537 14.4103C31.6317 14.6857 32.0074 14.8402 32.3989 14.8402C32.7903 14.8402 33.1659 14.6857 33.444 14.4103C33.7222 14.1349 33.8804 13.7609 33.8843 13.3695C33.8843 11.6138 33.5385 9.87525 32.8666 8.25319C32.1947 6.63113 31.21 5.15729 29.9685 3.91582C28.7269 2.67435 27.2531 1.68956 25.6311 1.01769C24.009 0.345811 22.2706 0 20.5148 0C18.7591 0 17.0207 0.345811 15.3985 1.01769C13.7765 1.68956 12.3027 2.67435 11.0612 3.91582C9.81972 5.15729 8.83494 6.63113 8.16305 8.25319C7.49118 9.87525 7.14537 11.6138 7.14537 13.3695C7.14537 13.7634 7.30187 14.1412 7.58043 14.4198C7.859 14.6984 8.23682 14.8549 8.63077 14.8549Z"
                    fill="#1A1E2C" />
                <path class="dark:fill-white"
                    d="M39.5293 17.8258H26.452C27.4202 16.5421 27.9432 14.9775 27.9415 13.3695C27.9415 11.3996 27.1589 9.51035 25.7661 8.11742C24.3731 6.72449 22.4838 5.94196 20.5139 5.94196C18.5442 5.94196 16.655 6.72449 15.262 8.11742C13.869 9.51035 13.0865 11.3996 13.0865 13.3695C13.0865 13.7635 13.243 14.1413 13.5216 14.4199C13.8002 14.6985 14.1781 14.855 14.5721 14.855C14.9661 14.855 15.344 14.6985 15.6225 14.4199C15.9011 14.1413 16.0576 13.7635 16.0576 13.3695C16.0576 12.488 16.3189 11.6264 16.8086 10.8935C17.2983 10.1606 17.9943 9.58942 18.8086 9.25209C19.6229 8.91477 20.519 8.8265 21.3834 8.99844C22.2479 9.17038 23.0421 9.59481 23.6652 10.218C24.2885 10.8413 24.713 11.6354 24.885 12.4998C25.0569 13.3643 24.9687 14.2604 24.6314 15.0746C24.294 15.889 23.7229 16.5851 22.99 17.0748C22.2571 17.5645 21.3955 17.8258 20.5141 17.8258H1.50039C1.30407 17.8239 1.1093 17.8608 0.927353 17.9347C0.745405 18.0084 0.579889 18.1175 0.440367 18.2556C0.300847 18.3938 0.190089 18.5581 0.114504 18.7393C0.0389171 18.9206 0 19.115 0 19.3113C0 19.5075 0.0389171 19.702 0.114504 19.8832C0.190089 20.0644 0.300847 20.2287 0.440367 20.367C0.579889 20.505 0.745405 20.6142 0.927353 20.6879C1.1093 20.7617 1.30407 20.7987 1.50039 20.7967H39.5293C39.9207 20.7929 40.2947 20.6346 40.5701 20.3564C40.8455 20.0784 41 19.7027 41 19.3113C41 18.9198 40.8455 18.5442 40.5701 18.2661C40.2947 17.9879 39.9207 17.8297 39.5293 17.8258Z"
                    fill="#0346F2" />
                <path class="dark:fill-white"
                    d="M32.3692 23.942C32.1742 23.942 31.981 23.9803 31.8007 24.055C31.6205 24.1296 31.4568 24.239 31.3188 24.377C31.1809 24.5149 31.0714 24.6786 30.9968 24.8589C30.9221 25.0391 30.8837 25.2323 30.8837 25.4274C30.8837 28.1852 29.7881 30.8301 27.838 32.7802C25.888 34.7303 23.243 35.8259 20.4852 35.8259C17.7273 35.8259 15.0824 34.7303 13.1323 32.7802C11.1822 30.8301 10.0866 28.1852 10.0866 25.4274C10.0828 25.036 9.92455 24.6619 9.64634 24.3865C9.36827 24.1111 8.99262 23.9566 8.6011 23.9566C8.20973 23.9566 7.83408 24.1111 7.55601 24.3865C7.2778 24.6619 7.11956 25.036 7.11571 25.4274C7.11571 27.1831 7.46155 28.9216 8.13336 30.5436C8.80532 32.1657 9.79004 33.6395 11.0315 34.881C12.2731 36.1225 13.7469 37.1072 15.3689 37.7791C16.991 38.451 18.7294 38.7968 20.4852 38.7968C22.2409 38.7968 23.9793 38.451 25.6015 37.7791C27.2235 37.1072 28.6973 36.1225 29.9388 34.881C31.1803 33.6395 32.1651 32.1657 32.8369 30.5436C33.5088 28.9216 33.8546 27.1831 33.8546 25.4274C33.8546 25.0334 33.6981 24.6556 33.4196 24.377C33.141 24.0985 32.7632 23.942 32.3692 23.942Z"
                    fill="#1A1E2C" />
                <path class="dark:fill-white"
                    d="M1.47071 20.971H14.548C13.5798 22.2547 13.0568 23.8193 13.0585 25.4274C13.0585 27.3973 13.8411 29.2865 15.2339 30.6794C16.6269 32.0723 18.5162 32.8549 20.4861 32.8549C22.4558 32.8549 24.345 32.0723 25.738 30.6794C27.131 29.2865 27.9135 27.3973 27.9135 25.4274C27.9135 25.0334 27.757 24.6555 27.4784 24.3769C27.1998 24.0983 26.8219 23.9418 26.4279 23.9418C26.0339 23.9418 25.656 24.0983 25.3775 24.3769C25.0989 24.6555 24.9424 25.0334 24.9424 25.4274C24.9424 26.3088 24.6811 27.1704 24.1914 27.9033C23.7017 28.6362 23.0057 29.2074 22.1914 29.5447C21.3771 29.882 20.481 29.9703 19.6166 29.7984C18.7521 29.6264 17.9579 29.202 17.3348 28.5788C16.7115 27.9555 16.287 27.1615 16.115 26.297C15.9431 25.4325 16.0313 24.5364 16.3686 23.7222C16.706 22.9078 17.2771 22.2117 18.01 21.722C18.7429 21.2323 19.6045 20.971 20.4859 20.971H39.4996C39.6959 20.9729 39.8907 20.936 40.0726 20.8622C40.2546 20.7885 40.4201 20.6793 40.5596 20.5412C40.6992 20.403 40.8099 20.2387 40.8855 20.0575C40.9611 19.8762 41 19.6818 41 19.4855C41 19.2893 40.9611 19.0948 40.8855 18.9136C40.8099 18.7324 40.6992 18.5681 40.5596 18.4299C40.4201 18.2918 40.2546 18.1826 40.0726 18.1089C39.8907 18.0351 39.6959 17.9981 39.4996 18.0001H1.47071C1.07935 18.0039 0.705326 18.1622 0.429928 18.4404C0.15453 18.7184 0 19.0941 0 19.4855C0 19.877 0.15453 20.2526 0.429928 20.5307C0.705326 20.8089 1.07935 20.9672 1.47071 20.971Z"
                    fill="#0346F2" />
            </svg>
        </div>
        <ul id="drawer" role="menu"
            class="sm:gap-3 transition-left ease-[cubic-bezier(0.4, 0.0, 0.2, 1)] delay-150  sm:flex  flex flex-col cursor-pointer absolute min-h-screen -left-48 sm:static w-48 top-0 bg-white sm:shadow-none shadow-xl sm:bg-transparent sm:flex-row sm:w-auto sm:min-h-0 dark:bg-slate-900  ">
            <div class="sm:hidden p-6 mb-5 flex items-center justify-center">
                <svg width="41" height="39" viewBox="0 0 41 39" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M8.63077 14.8549C8.82584 14.8549 9.01902 14.8165 9.19926 14.7418C9.37949 14.6672 9.54324 14.5578 9.68119 14.4198C9.81914 14.2819 9.92858 14.1182 10.0032 13.9379C10.0779 13.7577 10.1163 13.5645 10.1163 13.3695C10.1163 10.6116 11.2119 7.9667 13.162 6.0166C15.112 4.0665 17.757 2.97094 20.5148 2.97094C23.2727 2.97094 25.9176 4.0665 27.8677 6.0166C29.8178 7.9667 30.9134 10.6116 30.9134 13.3695C30.9172 13.7609 31.0754 14.1349 31.3537 14.4103C31.6317 14.6857 32.0074 14.8402 32.3989 14.8402C32.7903 14.8402 33.1659 14.6857 33.444 14.4103C33.7222 14.1349 33.8804 13.7609 33.8843 13.3695C33.8843 11.6138 33.5385 9.87525 32.8666 8.25319C32.1947 6.63113 31.21 5.15729 29.9685 3.91582C28.7269 2.67435 27.2531 1.68956 25.6311 1.01769C24.009 0.345811 22.2706 0 20.5148 0C18.7591 0 17.0207 0.345811 15.3985 1.01769C13.7765 1.68956 12.3027 2.67435 11.0612 3.91582C9.81972 5.15729 8.83494 6.63113 8.16305 8.25319C7.49118 9.87525 7.14537 11.6138 7.14537 13.3695C7.14537 13.7634 7.30187 14.1412 7.58043 14.4198C7.859 14.6984 8.23682 14.8549 8.63077 14.8549Z"
                        fill="#1A1E2C" />
                    <path
                        d="M39.5293 17.8258H26.452C27.4202 16.5421 27.9432 14.9775 27.9415 13.3695C27.9415 11.3996 27.1589 9.51035 25.7661 8.11742C24.3731 6.72449 22.4838 5.94196 20.5139 5.94196C18.5442 5.94196 16.655 6.72449 15.262 8.11742C13.869 9.51035 13.0865 11.3996 13.0865 13.3695C13.0865 13.7635 13.243 14.1413 13.5216 14.4199C13.8002 14.6985 14.1781 14.855 14.5721 14.855C14.9661 14.855 15.344 14.6985 15.6225 14.4199C15.9011 14.1413 16.0576 13.7635 16.0576 13.3695C16.0576 12.488 16.3189 11.6264 16.8086 10.8935C17.2983 10.1606 17.9943 9.58942 18.8086 9.25209C19.6229 8.91477 20.519 8.8265 21.3834 8.99844C22.2479 9.17038 23.0421 9.59481 23.6652 10.218C24.2885 10.8413 24.713 11.6354 24.885 12.4998C25.0569 13.3643 24.9687 14.2604 24.6314 15.0746C24.294 15.889 23.7229 16.5851 22.99 17.0748C22.2571 17.5645 21.3955 17.8258 20.5141 17.8258H1.50039C1.30407 17.8239 1.1093 17.8608 0.927353 17.9347C0.745405 18.0084 0.579889 18.1175 0.440367 18.2556C0.300847 18.3938 0.190089 18.5581 0.114504 18.7393C0.0389171 18.9206 0 19.115 0 19.3113C0 19.5075 0.0389171 19.702 0.114504 19.8832C0.190089 20.0644 0.300847 20.2287 0.440367 20.367C0.579889 20.505 0.745405 20.6142 0.927353 20.6879C1.1093 20.7617 1.30407 20.7987 1.50039 20.7967H39.5293C39.9207 20.7929 40.2947 20.6346 40.5701 20.3564C40.8455 20.0784 41 19.7027 41 19.3113C41 18.9198 40.8455 18.5442 40.5701 18.2661C40.2947 17.9879 39.9207 17.8297 39.5293 17.8258Z"
                        fill="#0346F2" />
                    <path
                        d="M32.3692 23.942C32.1742 23.942 31.981 23.9803 31.8007 24.055C31.6205 24.1296 31.4568 24.239 31.3188 24.377C31.1809 24.5149 31.0714 24.6786 30.9968 24.8589C30.9221 25.0391 30.8837 25.2323 30.8837 25.4274C30.8837 28.1852 29.7881 30.8301 27.838 32.7802C25.888 34.7303 23.243 35.8259 20.4852 35.8259C17.7273 35.8259 15.0824 34.7303 13.1323 32.7802C11.1822 30.8301 10.0866 28.1852 10.0866 25.4274C10.0828 25.036 9.92455 24.6619 9.64634 24.3865C9.36827 24.1111 8.99262 23.9566 8.6011 23.9566C8.20973 23.9566 7.83408 24.1111 7.55601 24.3865C7.2778 24.6619 7.11956 25.036 7.11571 25.4274C7.11571 27.1831 7.46155 28.9216 8.13336 30.5436C8.80532 32.1657 9.79004 33.6395 11.0315 34.881C12.2731 36.1225 13.7469 37.1072 15.3689 37.7791C16.991 38.451 18.7294 38.7968 20.4852 38.7968C22.2409 38.7968 23.9793 38.451 25.6015 37.7791C27.2235 37.1072 28.6973 36.1225 29.9388 34.881C31.1803 33.6395 32.1651 32.1657 32.8369 30.5436C33.5088 28.9216 33.8546 27.1831 33.8546 25.4274C33.8546 25.0334 33.6981 24.6556 33.4196 24.377C33.141 24.0985 32.7632 23.942 32.3692 23.942Z"
                        fill="#1A1E2C" />
                    <path
                        d="M1.47071 20.971H14.548C13.5798 22.2547 13.0568 23.8193 13.0585 25.4274C13.0585 27.3973 13.8411 29.2865 15.2339 30.6794C16.6269 32.0723 18.5162 32.8549 20.4861 32.8549C22.4558 32.8549 24.345 32.0723 25.738 30.6794C27.131 29.2865 27.9135 27.3973 27.9135 25.4274C27.9135 25.0334 27.757 24.6555 27.4784 24.3769C27.1998 24.0983 26.8219 23.9418 26.4279 23.9418C26.0339 23.9418 25.656 24.0983 25.3775 24.3769C25.0989 24.6555 24.9424 25.0334 24.9424 25.4274C24.9424 26.3088 24.6811 27.1704 24.1914 27.9033C23.7017 28.6362 23.0057 29.2074 22.1914 29.5447C21.3771 29.882 20.481 29.9703 19.6166 29.7984C18.7521 29.6264 17.9579 29.202 17.3348 28.5788C16.7115 27.9555 16.287 27.1615 16.115 26.297C15.9431 25.4325 16.0313 24.5364 16.3686 23.7222C16.706 22.9078 17.2771 22.2117 18.01 21.722C18.7429 21.2323 19.6045 20.971 20.4859 20.971H39.4996C39.6959 20.9729 39.8907 20.936 40.0726 20.8622C40.2546 20.7885 40.4201 20.6793 40.5596 20.5412C40.6992 20.403 40.8099 20.2387 40.8855 20.0575C40.9611 19.8762 41 19.6818 41 19.4855C41 19.2893 40.9611 19.0948 40.8855 18.9136C40.8099 18.7324 40.6992 18.5681 40.5596 18.4299C40.4201 18.2918 40.2546 18.1826 40.0726 18.1089C39.8907 18.0351 39.6959 17.9981 39.4996 18.0001H1.47071C1.07935 18.0039 0.705326 18.1622 0.429928 18.4404C0.15453 18.7184 0 19.0941 0 19.4855C0 19.877 0.15453 20.2526 0.429928 20.5307C0.705326 20.8089 1.07935 20.9672 1.47071 20.971Z"
                        fill="#0346F2" />
                </svg>
            </div>
            <li
                class="font-medium text-sm p-3 hover:bg-slate-300 dark:hover:bg-slate-800 sm:p-0 sm:hover:bg-transparent text-primary">
                <a href="#" class="dark:text-white">Men</a>
            </li>
            <li
                class="font-medium text-sm p-3 cursor-pointer hover:bg-slate-300 dark:hover:bg-slate-800 sm:p-0 sm:hover:bg-transparent text-gray-600 hover:text-primary transition-colors">
                <a href="#" class="dark:text-white">Women</a>
            </li>
            <li
                class="font-medium text-sm p-3 cursor-pointer hover:bg-slate-300 dark:hover:bg-slate-800 sm:p-0 sm:hover:bg-transparent text-gray-600 hover:text-primary transition-colors">
                <a href="#" class="dark:text-white">Kids</a>
            </li>
        </ul>
        <div class="flex gap-3 items-center">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path class="dark:fill-white" fill-rule="evenodd" clip-rule="evenodd"
                    d="M16.9303 7C16.9621 6.92913 16.977 6.85189 16.9739 6.77432H17C16.8882 4.10591 14.6849 2 12.0049 2C9.325 2 7.12172 4.10591 7.00989 6.77432C6.9967 6.84898 6.9967 6.92535 7.00989 7H6.93171C5.65022 7 4.28034 7.84597 3.88264 10.1201L3.1049 16.3147C2.46858 20.8629 4.81062 22 7.86853 22H16.1585C19.2075 22 21.4789 20.3535 20.9133 16.3147L20.1444 10.1201C19.676 7.90964 18.3503 7 17.0865 7H16.9303ZM15.4932 7C15.4654 6.92794 15.4506 6.85153 15.4497 6.77432C15.4497 4.85682 13.8899 3.30238 11.9657 3.30238C10.0416 3.30238 8.48184 4.85682 8.48184 6.77432C8.49502 6.84898 8.49502 6.92535 8.48184 7H15.4932ZM9.097 12.1486C8.60889 12.1486 8.21321 11.7413 8.21321 11.2389C8.21321 10.7366 8.60889 10.3293 9.097 10.3293C9.5851 10.3293 9.98079 10.7366 9.98079 11.2389C9.98079 11.7413 9.5851 12.1486 9.097 12.1486ZM14.002 11.2389C14.002 11.7413 14.3977 12.1486 14.8858 12.1486C15.3739 12.1486 15.7696 11.7413 15.7696 11.2389C15.7696 10.7366 15.3739 10.3293 14.8858 10.3293C14.3977 10.3293 14.002 10.7366 14.002 11.2389Z"
                    fill="#200E32" />
            </svg>

            <div
                class="h-10 w-10 hover:ring-4 user cursor-pointer relative ring-blue-700/30 rounded-full bg-cover bg-center bg-[url('https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80')]">

                <div class="drop-down  w-48 overflow-hidden bg-white rounded-md shadow absolute top-12 right-3">
                    <ul>
                        <li class="px-3 py-3 text-sm font-medium flex items-center space-x-2 hover:bg-slate-400">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </span>
                            <span> Setting </span>
                        </li>
                        <li class="px-3  py-3  text-sm font-medium flex items-center space-x-2 hover:bg-slate-400">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </span>
                            <span> Wishlist </span>
                        </li>
                        <li class="px-3  py-3 text-sm font-medium flex items-center space-x-2 hover:bg-slate-400">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                            </span>
                            <span> Logout </span>
                        </li>

                    </ul>
                </div>
            </div>
            <div class="sm:hidden cursor-pointer" id="mobile-toggle">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path class="dark:stroke-white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </div>
        </div>
    </nav>
    <!-- Component Start -->
    <div class="flex justify-center w-screen h-screen px-4 text-gray-700">
        <div class="flex w-full max-w-screen-lg">
            <div class="flex flex-col w-64 py-4 pr-3">
                <a class="flex px-3 py-2 mt-2 mt-auto text-lg rounded-sm font-medium hover:bg-gray-200" href="#">
                    <span class="flex-shrink-0 w-10 h-10 bg-gray-400 rounded-full"></span>
                    <div class="flex flex-col ml-2">
                        <span class="mt-1 text-sm font-semibold leading-none">Username</span>
                        <span class="mt-1 text-xs leading-none">@username</span>
                    </div>
                </a>
                <a class="px-3 py-2 mt-2 text-lg font-medium rounded-sm hover:bg-gray-300" href="#">Home</a>
                <a class="px-3 py-2 mt-2 text-lg font-medium rounded-sm hover:bg-gray-300" href="#">Discover</a>
                <a class="px-3 py-2 mt-2 text-lg font-medium rounded-sm hover:bg-gray-300"
                    href="#">Notifications</a>
                <a class="px-3 py-2 mt-2 text-lg font-medium rounded-sm hover:bg-gray-300" href="#">Inbox</a>
                <a class="px-3 py-2 mt-2 text-lg font-medium rounded-sm hover:bg-gray-300" href="#">Saved Posts</a>
                <a class="px-3 py-2 mt-2 text-lg font-medium rounded-sm hover:bg-gray-300" href="#">Groups</a>
                <a class="px-3 py-2 mt-2 text-lg font-medium rounded-sm hover:bg-gray-300" href="#">Profile</a>

            </div>
            <div class="flex flex-col flex-grow border-l border-r border-gray-300">
                <div class="flex justify-between flex-shrink-0 px-8 py-4 border-b border-gray-300">
                    <h1 class="text-xl font-semibold">Feed Title</h1>
                    <button class="flex items-center h-8 px-2 text-sm bg-gray-300 rounded-sm hover:bg-gray-400">New
                        post</button>
                </div>
                <div class="flex-grow h-0 overflow-auto">
                    <div class="flex w-full p-8 border-b-4 border-gray-300">
                        <span class="flex-shrink-0 w-12 h-12 bg-gray-400 rounded-full"></span>
                        <div class="flex flex-col flex-grow ml-4">
                            <textarea class="p-3 bg-transparent border border-gray-500 rounded-sm" name="" id="" rows="3"
                                placeholder="What's happening?"></textarea>
                            <div class="flex justify-between mt-2">
                                <button
                                    class="flex items-center h-8 px-3 text-xs rounded-sm hover:bg-gray-200">Attach</button>
                                <button
                                    class="flex items-center h-8 px-3 text-xs rounded-sm bg-gray-300 hover:bg-gray-400">Post</button>
                            </div>
                        </div>
                    </div>
                    <div class="flex w-full p-8 border-b border-gray-300">
                        <span class="flex-shrink-0 w-12 h-12 bg-gray-400 rounded-full"></span>
                        <div class="flex flex-col flex-grow ml-4">
                            <div class="flex">
                                <span class="font-semibold">Username</span>
                                <span class="ml-1">@username</span>
                                <span class="ml-auto text-sm">Just now</span>
                            </div>
                            <p class="mt-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. <a class="underline"
                                    href="#">#hashtag</a></p>
                            <div class="flex mt-2">
                                <button class="text-sm font-semibold">Like</button>
                                <button class="ml-2 text-sm font-semibold">Reply</button>
                                <button class="ml-2 text-sm font-semibold">Share</button>
                            </div>
                        </div>
                    </div>
                    <div class="flex w-full p-8 border-b border-gray-300">
                        <span class="flex-shrink-0 w-12 h-12 bg-gray-400 rounded-full"></span>
                        <div class="flex flex-col flex-grow ml-4">
                            <div class="flex">
                                <span class="font-semibold">Username</span>
                                <span class="ml-1">@username</span>
                                <span class="ml-auto text-sm">Just now</span>
                            </div>
                            <p class="mt-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. <a class="underline"
                                    href="#">#hashtag</a></p>
                            <div class="flex mt-2">
                                <button class="text-sm font-semibold">Like</button>
                                <button class="ml-2 text-sm font-semibold">Reply</button>
                                <button class="ml-2 text-sm font-semibold">Share</button>
                            </div>
                        </div>
                    </div>
                    <div class="flex w-full p-8 border-b border-gray-300">
                        <span class="flex-shrink-0 w-12 h-12 bg-gray-400 rounded-full"></span>
                        <div class="flex flex-col flex-grow ml-4">
                            <div class="flex">
                                <span class="font-semibold">Username</span>
                                <span class="ml-1">@username</span>
                                <span class="ml-auto text-sm">Just now</span>
                            </div>
                            <p class="mt-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. <a class="underline"
                                    href="#">#hashtag</a></p>
                            <div class="flex items-center justify-center h-64 mt-2 bg-gray-200">
                                <span class="font-semibold text-gray-500">Image</span>
                            </div>
                            <div class="flex mt-2">
                                <button class="text-sm font-semibold">Like</button>
                                <button class="ml-2 text-sm font-semibold">Reply</button>
                                <button class="ml-2 text-sm font-semibold">Share</button>
                            </div>
                        </div>
                    </div>
                    <div class="flex w-full p-8 border-b border-gray-300">
                        <span class="flex-shrink-0 w-12 h-12 bg-gray-400 rounded-full"></span>
                        <div class="flex flex-col flex-grow ml-4">
                            <div class="flex">
                                <span class="font-semibold">Username</span>
                                <span class="ml-1">@username</span>
                                <span class="ml-auto text-sm">Just now</span>
                            </div>
                            <p class="mt-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. <a class="underline"
                                    href="#">#hashtag</a></p>
                            <div class="flex mt-2">
                                <button class="text-sm font-semibold">Like</button>
                                <button class="ml-2 text-sm font-semibold">Reply</button>
                                <button class="ml-2 text-sm font-semibold">Share</button>
                            </div>
                        </div>
                    </div>
                    <div class="flex w-full p-8 border-b border-gray-300">
                        <span class="flex-shrink-0 w-12 h-12 bg-gray-400 rounded-full"></span>
                        <div class="flex flex-col flex-grow ml-4">
                            <div class="flex">
                                <span class="font-semibold">Username</span>
                                <span class="ml-1">@username</span>
                                <span class="ml-auto text-sm">Just now</span>
                            </div>
                            <p class="mt-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. <a class="underline"
                                    href="#">#hashtag</a></p>
                            <div class="flex mt-2">
                                <button class="text-sm font-semibold">Like</button>
                                <button class="ml-2 text-sm font-semibold">Reply</button>
                                <button class="ml-2 text-sm font-semibold">Share</button>
                            </div>
                        </div>
                    </div>
                    <div class="flex w-full p-8 border-b border-gray-300">
                        <span class="flex-shrink-0 w-12 h-12 bg-gray-400 rounded-full"></span>
                        <div class="flex flex-col flex-grow ml-4">
                            <div class="flex">
                                <span class="font-semibold">Username</span>
                                <span class="ml-1">@username</span>
                                <span class="ml-auto text-sm">Just now</span>
                            </div>
                            <p class="mt-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. <a class="underline"
                                    href="#">#hashtag</a></p>
                            <div class="flex items-center justify-center h-64 mt-2 bg-gray-200">
                                <span class="font-semibold text-gray-500">Image</span>
                            </div>
                            <div class="flex mt-2">
                                <button class="text-sm font-semibold">Like</button>
                                <button class="ml-2 text-sm font-semibold">Reply</button>
                                <button class="ml-2 text-sm font-semibold">Share</button>
                            </div>
                        </div>
                    </div>
                    <div class="flex w-full p-8 border-b border-gray-300">
                        <span class="flex-shrink-0 w-12 h-12 bg-gray-400 rounded-full"></span>
                        <div class="flex flex-col flex-grow ml-4">
                            <div class="flex">
                                <span class="font-semibold">Username</span>
                                <span class="ml-1">@username</span>
                                <span class="ml-auto text-sm">Just now</span>
                            </div>
                            <p class="mt-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. <a class="underline"
                                    href="#">#hashtag</a></p>
                            <div class="flex items-center justify-center h-64 mt-2 bg-gray-200">
                                <span class="font-semibold text-gray-500">Image</span>
                            </div>
                            <div class="flex mt-2">
                                <button class="text-sm font-semibold">Like</button>
                                <button class="ml-2 text-sm font-semibold">Reply</button>
                                <button class="ml-2 text-sm font-semibold">Share</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-col flex-shrink-0 w-1/4 py-4 pl-4">
                <input class="flex items-center h-8 px-2 border border-gray-500 rounded-sm" type="search"
                    Placeholder="Search…">
                <div>
                    <h3 class="mt-6 font-semibold">Trending</h3>
                    <div class="flex w-full py-4 border-b border-gray-300">
                        <span class="flex-shrink-0 w-10 h-10 bg-gray-400 rounded-full"></span>
                        <div class="flex flex-col flex-grow ml-2">
                            <div class="flex text-sm">
                                <span class="font-semibold">Username</span>
                                <span class="ml-1">@username</span>
                            </div>
                            <p class="mt-1 text-sm">Lorem ipsum dolor sit amet, consectetur adipiscing elit, et dolore
                                magna aliqua. <a class="underline" href="#">#hashtag</a></p>
                        </div>
                    </div>
                    <div class="flex w-full py-4 border-b border-gray-300">
                        <span class="flex-shrink-0 w-10 h-10 bg-gray-400 rounded-full"></span>
                        <div class="flex flex-col flex-grow ml-2">
                            <div class="flex text-sm">
                                <span class="font-semibold">Username</span>
                                <span class="ml-1">@username</span>
                            </div>
                            <p class="mt-1 text-sm">Lorem ipsum dolor sit amet, consectetur adipiscing elit, et dolore
                                magna aliqua. <a class="underline" href="#">#hashtag</a></p>
                        </div>
                    </div>
                    <div class="flex w-full py-4 border-b border-gray-300">
                        <span class="flex-shrink-0 w-10 h-10 bg-gray-400 rounded-full"></span>
                        <div class="flex flex-col flex-grow ml-2">
                            <div class="flex text-sm">
                                <span class="font-semibold">Username</span>
                                <span class="ml-1">@username</span>
                            </div>
                            <p class="mt-1 text-sm">Lorem ipsum dolor sit amet, consectetur adipiscing elit, et dolore
                                magna aliqua. <a class="underline" href="#">#hashtag</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Component End  -->

    {{-- <a class="fixed flex items-center justify-center h-8 pr-2 pl-1 bg-blue-600 rounded-full bottom-0 right-0 mr-4 mb-4 shadow-lg text-blue-100 hover:bg-blue-600"
        href="https://twitter.com/lofiui" target="_top">
        <div class="flex items-center justify-center h-6 w-6 bg-blue-500 rounded-full">
            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"
                class="r-jwli3a r-4qtqp9 r-yyyyoo r-16y2uox r-1q142lx r-8kz0gk r-dnmrzs r-bnwqim r-1plcrui r-lrvibr r-1srniue">
                <g>
                    <path
                        d="M23.643 4.937c-.835.37-1.732.62-2.675.733.962-.576 1.7-1.49 2.048-2.578-.9.534-1.897.922-2.958 1.13-.85-.904-2.06-1.47-3.4-1.47-2.572 0-4.658 2.086-4.658 4.66 0 .364.042.718.12 1.06-3.873-.195-7.304-2.05-9.602-4.868-.4.69-.63 1.49-.63 2.342 0 1.616.823 3.043 2.072 3.878-.764-.025-1.482-.234-2.11-.583v.06c0 2.257 1.605 4.14 3.737 4.568-.392.106-.803.162-1.227.162-.3 0-.593-.028-.877-.082.593 1.85 2.313 3.198 4.352 3.234-1.595 1.25-3.604 1.995-5.786 1.995-.376 0-.747-.022-1.112-.065 2.062 1.323 4.51 2.093 7.14 2.093 8.57 0 13.255-7.098 13.255-13.254 0-.2-.005-.402-.014-.602.91-.658 1.7-1.477 2.323-2.41z">
                    </path>
                </g>
            </svg>
        </div>
        <span class="text-sm ml-1 leading-none">@tailwind</span>
    </a> --}}
    {{-- /social feet --}}



    {{-- notificaciones --}}
    <!-- component -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>


    <div class="flex justify-center h-screen">
        <div x-data="{ dropdownOpen: true }" class="relative my-32">
            <button @click="dropdownOpen = !dropdownOpen"
                class="relative z-10 block rounded-md bg-white p-2 focus:outline-none">
                <svg class="h-5 w-5 text-gray-800" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path
                        d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
                </svg>
            </button>

            <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 h-full w-full z-10"></div>

            <div x-show="dropdownOpen" class="absolute right-0 mt-2 bg-white rounded-md shadow-lg overflow-hidden z-20"
                style="width:20rem;">
                <div class="py-2">
                    <a href="#" class="flex items-center px-4 py-3 border-b hover:bg-gray-100 -mx-2">
                        <img class="h-8 w-8 rounded-full object-cover mx-1"
                            src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=334&q=80"
                            alt="avatar">
                        <p class="text-gray-600 text-sm mx-2">
                            <span class="font-bold" href="#">Sara Salah</span> replied on the <span
                                class="font-bold text-blue-500" href="#">Upload Image</span> artical . 2m
                        </p>
                    </a>
                    <a href="#" class="flex items-center px-4 py-3 border-b hover:bg-gray-100 -mx-2">
                        <img class="h-8 w-8 rounded-full object-cover mx-1"
                            src="https://images.unsplash.com/photo-1531427186611-ecfd6d936c79?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=634&q=80"
                            alt="avatar">
                        <p class="text-gray-600 text-sm mx-2">
                            <span class="font-bold" href="#">Slick Net</span> start following you . 45m
                        </p>
                    </a>
                    <a href="#" class="flex items-center px-4 py-3 border-b hover:bg-gray-100 -mx-2">
                        <img class="h-8 w-8 rounded-full object-cover mx-1"
                            src="https://images.unsplash.com/photo-1450297350677-623de575f31c?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=334&q=80"
                            alt="avatar">
                        <p class="text-gray-600 text-sm mx-2">
                            <span class="font-bold" href="#">Jane Doe</span> Like Your reply on <span
                                class="font-bold text-blue-500" href="#">Test with TDD</span> artical . 1h
                        </p>
                    </a>
                    <a href="#" class="flex items-center px-4 py-3 hover:bg-gray-100 -mx-2">
                        <img class="h-8 w-8 rounded-full object-cover mx-1"
                            src="https://images.unsplash.com/photo-1580489944761-15a19d654956?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=398&q=80"
                            alt="avatar">
                        <p class="text-gray-600 text-sm mx-2">
                            <span class="font-bold" href="#">Abigail Bennett</span> start following you . 3h
                        </p>
                    </a>
                </div>
                <a href="#" class="block bg-gray-800 text-white text-center font-bold py-2">See all
                    notifications</a>
            </div>
        </div>
    </div>
    {{-- /notificaciones --}}
@endsection
