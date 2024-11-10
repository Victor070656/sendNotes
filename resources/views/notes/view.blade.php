<x-guest-layout>

    <div class="py-5">
        <div class="p-2 text-gray-900 dark:text-gray-100">
            <div class="flex justify-between">
                <h2 class="text-xl font-semibold leading-tight">
                    {{ $note->title }}
                </h2>
            </div>
            <p class="mt-2 text-sm">
                {{ $note->body }}
            </p>
            <div class="flex items-end justify-end space-x-2 mt-5">
                <p class="text-xs">
                    Sent from: {{ $user->name }}
                </p>
                <livewire:notes.heartreact :note="$note" />
            </div>
        </div>
    </div>
</x-guest-layout>
