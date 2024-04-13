<li class="nav-item">
    <a href="{{ route('events.index') }}" class="nav-link {{ Request::is('events*') ? 'active' : '' }}">
        <span uk-icon="icon: list"></span>
        <p>イベント</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('participants.index') }}" class="nav-link {{ Request::is('participants*') ? 'active' : '' }}">
        <span uk-icon="icon: users"></span>
        <p>参加者</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('download') }}" class="nav-link {{ Request::is('download') ? 'active' : '' }}">
        <span uk-icon="icon: download"></span>
        <p>ダウンロード</p>
    </a>
</li>
