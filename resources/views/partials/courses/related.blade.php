<div class="col-12 pt-0 mt-4">
    <h2 class="text-muted">
        {{__("Cursos Relacionados")}}
    </h2>
    <hr/>
</div>
<div class="container-fluid">
    <div class="row">
        @forelse($related as $relatedCourse)
            <div class="col-lg-6 listing-block">
                <div class="media">
                    <div class="fav-box">
                        <i class="fa fa-heart-o"></i>
                    </div>
                    <a href="{{route('courses.detail', $relatedCourse->slug)}}">
                        <img src="/images/courses/{{$relatedCourse->picture}}"
                         class="d-flex align-self-start" alt="{{$relatedCourse->name}}">
                    </a>
                    <div class="medi-body pl-3">
                        <div class="price">
                            <small>{{$relatedCourse->name}}</small>
                        </div>
                        <div class="stats">
                            @include('partials.courses.rating', ['course' => $relatedCourse])
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-dark">
                {{__("No existe ningún curso relacionado")}}
            </div>
        @endforelse
    </div>
</div>
