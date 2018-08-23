<div class="row mb-4">
    <div class="col-lg-12">
        <div class="card" style="background-image: url('{{url('/images/jumbotron.png')}}')">
            <div class="text-white text-center d-flex align-items-center py-5 px-4 my-5">
                <div class="col-5">
                    <img src="{{ $course->pathAttachment() }}" alt="" class="img-fluid" style="width:100%; max-width:400px; height:280px;" />
                </div>

                <div class="col-5 text-left">
                    <h1>{{ _("Curso") }}: {{$course->name}}</h1>
                    <h4>{{ _("Profesor") }}: {{$course->teacher->user->name}}</h4>
                    <h5>{{ _("Categoria") }}: {{$course->category->name}}</h5>
                    <h5>{{ _("Fecha de publicación") }}: {{$course->created_at->format('d/m/Y')}}</h5>
                    <h5>{{ _("Fecha de actualización") }}: {{$course->updated_at->format('d/m/Y')}}</h5>
                    <h6>{{ _("Estudiantes inscritos") }}: {{$course->students_count}}</h6>
                    <h6>{{ _("Número de valoraciones") }}: {{$course->reviews_count}}</h6>
                    @include('partials.courses.rating')
                </div>
            </div>
        </div>

    </div>
</div>
