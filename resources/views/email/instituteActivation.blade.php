<x-mail::message>
# Dear Mr./Ms. {{ $principal }},
  Your account for {{ $institute }} ({{$code}}) has been successfully activated.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
