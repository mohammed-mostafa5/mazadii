<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderStatus extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        try {
                return $this->from('info@ellistaa.com')
                ->subject('Ellistaa')
                ->markdown('emails.orderStatus');
                
        } catch (\Throwable $th) {
            // dd('123', $data ?? 'data is empty');
        }
    }
}
