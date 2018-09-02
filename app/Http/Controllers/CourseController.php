<?php

namespace App\Http\Controllers;

use App\Course;
use App\Review;
use App\Helpers\Helper;
use App\Mail\NewStudentInCourse;
use App\Http\Requests\CourseRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    public function show(Course $course)
    {
        $course->load([
            'category' => function($q){
                $q->select('id','name');
            },
            'goals'=> function($q){
                $q->select('id','course_id','goal');
            },
            'level' => function ($q) {
                $q->select('id', 'name');
            },
            'requirements'=> function($q){
                $q->select('id','course_id','requirement');
            },
            'reviews.user',
            'teacher'
        ])->get();

        $related = $course->relatedCourses();
        // dd($related);
        return view('courses.detail', compact('course','related'));

    }

    public function inscribe(Course $course){

        $course->students()->attach(auth()->user()->student->id);

        \Mail::to($course->teacher->user)->send(new NewStudentInCourse($course, auth()->user()->name));

        return back()->with('message', ['success', __("Inscrito correctamente al curso")]);
    }

    public function subscribed(){
        $courses = Course::whereHas('students', function($q){
            $q->where('user_id', auth()->id());
        })->get();

        return view('courses.subscribed', compact('courses'));
    }

    public function addReview(){

        Review::create([
            'user_id' => auth()->id(),
            'course_id' => request('course_id'),
            'rating' => (int) request('rating_input'),
            'comment' => request('message')
        ]);

        return back()->with('message', ['success', __("Muchas gracias por valora este curso")]);
    }

    public function create(){
        $course = new Course;
        $btnText = __("Enviar curso para revision");
        return view('courses.form', compact('course', 'btnText'));
    }

    public function store(CourseRequest $course_request)
    {
        $picture = Helper::uploadFile('picture', 'courses');
        $course_request->merge(['picture' => $picture]);
        $course_request->merge(['teacher_id' => auth()->user()->teacher->id]);
        $course_request->merge(['status' => Course::PENDING]);
        Course::create($course_request->input());
        return back()->with('message', ['success', __('Curso enviado correctamente, recibirá un correo con cualquier información')]);
    }

    public function edit ($slug){
        $course = Course::with(['requirements', 'goals'])->withCount(['requirements', 'goals'])
                    ->whereSlug($slug)->first();
        
        $btnText = __("Actualizar curso");
        return view('courses.form', compact('course', 'btnText'));

    }

    public function update(CourseRequest $course_request, Course $course){
        if($course_request->hasFile('picture')){
            \Storage::delete('courses/'. $course->picture);
            $picture = Helper::uploadFile('picture', 'courses');
            $course_request->merge(['picture' => $picture]);
        }

        $course->fill($course_request->input())->save();
        return back()->with('message', ['success', __("Curso Actualizado")]);
    }

    public function destroy(Course $course){
        try{
            $course->delete();
            return back()->with('message', ['success', __("Curso eliminado")]);
        }catch(\Exception $xception){
            return back()->with('message', ['danger', __("Error no se pudo eliminar")]);
        }
    }
}
