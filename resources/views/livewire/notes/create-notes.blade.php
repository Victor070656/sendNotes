<?php

use Livewire\Volt\Component;

new class extends Component {
    public $noteTitle;
    public $noteBody;
    public $noteRecipient;
    public $noteSendDate;

    public function submit()
    {
        $validate = $this->validate([
            'noteTitle' => ['required', 'string', 'min:5'],
            'noteBody' => ['required', 'string', 'min:20'],
            'noteRecipient' => ['required', 'email'],
            'noteSendDate' => ['required', 'date'],
        ]);
        auth()
            ->user()
            ->notes()
            ->create([
                'title' => $this->noteTitle,
                'body' => $this->noteBody,
                'recipient' => $this->noteRecipient,
                'send_date' => $this->noteSendDate,
                'is_published' => true,
            ]);

        redirect(route('notes.index'));
    }
};
?>

<div>
    <x-button secondary icon="arrow-left" class="mb-8" href="{{ route('notes.index') }}" wire:navigate>All
        Notes</x-button>
    <form wire:submit='submit' class="space-y-4">
        <x-input icon="tag" wire:model='noteTitle' label="Note Title" placeholder="Enter your title" />
        <x-textarea wire:model='noteBody' label="Your Note" placeholder="Enter your Note" />
        <x-input icon="user" wire:model='noteRecipient' label="Recipient" placeholder="yourfriend@email.com"
            type="email" />
        <x-input icon="calendar" wire:model='noteSendDate' type="date" label="Send Date" />
        <x-button type='submit' primary right-icon="calendar" spinner>Schedule Note</x-button>
        <x-error />
    </form>
</div>
