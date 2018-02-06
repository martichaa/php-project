<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Course;

class CoursesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search = \Request::get('search'); //<-- we use global request to get the param of URI
 
        $courses = Course::orWhere('CourseName','like','%'.$search.'%')
            ->orWhere('date','like','%'.$search.'%')
            ->orWhere('teacher','like','%'.$search.'%')
            ->orWhere('organization','like','%'.$search.'%')
            ->paginate(20);

    return view('pages.show',compact('courses'));
        
        $courses = Course::orderBy('created_at','desc')->paginate(10);
        return view('pages.show')->with('courses', $courses);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'CourseName' => 'required',
            'date' => 'required',
            'duration' => 'required',
            'teacher' => 'required',
            'organization' => 'required',
            'location' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);

            if($request->hasFile('cover_image')) {
                $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('cover_image')->getClientOriginalExtension();
                $filenameToStore = $filename.'_'.time().'.'.$extension;
                $path = $request->file('cover_image')->storeAs('public/cover_images', $filenameToStore);
            } else {
                $fileNameToStore = 'noImage.jpg';
            }

            // Create Course
        $course = new Course;
        $course->CourseName = $request->input('CourseName');
        $course->date = $request->input('date');
        $course->duration = $request->input('duration');
        $course->teacher = $request->input('teacher');
        $course->organization = $request->input('organization');
        $course->location = $request->input('location');
        $course->user_id = auth()->user()->id;
        $course->cover_image = $fileNameToStore;
        $course->save();

        return redirect('/courses')->with('success', 'Course submitted Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course = Course::find($id);
        if(auth()->user()->id !== $course->user_id) {
            return redirect('/courses')->with('error', 'Unauthorized Page');
        }
        return view('pages.edit')->with('course', $course);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'CourseName' => 'required',
            'date' => 'required',
            'duration' => 'required',
            'teacher' => 'required',
            'organization' => 'required',
            'location' => 'required'
            
        ]);

        if($request->hasFile('cover_image')) {
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            $filenameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('cover_image')->storeAs('public/cover_images', $filenameToStore);
        }

            // Edit Course
        $course = Course::find($id);
        $course->CourseName = $request->input('CourseName');
        $course->date = $request->input('date');
        $course->duration = $request->input('duration');
        $course->teacher = $request->input('teacher');
        $course->organization = $request->input('organization');
        $course->location = $request->input('location');
        if($request->hasFile('cover_image')) {
            $course->cover_image = $filenameToStore;
        }
        $course->save();

        return redirect('/courses')->with('success', 'Course Edited!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::find($id);

        if(auth()->user()->id !== $course->user_id) {
            return redirect('/courses')->with('error', 'Unauthorized Page');
        }

        if($course->cover_image != 'noimage.jpg') {
            Storage::delete('public/cover_images/' . $course->cover_image);
        }

        $course->delete();

        return redirect('/courses')->with('success', 'Course Deleted!');        
    }
}
