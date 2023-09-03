        <li class="nav-item dropdown">
          <a class="nav-link " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
      <i class="fa-solid fa-bell"></i>{{ __('Notifications') }}
       @unless($unreadNotificationsNumber==0)
            <span class="badge bg-info">{{ $unreadNotificationsNumber }}</span>
       @endunless

          </a>
          <ul class="dropdown-menu">
            @foreach ($notifications as $notification)

            <li><a  @class(['dropdown-item', 'bg-secondary text-light' => $notification->unread()])  href="{{  $notification->data['link']."?nid=$notification->id"}}"> {{ $notification->data['body'] }} </a></li>
            @endforeach
  <div></div>
          </ul>
        </li>
