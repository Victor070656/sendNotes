<?php

namespace App\Jobs;

use App\Models\Note;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public Note $note)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $noteUrl = config("app.url") . "/notes/" . $this->note->id;
        $emailContent = "Hello, you've received a new note. View it here: {$noteUrl}";

        try {
            Mail::raw($emailContent, function ($message) {
                $message->from("admin@sendnote.co", "SendNotes")
                    ->to($this->note->recipient)
                    ->subject("You've received a note from " . $this->note->user->name);
            });
        } catch (\Exception $e) {
            Log::error("Failed to send email for note ID {$this->note->id}: " . $e->getMessage());
        }
    }
}
