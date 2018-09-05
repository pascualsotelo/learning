<li><a class="nav-link" href="{{route('admin.courses')}}">{{ __("cursos") }}</a></li>
<li><a class="nav-link" href="#">{{ __("estudiantes") }}</a></li>
<li><a class="nav-link" href="#">{{ __("profesores") }}</a></li>
<li class="nav-item dropdown">
    <a id="navbarDropdown"
       class="nav-link dropdown-toggle"
       href="#" role="button"
       data-toggle="dropdown"
       aria-haspopup="true"
       aria-expanded="false"
    >
        {{ auth()->user()->name }} <span class="caret"></span>
    </a>

    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="{{ route('logout') }}"
           onclick="event.preventDefault();
           document.getElementById('logout-form').submit();"
        >
            {{ __("Out") }}
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</li>
