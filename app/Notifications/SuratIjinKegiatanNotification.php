<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SuratIjinKegiatanNotification extends Notification
{
    use Queueable;

    public $data;
    public $pdf;
    /**
     * Create a new notification instance.
     */
    public function __construct($data, $pdf)
    {
        $this->data = $data;
        $this->pdf = $pdf;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Surat Ijin Kegiatan')
            ->greeting('Hi... ' . $this->data->user->name)
            ->line('Berikut adalah surat ijin kegiatan Anda:')
            ->attach($this->pdf)
            ->line('Terima kasih...')
            ->salutation('Salam, Desa Cepogo');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
