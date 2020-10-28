<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\NguoiBaoHo;

class SendMailForNguoiBaoHo extends Notification
{
    use Queueable;
    protected $nguoibaoho;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(NguoiBaoHo $nguoibaoho)
    {
        $this->nguoibaoho = $nguoibaoho;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = route('login.nguoibaoho');

        return (new MailMessage)
                    ->line('Tải khoản đăng nhập vào hệ thống Aquila cho người bảo hộ')
                    ->line('User account : ' . $this->nguoibaoho->so_dien_thoai)
                    ->line('Password account : ' . $this->nguoibaoho->password)
                    ->action('Login', url($url))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
