<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\Web\Page;

class PageController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        // Page                                
        $data['page'] = Page::where('slug', $slug)
                            ->where('status', '1')
                            ->firstOrFail();

        return view('web.page', $data);
    }
}
