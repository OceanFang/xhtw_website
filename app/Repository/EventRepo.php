<?php

namespace App\Repository;

use App\EventFbPainting;
use App\EventFbPaintingLog;
use App\EventFbPaintingType;

class EventRepo
{
    public function __construct(EventFbPainting $fb_painting, EventFbPaintingType $fb_painting_type, EventFbPaintingLog $fb_painting_log)
    {
        $this->fb_painting = $fb_painting;
        $this->fb_painting_type = $fb_painting_type;
        $this->fb_painting_log = $fb_painting_log;
    }

    /**
     * 取得類別選單ID
     * [getBulletinType description]
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public function getFBPaintingTypeID($params)
    {
        $res = $this->fb_painting_type->where('short', $params)->value('id');
        return empty($res) ? false : $res;
    }

    /**
     * 取得類別清單內容
     * [getFBPaintingList description]
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public function getFBPaintingList($id)
    {

        $arr = [];
        $arr['hot'] = $this->fb_painting->where('type_id', $id)->orderBy('like_cnt', 'DESC')->paginate(12, ['*'], 'hot');
        $arr['new'] = $this->fb_painting->where('type_id', $id)->orderBy('created_at', 'DESC')->paginate(12, ['*'], 'new');

        return $arr;
    }

    /**
     * 取得內容
     * [getFBPaintingInfo description]
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public function getFBPaintingInfo($id)
    {
        $res = $this->fb_painting->where('id', $id)->first();
        return empty($res) ? false : $res;
    }

    /**
     * 取得投票內容
     * [getFBPaintingVote description]
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public function getFBPaintingVote($id, $tid, $oid)
    {
        $res = $this->fb_painting_log;
        if (!is_null($id)):
            $res = $res->where('painting_id', $id);
        endif;

        if (!is_null($tid)):
            $res = $res->where('type_id', $tid);
        endif;

        if (!is_null($oid)):
            $res = $res->where('user_id', $oid);
        endif;

        $res = $res->selectRaw('painting_id as id, type_id as tid')->whereRaw("date(`created_at`) ='" . date("Y-m-d") . "'")->limit(1)->first();
        return empty($res) ? false : $res;
    }

    /**
     * 進行投票
     * [doFBPaintingVote description]
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public function doFBPaintingVote($params, $wparams)
    {
        $res = $this->fb_painting_log->insert($params);
        $up_res = $this->fb_painting->where($wparams)->increment('like_cnt', 1);
        return empty($res) ? false : $res;
    }
}
