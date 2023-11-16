<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('Edit Car') }}
        </h2>
    </x-slot>

    <div class="flex items-center justify-center mt-4">
        <div class="w-full max-w-md">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('cars.update', $car->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="mt-4">
                            <x-label for="brand" :value="__('Brand')" />
                            <x-input id="brand" class="block mt-1 w-full" type="text" name="brand"
                                value="{{ $car->brand }}" required autofocus />
                        </div>

                        <div class="mt-4">
                            <x-label for="model" :value="__('Model')" />
                            <x-input id="model" class="block mt-1 w-full" type="text" name="model"
                                value="{{ $car->model }}" required />
                        </div>

                        <div class="mt-4">
                            <x-label for="license_plate" :value="__('License Plate')" />
                            <x-input id="license_plate" class="block mt-1 w-full" type="text" name="license_plate"
                                value="{{ $car->license_plate }}" required />
                        </div>

                        <div class="mt-4">
                            <x-label for="rental_rate" :value="__('Rental Rate Per Day')" />
                            <x-input id="rental_rate" class="block mt-1 w-full" type="number" name="rental_rate"
                                value="{{ $car->rental_rate }}" required />
                        </div>

                        <div class="flex items-center justify-center mt-4">
                            <x-primary-button class="bg-blue-500 hover:bg-blue-700">
                                {{ __('Update') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
