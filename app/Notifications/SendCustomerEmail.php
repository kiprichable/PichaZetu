<?php

namespace App\Notifications;

use App\Models\Album;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SendCustomerEmail extends Notification implements ShouldQueue
{
    use Queueable;
	
	protected $token;
	
	/**
	 * Create a new notification instance.
	 *
	 * SendActivationEmail constructor.
	 *
	 * @param $token
	 */
    public function __construct($token)
    {
		$this->token = $token;
		$this->onQueue('social');
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
	 * @param $notifiable
	 * @return $this
	 */
    public function toMail($notifiable)
    {
    	$User = User::find(Album::where('customer_id',$notifiable['id'])->first()['user_id']);
    	
        return (new MailMessage)
					->subject('Photos')
                    ->line('Thank you for using '.$User->name.' s photography. Your pictures are ready for viewing.')
                    ->line('A view account has been created for you to login. Please user this email and password to login')
					->line('Email ; '.$notifiable->email)
					->line('Password ; '.$notifiable->name)
                    ->action('View Pictures', url('/albums'))
                    ->line('If you have any questions please let me know on '. $User->email. '!');
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
