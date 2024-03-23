<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\Web\Faq;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Faqs
        $data['faqs'] = Faq::where('language_id', Language::version()->id)
                            ->where('status', '1')
                            ->orderBy('id', 'asc')
                            ->get();

        return view('web.faq', $data);
    }
}
