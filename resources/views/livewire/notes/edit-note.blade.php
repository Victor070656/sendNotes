<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\Note;

new #[Layout('layouts.app')] class extends Component {
    public Note $note;
    public $noteTitle;
    public $noteBody;
    public $noteRecipient;
    public $noteSendDate;
    public $noteIsPublished;

    public function submit()
    {
        $validate = $this->validate([
            'noteTitle' => ['required', 'string', 'min:5'],
            'noteBody' => ['required', 'string', 'min:20'],
            'noteRecipient' => ['required', 'email'],
            'noteSendDate' => ['required', 'date'],
        ]);
        $this->note->update([
            'title' => $this->noteTitle,
            'body' => $this->noteBody,
            'recipient' => $this->noteRecipient,
            'send_date' => $this->noteSendDate,
            'is_published' => $this->noteIsPublished,
        ]);

        redirect(route('notes.index'));
    }

    public function mount(Note $note)
    {
        $this->authorize('update', $note);
        $this->fill($note);
        $this->noteTitle = $note->title;
        $this->noteBody = $note->body;
        $this->noteRecipient = $note->recipient;
        $this->noteSendDate = $note->send_date;
        $this->noteIsPublished = $note->is_published;

        $this->dispatch('note-saved');
    }
}; ?>

<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-100">
            {{ __('Edit Note') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-3xl sm:px-6 lg:px-8">

            <div class="p-6 text-gray-900 dark:text-gray-100">
                <x-button secondary icon="arrow-left" class="mb-8" href="{{ route('notes.index') }}" wire:navigate>All
                    Notes</x-button>
                <form wire:submit='submit' class="space-y-4">
                    <x-input icon="tag" wire:model='noteTitle' value="{{ $note->title }}" label="Note Title"
                        placeholder="Enter your title" />
                    <x-textarea wire:model='noteBody' label="Your Note"
                        placeholder="Enter your Note">{{ $note->body }}</x-textarea>
                    <x-input icon="user" wire:model='noteRecipient' value="{{ $note->recipient }}" label="Recipient"
                        placeholder="yourfriend@email.com" type="email" />
                    <x-input icon="calendar" wire:model='noteSendDate' value="{{ $note->send_date }}" type="date"
                        label="Send Date" />
                    <x-checkbox label="Note Published" wire:model="noteIsPublished" />
                    <x-button type='submit' primary right-icon="calendar" spinner>Update Schedule</x-button>
                    <x-error />
                    <x-action-message on="note-saved" />
                </form>
            </div>

        </div>
    </div>
</div>
