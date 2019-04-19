<?php

namespace App\Http\Controllers;

use App\Services\EventService;
use Exception;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(EventService $event)
    {
        // $this->user_info = user_info();
        $this->event = $event;
    }

    public function index(Request $request)
    {
        // return $this->list($request);
    }

    /**
     *
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function FBPainting(Request $request)
    {

        $type = is_null($request->type) ? 'general' : $request->type;
        $type_id = $this->event->getFBPaintingTypeID($type);

        if (!$type_id):
            return redirect('fan-fiction/190227');
        endif;

        $list = $this->event->getFBPaintingList($type_id);
        // dump($list);

        return view('fb_event.painting', compact('type_id', 'list', 'id', 'request', 'type'));
    }

    /**
     *
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function FBPaintingNotice(Request $request)
    {

        return view('fb_event.notice');
    }

    /**
     *
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function FBPaintingInfo(Request $request, $id)
    {

        $info = $this->event->getFBPaintingInfo($id);

        if (!$info):
            return redirect('fan-fiction/190227');
        endif;

        return view('fb_event.info', compact('info'));

    }

    /**
     *
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function FBPaintingGetVote(Request $request)
    {

        $res = $this->event->getFBPaintingVote($request->id, $request->tid, $request->oid);
        if ($res):
            $id = $res->id;
            $tid = $res->tid;
        else:
            $id = false;
            $tid = false;
        endif;

        return compact('id', 'tid');
    }

    /**
     *
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function FBPaintingVote(Request $request)
    {

        $status = 'fail';

        try {

            if (date('Y-m-d H:i:s') > '2019-03-25 00:00:00'):
                throw new Exception('很抱歉，投票活動已結束，感謝您的參與!');
            endif;

            $chk = $res = $this->event->getFBPaintingInfo($request->id);

            if (!$chk):
                throw new Exception('編號錯誤，請重新操作。');
            endif;

            if ($chk->type_id !== (int) $request->tid):
                throw new Exception('展示區編號錯誤，請重新操作。');
            endif;

            $res = $this->event->getFBPaintingVote(null, $request->tid, $request->oid);

            if ($res):
                throw new Exception('很抱歉，各展示區 【 每日 】 僅可投票一次。');
            endif;

            if (is_null($request->id) || is_null($request->tid) || is_null($request->oid)):
                throw new Exception('系統異常，請重新操作。');
            endif;

            $params = ['painting_id' => $request->id, 'type_id' => $request->tid, 'user_id' => $request->oid];
            $wparams = ['id' => $request->id];
            $res = $this->event->doFBPaintingVote($params, $wparams);
            if ($res):
                $status = 'done';
                $response = '感謝您的支持與愛護，記得 【 明日 】 再回來投我一票哦！';
            endif;

        } catch (Exception $e) {
            $status = 'fail';
            $response = $e->getMessage();
        }

        return compact('status', 'response');
    }
}
