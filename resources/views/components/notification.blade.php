<li class="list-inline-item dropdown notification-list notificationList">
  <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button"
     aria-haspopup="false" aria-expanded="false">
    <i class="ion-ios7-bell noti-icon"></i>
    <span class="badge badge-danger noti-icon-badge unread-notification">{{ $unReadNotification }}</span>
  </a>
  <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-menu-lg" style="max-height: 450px;overflow-y: auto">
    <!-- item-->
    <div class="dropdown-item noti-title">
      <h5>Notification ({{ $notifications->count() }})</h5>
    </div>
    @foreach($notifications as $notification)
      <a href="javascript:void(0);" class="dropdown-item notify-item @if($notification->is_read) active @endif notificationItems"
         data-url="{{ route('admin.ajax.make.modal.as.read', $notification->id) }}"
         data-title="{{ $notification->title }}"
         data-message="{{ $notification->message }}">
        @if($notification->type == \App\Models\Notification::$types[0])
          <div class="notify-icon bg-success">
            <i class="mdi mdi-note"></i>
          </div>
        @elseif($notification->type == \App\Models\Notification::$types[1])
          <div class="notify-icon bg-warning">
            <i class="mdi mdi-account-alert"></i>
          </div>
        @else
          <div class="notify-icon bg-indigo-400">
            <i class="mdi mdi-information"></i>
          </div>
        @endif
        <p class="notify-details">
          <b title="{{ $notification->title }}">{{ $notification->title }}</b>
          <small class="text-muted" title="{{ $notification->message }}">{{ Str::limit($notification->message, 50) }}</small>
        </p>
      </a>
    @endforeach

    <!-- All-->
    <a href="javascript:void(0);" class="dropdown-item notify-item">
      View All
    </a>
  </div>
</li>

