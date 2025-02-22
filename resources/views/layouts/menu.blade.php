<header class="header">
    <div class="menu">

        <div class="logo">
            <!--Logo-->
            <a href="{{ route('home.index') }}"><img src="{{ asset('img/logo.png')}}" alt="Logo"></a>
        </div>

        @guest
        <ul class="d-flex">
            <li class="me-2"><a href="{{ route('login') }}" class="login">Acceder</a></li>
            <li><a href="{{ route('register') }}" class="create">Crear cuenta</a></li>
        </ul>

        @else
        <div class="dropdown">
            <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" 
               data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true">

               <img src="{{ Auth::check() ? Auth::user()->getProfilePhoto() : asset('img/user-default.png') }}" class="img-author">
          
                <span class="name-user">{{ Auth::user()->name }}</span>
            </a>

            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <li><a class="dropdown-item"
                        href="{{ route('profiles.edit', ['profile' => Auth::user()->id]) }}">Perfil</a></li>
                @can('admin.index')
                <li><a class="dropdown-item" href="{{ route('admin.index') }}">Ir al admin</a></li>
                @endcan
                <li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                    </form>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); 
                           document.getElementById('logout-form').submit();">Salir</a>
                </li>
            </ul>
        </div>
        @endguest
    </div>

</header>