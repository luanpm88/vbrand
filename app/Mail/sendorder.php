<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Mail;

class sendorder extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data,$order;
    public function __construct($data, $order)
    {
        $this->data     = $data;
        $this->order    = $order;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //return $this->view('emails.order')->with([ 'data' => $this->data ]);
        $from_address = 'support@xetai.club';
        $subject = 'Đơn đặt hàng của bạn';
        $name = 'Sale Support Online 24/7 ';
        $headerData = [
            'category' => 'category',
            'unique_args' => [
                'variable_1' => 'abc'
            ]
        ];
        $header = $this->asString($headerData);
        $this->withSwiftMessage(function ($message) use ($header) {
            $message->getHeaders()
                    ->addTextHeader('X-SMTPAPI', $header);
        });
        return $this->view('emails.order')
                    ->from($from_address, $name)
                    ->cc($from_address, $name)
                    ->bcc($from_address, $name)
                    ->replyTo($from_address, $name)
                    ->subject($subject)
                    ->with([ 'data' => $this->data, 'order'    => $this->order ]); 
        
    }
    private function asJSON($data)
    {
        $json = json_encode($data);
        $json = preg_replace('/(["\]}])([,:])(["\[{])/', '$1$2 $3', $json);

        return $json;
    }


    private function asString($data)
    {
        $json = $this->asJSON($data);

        return wordwrap($json, 76, "\n   ");
    }

}
