@php
    $customer = Auth::user();
@endphp
<ul class="navbar-nav ">
    <li class="nav-item text-nowrap">
        @guest
            <a class="btn btn-outline-primary" href="{{ route('login') }}">Sign in</a>
        @else
            <img class="rounded" src="{{$customer->avatar}}" alt="$customer->name" width="50px" height="50px">
            <div class="btn-group">
                <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                    {{ $customer->name }}
                </button>
                <div class="dropdown-menu dropdown-menu-right">

                    <a class="dropdown-item" href="{{ route('cabinet.main.index') }}">
                        Cabinet
                    </a>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>

                </div>
            </div>
        @endguest
    </li>
</ul>