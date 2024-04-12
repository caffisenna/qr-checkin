<li class="nav-item">
    <a href="{{ route('events.index') }}" class="nav-link {{ Request::is('events*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>イベント</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('participants.index') }}" class="nav-link {{ Request::is('participants*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>参加者</p>
    </a>
</li>
