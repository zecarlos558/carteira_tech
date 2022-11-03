<div {{ $attributes->merge(['class' => '']) }}>
    @auth
    <div class="nav-item  dropstart text-end">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
            <img src="/img/img_avatar1.png" alt="avatar" style="width:30px;" class="rounded-pill">
            <div class="w-100"></div>
            {{formataNomeMenu(auth()->user()->name)}}
        </a>

        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="{{ route('dashboard') }}"><ion-icon name="person"></ion-icon> Meu Painel </a></li>
          <li><form action="{{ route('logout') }}" method="POST">
            @csrf
            <a
            href="{{ route('logout') }}"
            class="dropdown-item"
            onclick="event.preventDefault();this.closest('form').submit();"><ion-icon name="log-out"></ion-icon> Logout </a>
        </form></li>
        </ul>
    </div>
    @endauth
    @guest
    <li class="nav-item dropdown dropstart text-end">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
            <img src="../img/img_avatar1.png" alt="avatar" style="width:40px;" class="rounded-pill">
        </a>
        <ul class="dropdown-menu">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}"><ion-icon name="person"></ion-icon> Sign Up </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}"><ion-icon name="log-in"></ion-icon> Login </a>
            </li>
        </ul>
    </li>
    @endguest
</div>
