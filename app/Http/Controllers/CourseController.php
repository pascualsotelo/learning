<?php

namespace App\Http\Controllers;

use App\Course;
use App\Review;
use App\Mail\NewStudentInCourse;
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
}
