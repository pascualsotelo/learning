<div class="card card-01">
    <span class="badge badge-danger badge-cat">{{$course->category->name}}</span>
    <img src="{{$course->pathAttachment()}}"
        class="card-image-top" alt="{{$course->name}}">
    <div class="card-body">
        <span class="badge-box">
            <i class="fa fa-check"></i>
        </span>
        <h5 class="card-title">{{$course->name}}</h5>
        <hr/>
        <div class="row justify-content-center">
            {{-- Añadir parcial para mostrar el rating --}}
            @include('partials.courses.rating')
        </div>
        {{--Elegir la opcion para terminar la descripcion--}}
         {{-- <p class="card-text">{{str_limit($course->description, 100, 'leer más' ) }}</p>  --}}
        <div class="card-foot">
            <p class="card-text">{{str_limit($course->description, 50)}}</p>
            <a href="#" class="btn btn-course btn-block">{{ __("Más Información") }}</a>
        </div>
    </div>
</div>
