<?php

use Livewire\Volt\Component;
use App\Models\Note;

new class extends Component {
    public function delete($noteId)
    {
        $note = Note::find($noteId);
        $this->authorize("delete", $note);
        $note->delete();
    }
    public function with(): array
    {
        return [
            'notes' => Auth::user()->notes()->orderBy('send_date', 'asc')->get(),
        ];
    }
};
?>

<div>
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-semibold">{{ 'Show Notes' }}</h2>
        <x-button primary icon="plus" href="{{ route('notes.create') }}" wire:navigate>Create Note</x-button>
    </div>
    <div class="space-y-3 mt-6">
        <div class="grid md:grid-cols-3 gap-4">
            @forelse ($notes as $note)
                <x-card wire:key='{{ $note->id }}'>
                    <div class="flex justify-between items-center">
                        <a href="#"
                            class="text-xl hover:underline hover:text-blue-700 font-semibold">{{ $note->title }}</a>
                        <span class="text-xs">{{ Carbon\Carbon::parse($note->send_date)->format('M d, Y') }}</span>
                    </div>
                    <div class="">
                        <span class="text-[14px]">{{ Str::limit($note->body, 50) }}</span>
                    </div>
                    <div class="flex justify-between items-end">
                        <p class="text-xs">Recipient: <span class="font-semibold">{{ $note->recipient }}</span></p>
                        <div class="">
                            <x-button secondary xs icon="eye" class="rounded-full"></x-button>
                            <x-button secondary xs icon="trash" class="rounded-full"
                                wire:click="delete('{{ $note->id }}')"></x-button>
                        </div>
                    </div>
                </x-card>
            @empty
                <x-card>
                    <p class="text-red-500 text-sm">No Notes</p>
                </x-card>
            @endforelse
        </div>
    </div>

</div>
