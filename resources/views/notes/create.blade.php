<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-100">
            {{ __('Create A Note') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-3xl sm:px-6 lg:px-8">

            <div class="p-6 text-gray-900 dark:text-gray-100">
                <livewire:notes.create-notes />
            </div>

        </div>
    </div>
</x-app-layout>
