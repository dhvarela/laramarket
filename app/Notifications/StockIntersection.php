<?php

namespace App\Notifications;

use App\Stock;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class StockIntersection extends Notification
{
    use Queueable;

    protected $stock;
    protected $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($stock, $message)
    {
        $this->stock = $stock;
        $this->message = $message;
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
        $stock_info = Stock::find($this->stock->stock_id);

        $message = 'There is an event in a stock you are following: '.
            $stock_info->name . ' ('. $stock_info->acronym .')' .
            $this->message;

        return (new MailMessage)
                    ->line($message)
                    ->action('Check it', url('/stock_historical'.$this->stock->stock_id))
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
