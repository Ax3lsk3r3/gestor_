@if($notifications->count() > 0)
    @foreach($notifications as $notification)
    <li style="padding: 5px; {{ $notification->is_read ? '' : 'background: #ddd;' }}">
        <a href="{{ route('notifications.read', $notification->id) }}" style="display: block;">
            <strong>{{ $notification->type }}</strong><br>
            {{ Str::limit($notification->message, 50) }}<br>
            <small>{{ $notification->date->format('Y-m-d') }}</small>
        </a>
    </li>
    @endforeach
@else
    <li style="padding: 10px; text-align: center;">No notifications</li>
@endif



