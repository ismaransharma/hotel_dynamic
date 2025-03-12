<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}

                    <br />
                </div>
            </div>
        </div>
    </div>

    <!-- Proper button with a link inside -->
    <div class="flex justify-center mt-6">
        <a href="{{ route('getAdminHome') }}">
            <button style="background-color: #252525;
                color: #fff;
                margin: 0 5em;
                height: 2em;
                width: 13em;
                border-radius: 0.5em;">
                Go To Admin Dashboard
            </button>
        </a>
    </div>
</x-app-layout>
