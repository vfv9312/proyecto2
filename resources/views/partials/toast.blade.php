<div 
    x-data="{ show: false, message: '', type: 'success' }" 
    x-init="@if(session()->has('success')) show = true; message = '{{ session('success') }}'; type = 'success'; setTimeout(() => show = false, 3000); @endif
            @if(session()->has('error')) show = true; message = '{{ session('error') }}'; type = 'error'; setTimeout(() => show = false, 3000); @endif
            @if(session()->has('warning')) show = true; message = '{{ session('warning') }}'; type = 'warning'; setTimeout(() => show = false, 3000); @endif
            @if(session()->has('info')) show = true; message = '{{ session('info') }}'; type = 'info'; setTimeout(() => show = false, 3000); @endif"
    x-on:alert.window="show = true; message = $event.detail.message; type = $event.detail.type; setTimeout(() => show = false, 3000)"
    x-show="show"
    x-transition:enter="transition ease-out duration-300 transform"
    x-transition:enter-start="opacity-0 translate-y-2"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-200 transform"
    x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 translate-y-2"
    class="fixed top-6 left-1/2 transform -translate-x-1/2 z-50 w-full max-w-sm"
    style="display: none;">
    
    <div :class="{
        'bg-white dark:bg-gray-800 border-l-4 border-green-500 text-green-700 dark:text-green-400': type === 'success',
        'bg-white dark:bg-gray-800 border-l-4 border-red-500 text-red-700 dark:text-red-400': type === 'error',
        'bg-white dark:bg-gray-800 border-l-4 border-yellow-500 text-yellow-700 dark:text-yellow-400': type === 'warning',
        'bg-white dark:bg-gray-800 border-l-4 border-blue-500 text-blue-700 dark:text-blue-400': type === 'info'
    }" class="shadow-lg rounded-r-lg p-4 flex items-center justify-between" role="alert">
        <div class="flex items-center">
            <div x-show="type === 'success'" class="mr-3">
                <svg class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div x-show="type === 'error'" class="mr-3">
                <svg class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div x-show="type === 'warning'" class="mr-3">
                <svg class="h-6 w-6 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
             <div x-show="type === 'info'" class="mr-3">
                <svg class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <p class="font-bold" x-text="type === 'success' ? 'Éxito' : (type === 'error' ? 'Error' : (type === 'warning' ? 'Advertencia' : 'Información'))"></p>
                <p class="text-sm" x-text="message"></p>
            </div>
        </div>
        <button @click="show = false" class="ml-4 text-gray-400 hover:text-gray-900 dark:hover:text-white transition ease-in-out duration-150">
            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </button>
    </div>
</div>
