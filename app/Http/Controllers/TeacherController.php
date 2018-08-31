<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\User;
use App\Mail\MessageToStudent;
use Yajra\DataTables\Facades\DataTables;

class TeacherController extends Controller
{
    public function students()
    {
        $students = Student::with('user', 'courses.reviews')
            ->whereHas('courses', function ($q) {
                $q->where('teacher_id', auth()->user()->teacher->id)->select('id', 'teacher_id', 'name')->withTrashed();
            })->get();

        $actions = 'students.datatables.actions';
        return DataTables::of($students)->addColumn('actions', $actions)
                    ->rawColumns(['actions', 'courses_formatted'])->make(true);
    }

    public function sendMessageToStudent()
    {
        $info = \request('info');
        $data = [];
        parse_str($info, $data);
        $user = User::findOrFail($data['user_id']);
        try {
            \Mail::to($user)->send(new MessageToStudent(auth()->user()->name, $data['message']));
            $success = true;
        } catch (\Exception $exception) {
            $success = false;
        }
        return response()->json(['res' => $success]);
    }
}
