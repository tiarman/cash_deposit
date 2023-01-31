<x-mail::message>
# Dear Mr./Ms. {{ $principal }},
  Your account for {{ $institute }} ({{$code}}) has been deactivated.
  If needed, please contact with project.
Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
