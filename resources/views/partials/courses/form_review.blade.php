@cannot('inscribe', $course)
    @can('review', $course)
        <div class="col-12 pt-0 mt-4 text-center">
            <h2 class="text-muted">{{ __("Escribe una valoración") }}</h2>
            <hr/>
        </div>
        <div class="container-fluid">
            <form method="POST" action="{{route('courses.add_review')}}" class="form-inline" id="rating_form">
                @csrf
                <div class="form-group">
                    <div class="col-12">
                        <ul id="list_rating" class="list-inline" style="font-size:40px;">
                            <li class="list-inline-item"><i class="fa fa-star yellow"></i></li>
                            <li class="list-inline-item"><i class="fa fa-star"></i></li>
                            <li class="list-inline-item"><i class="fa fa-star"></i></li>
                            <li class="list-inline-item"><i class="fa fa-star"></i></li>
                            <li class="list-inline-item"><i class="fa fa-star"></i></li>
                        </ul>
                    </div>
                </div>

                <br/>
                <input type="hidden" name="rating_input" value="1">
                <input type="hidden" name="course_id" value="{{$course->id}}">

                <div class="form-group">
                    <div class="col-12">
                        <textarea name="message" class="form-control" rows="8" cols="120" id="message" placeholder="{{__("Escribe una reseña")}}"></textarea>
                    </div>
                </div>

                <button type="submit" class="btn btn-outline-danger">
                    <i class="fa fa-space-shuttle"></i> {{ __("Valorar curso") }}
                </button>
            </form>
        </div>
    @endcan
@endcannot

@push('scripts')
    <script>
        jQuery(document).ready(function(){
            const ratingSelector = jQuery('#list_rating');
            ratingSelector.find('li').on('click', function(){
                console.log(this);
            });
        });
    </script>
@endpush