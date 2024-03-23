<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Web\WebEvent;
use App\Models\Language;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Events
        $data['events'] = WebEvent::where('language_id', Language::version()->id)
                            ->where('status', '1')
                            ->orderBy('date', 'desc')
                            ->paginate(6);

        return view('web.event', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $slug)
    {
        // Event                                
        $data['event'] = WebEvent::where('id', $id)
                            ->where('status', '1')
                            ->firstOrFail();

        return view('web.event-single', $data);
    }
}
