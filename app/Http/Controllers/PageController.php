<?php

namespace App\Http\Controllers;

class PageController extends Controller
{   
    /**
     * Display nominee create page
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('pages.create');
    }

    /**
     * Display votes list page
     *
     * @return \Illuminate\View\View
     */
    public function list()
    {
        return view('pages.list');
    }

    /**
     * Display vote page
     *
     * @return \Illuminate\View\View
     */
    public function votes()
    {
        return view('pages.votes');
    }

    /**
     * Display result page
     *
     * @return \Illuminate\View\View
     */
    public function results()
    {
        return view('pages.results');
    }

    /**
     * Display icons page
     *
     * @return \Illuminate\View\View
     */
    public function icons()
    {
        return view('pages.icons');
    }

    /**
     * Display tables page
     *
     * @return \Illuminate\View\View
     */
    public function tables()
    {
        return view('pages.tables');
    }

    /**
     * Display notifications page
     *
     * @return \Illuminate\View\View
     */
    public function notifications()
    {
        return view('pages.notifications');
    }

    /**
     * Display rtl page
     *
     * @return \Illuminate\View\View
     */
    public function rtl()
    {
        return view('pages.rtl');
    }

    /**
     * Display typography page
     *
     * @return \Illuminate\View\View
     */
    public function typography()
    {
        return view('pages.typography');
    }

    /**
     * Display upgrade page
     *
     * @return \Illuminate\View\View
     */
    public function upgrade()
    {
        return view('pages.upgrade');
    }

    /**
     * Display voting page
     *
     * @return \Illuminate\View\View
     */
    public function vote()
    {
        return view('pages.vote');
    }

    

}
