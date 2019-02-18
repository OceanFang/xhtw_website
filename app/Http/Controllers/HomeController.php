<?php

namespace App\Http\Controllers;

use App\Services\BulletinService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     */

    public function __construct(BulletinService $bulletin)
    {
        $this->bulletin = $bulletin;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $type_arr = $this->bulletin->getBulletinType();

        foreach ($type_arr as $k => $val) {
            $type_list[$val->id] = $val->short;
            $list[] = $this->bulletin->getBulletin(['type_id' => $val->id]);
        }

        return view('home', compact('type_list', 'list'));
    }

}
