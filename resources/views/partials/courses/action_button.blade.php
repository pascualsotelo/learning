<div class="col-2">
    @auth
        @can('opt_for_course', $course)
            @can('subscribe', \App\Course::class)
                <a href="#" class="btn btn-course btn-block">
                    <i class="fa fa-bolt"></i> {{ __("Subscribirme") }}
                </a>
            @else
                @can('inscribe', $course)
                    <a href="#" class="btn btn-course btn-block">
                        <i class="fa fa-bolt"></i> {{ __("Inscribirme") }}
                    </a>
                @else
                    <a href="#" class="btn btn-course btn-block">
                        <i class="fa fa-bolt"></i> {{ __("Inscrito") }}
                    </a>
                @endcan
            @endcan
        @else
            <a href="#" class="btn btn-course btn-block">
                <i class="fa fa-user"></i> {{ __("Soy autor") }}
            </a>
        @endcan
    @else
        <a href="{{route('login')}}" class="btn btn-course btn-block">
            <i class="fa fa-user"></i> {{ __("Acceder") }}
        </a>
    @endauth
</div>
