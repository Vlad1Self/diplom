<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PasswordNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
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
        $user = $notifiable; // Получаем объект пользователя
        $username = $user->name; // Получаем имя пользователя

        return (new MailMessage)
            ->subject('Изменить пароль')
            ->greeting("Здравствуйте, {$username}!") // Добавляем обращение по имени
            ->line('Вы отправили заявку на смену пароля. Пожалуйста, перейдите по ссылке ниже: ')
            ->action('Изменить пароль', url('/password-change'))
            ->line('Если вы не отправляли заявку на смену пароля, проигнорируйте это письмо.');
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
