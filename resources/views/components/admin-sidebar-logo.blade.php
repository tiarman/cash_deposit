<img style="background: whitesmoke;display: unset;height: 60px"
     src="{{ $c_logo ? asset($c_logo) : auth()->user()->profile_photo_url }}"
     height="100"
     alt="logo">
