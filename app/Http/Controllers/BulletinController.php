<?php

namespace App\Http\Controllers;

use App\Services\BulletinService;
use Illuminate\Http\Request;

class BulletinController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(BulletinService $bulletin)
    {
        // $this->user_info = user_info();
        $this->bulletin = $bulletin;
        $this->footerType = '';
    }

    public function index(Request $request)
    {
        return $this->list($request);
    }

    /**
     * 取得公告類別
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    function list(Request $request, $id = 1) {

        $type_list = $this->bulletin->getBulletinType();
        $list = $this->bulletin->getBulletinList(['type_id' => $id]);

        $page = is_null($request->page) ? '1' : $request->page;

        return view('bulletin.list', compact('type_list', 'list', 'id', 'page'));
    }

    /**
     * 取得公告內容
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function info(Request $request, $id)
    {

        $type_list = $this->bulletin->getBulletinType();
        $info = $this->bulletin->getBulletinInfo($id);

        if (!$info):

            return redirect('bulletin');
        else:

            $res = $this->bulletin->getBulletinPrevNext($id, $info->type_id, $info->sort);
            $prev = $res->prev;
            $next = $res->next;

            return view('bulletin.info', compact('type_list', 'info', 'prev', 'next'));
        endif;
    }

}
