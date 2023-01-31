<x-mail::message>
  # Dear Mr./Ms. {{ $principal }},
  Your EAF for RPL has been successfully submitted. Please submit required number of hard-copies to project office by the mentioned last time in the notice.
  <br>
  Thanks for showing your interest for RPL.
  <x-mail::button :url="$url">
    Download
  </x-mail::button>

  With Best Regards,,<br>
  {{ config('app.name') }}
</x-mail::message>
