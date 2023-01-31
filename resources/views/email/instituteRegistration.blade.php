<x-mail::message>
# Dear Mr./Ms. {{ $principal }},
  Your registration for {{ $institute }} - ({{ $code }}) has been successfully completed.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
