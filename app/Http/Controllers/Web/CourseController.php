<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Web\Course;
use App\Models\Language;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Courses
        $data['courses'] = Course::where('language_id', Language::version()->id)
                            ->where('status', '1')
                            ->orderBy('id', 'asc')
                            ->paginate(6);

        return view('web.course', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        // Course                                
        $data['course'] = Course::where('slug', $slug)
                            ->where('status', '1')
                            ->firstOrFail();

        return view('web.course-single', $data);
    }
}
