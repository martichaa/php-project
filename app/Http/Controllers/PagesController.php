<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;

class PagesController extends Controller
{
    public function index() {
        return view('pages.index');
    }

    public function about() {
        return view('pages.about');
    }

    public function teachers() {
        $courses = Course::distinct()->get(['teacher']);
        return view('pages.teachers')->with('courses', $courses);
    }

    public function organizations() {
        $courses = Course::distinct()->get(['organization']);
        return view('pages.organizations')->with('courses', $courses);
    }
    public function locations() {
        $courses = Course::distinct()->get(['location']);
        return view('pages.locations')->with('courses', $courses);
    }
}
