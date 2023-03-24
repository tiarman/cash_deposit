<x-mail::message>
# Withdraw Notification
    # Mobile Number: {{ $mailData->withdraw_id }}
    # Transaction Type: {{ $mailData->transaction_type }}
    # Amount: {{ $mailData->amount }} TK

    # Time: {{ $mailData->created_at->format('h:i A') }}
    # Date: {{ $mailData->created_at->format('F d, Y') }}

<!--The body of your message.-->
<!---->
<!--<x-mail::button :url="''">-->
<!--Button Text-->
<!--</x-mail::button>-->

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
