<?php

namespace App\Services;

use App\Models\Invoice;
use App\Models\InvoicedDocuments;
use App\Models\InvoiceItem;
use App\Models\PaymentRequest;
use Fabian\Pesapal\Facades\Pesapal;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class PesapalService
{
    public function customerTransaction(
        $amount,
        $description,
        $firstName,
        $lastName,
        $email,
        $phoneNumber,
        $reference,
        $callbackUrl, $user = null,
    ) {
        $details = [
            'amount' => $amount,
            'description' => $description,
            'type' => 'MERCHANT',
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => '',
            'phonenumber' => $phoneNumber,
            'reference' => $reference,
            'callback_url' => $callbackUrl,
            'success_url' => $callbackUrl,
            'currency' => 'KES',
        ];

        //        if ($user) {
        //            $this->createPaymentRequest($user, $amount, $reference);
        //        }

        return Pesapal::makePayment($details);
    }

    //    protected function createPaymentRequest($user, $amount, $reference)
    //    {
    //        if (Invoice::where('id', $reference)->first()) {
    //            $invoice = Invoice::where('id', $reference)->first();
    //        } else {
    //            $invoice = $this->createInvoice();
    //        }
    //
    //        $this->createInvoiceItem($invoice);
    //
    //        PaymentRequest::updateOrCreate([
    //            'invoice_id' => $invoice->id,
    //            'user_id' => $user->id,
    //            'phone' => $user->phone,
    //            'ip_address' => $_SERVER['REMOTE_ADDR'],
    //            'merchant_request_id' => 1,
    //            'checkout_request_id' => $reference,
    //            'customer_message' => 'Waiting user to pay',
    //            'amount' => $amount,
    //        ]);
    //    }

    //    protected function createInvoice()
    //    {
    //        $invoice = new Invoice();
    //        $invoice->invoice_date = now();
    //        $invoice->due_date = now();
    //        $invoice->user_id = 1;
    //        $invoice->total_amount = 1;
    //        $invoice->tax_type = 'percent';
    //        $invoice->tax_amount = 0;
    //        $invoice->tax_value = 16;
    //        $invoice->notes = '';
    //        $invoice->status = 'pending';
    //        $invoice->created_by = 1;
    //        $invoice->updated_by = 1;
    //        $invoice->save();
    //
    //        return $invoice;
    //    }
    //
    //    protected function createInvoiceItem(Invoice $invoice)
    //    {
    //        $invoiceItem = new InvoiceItem();
    //        $invoiceItem->invoice_id = $invoice->id;
    //        $invoiceItem->title = 'Test Item';
    //        $invoiceItem->unit_cost = 1;
    //        $invoiceItem->quantity = 1;
    //        $invoiceItem->amount = 1;
    //        $invoiceItem->save();
    //
    //        return $invoiceItem;
    //    }

    public function getToken()
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->post('https://pay.pesapal.com/v3/api/Auth/RequestToken', [
            'consumer_key' => config('pesapal.consumer_key', env('PESAPAL_CONSUMER_KEY')),
            'consumer_secret' => config('pesapal.consumer_secret', env('PESAPAL_CONSUMER_SECRET')),
        ]);

        if ($response->failed()) {
            return null;
        }

        if (! isset($response->json()['token'])) {
            return null;
        }

        return $response->json()['token'];
    }

    //    public function documentPayment(Model|Authenticatable $user, $cart, $amount)
    //    {
    //        $invoice = $this->createDocumentsInvoice($user, $cart, $amount);
    //        $reference = \Str::random(15);
    //
    //        $details = array(
    //            'amount' => $amount,
    //            'description' => 'Invoice number: CM/' . $invoice->id,
    //            'type' => 'MERCHANT',
    //            'first_name' => $user->name,
    //            'last_name' => $user->name,
    //            'email' => '',
    //            'phonenumber' => $user->phone,
    //            'reference' => $reference,
    //            'callback_url' => route('pesapal.callback'),
    //            'success_url' => route('pesapal.callback'),
    //        );
    //        $this->createDocumentPaymentRequest($user, $invoice, $reference);
    //
    //        // return two variables, one for iframe and one for invoice
    //        return [
    //            'iframe' => Pesapal::makePayment($details),
    //            'invoice' => $invoice,
    //        ];
    //    }

    //    protected function createDocumentsInvoice($user, $cart, $amount): Invoice
    //    {
    //        $invoicedDocuments = InvoicedDocuments::where('user_id', $user->id)
    //            ->where('cart', $cart)
    //            ->first();
    //
    //        if ($invoicedDocuments) {
    //            return Invoice::where('id', $invoicedDocuments->invoice_id)->first();
    //        }
    //
    //        $invoice = new Invoice();
    //        $invoice->invoice_date = now();
    //        $invoice->due_date = now();
    //        $invoice->user_id = $user->id;
    //        $invoice->total_amount = $amount;
    //        $invoice->tax_type = 'percent';
    //        $invoice->tax_amount = 0;
    //        $invoice->tax_value = 16;
    //        $invoice->notes = '';
    //        $invoice->status = 'pending';
    //        $invoice->created_by = $user->id;
    //        $invoice->updated_by = $user->id;
    //        $invoice->save();
    //
    //        $invoicedDocuments = new InvoicedDocuments();
    //        $invoicedDocuments->user_id = $user->id;
    //        $invoicedDocuments->invoice_id = $invoice->id;
    //        $invoicedDocuments->cart = $cart;
    //        $invoicedDocuments->save();
    //
    //        foreach ($cart as $item) {
    //            $invoiceItem = new InvoiceItem();
    //            $invoiceItem->invoice_id = $invoice->id;
    //            $invoiceItem->title = $item['name'];
    //            $invoiceItem->unit_cost = $item['price'];
    //            $invoiceItem->quantity = 1;
    //            $invoiceItem->amount = $item['price'];
    //            $invoiceItem->save();
    //        }
    //
    //        return $invoice;
    //    }
    //
    //    protected function createDocumentPaymentRequest($user, $invoice, $reference): PaymentRequest
    //    {
    //        $paymentRequest = new PaymentRequest();
    //        $paymentRequest->invoice_id = $invoice->id;
    //        $paymentRequest->user_id = $user->id;
    //        $paymentRequest->phone = $user->phone;
    //        $paymentRequest->ip_address = $_SERVER['REMOTE_ADDR'];
    //        $paymentRequest->merchant_request_id = 1;
    //        $paymentRequest->checkout_request_id = $reference;
    //        $paymentRequest->customer_message = 'Waiting user to pay';
    //        $paymentRequest->amount = $invoice->total_amount;
    //        $paymentRequest->save();
    //
    //        return $paymentRequest;
    //    }
}
