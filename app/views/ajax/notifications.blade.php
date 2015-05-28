<div  class="notifications">
    <ul>
    @forelse($notifications as $notification)
        <li class="{{ $notification->is_read ? 'read' : 'unread' }}">
            <a href="{{ $notification->url }}">
                {{ $notification->message }}
            </a>
            <br>
            <small>
                {{ $notification->created_at }}
            </small>
        </li>
    @empty
        <li>No news notification</li>
    @endforelse
    </ul>
</div>