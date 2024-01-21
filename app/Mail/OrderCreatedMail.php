<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderCreatedMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(private Order $order)
    {

    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Order Created',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.order-created',
            with: [
                'fromCurrencyName' => $this->order->fromCurrency->name,
                'toCurrencyName' => $this->order->toCurrency->name,
                'toCurrencyAmount' => $this->order->amount_of_currency_purchased,
                'amountPaid' => $this->order->amount_paid,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
