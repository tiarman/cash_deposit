<x-mail::message>
    # Payment Deposit Notification.


    # Mobile Number: {{ $mailData->payment_no }}
    # Transaction Type: {{ $mailData->transaction_type }}
    # Amount: {{ $mailData->amount }} TK

    # Time: {{ $mailData->created_at->format('h:i A') }}
    # Date: {{ $mailData->created_at->format('F d, Y') }}

<!--<x-mail::button :url="''">-->
<!--Button Text-->
<!--</x-mail::button>-->

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
