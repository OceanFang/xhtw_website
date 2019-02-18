<?php

namespace App\Repository;

use App\Bulletin;
use App\BulletinType;
use Carbon\Carbon;

class BulletinRepo
{
    public function __construct(Bulletin $bulletin, BulletinType $bulletin_type)
    {
        $this->bulletin = $bulletin;
        $this->bulletin_type = $bulletin_type;
    }
    /**
     * 取得公告標題
     * [getBulletin description]
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public function getBulletin($wparams)
    {
        return $this->bulletin->selectRaw('id, type_id, date(created_at) as date, title')->where('game', 'xhtw')->where($wparams)->where('start_time', '<=', Carbon::now())->where('end_time', '>=', Carbon::now())->orderBy('sort')->orderBy('created_at', 'DESC')->paginate(7);
    }

    /**
     * 取得公告類別選單
     * [getBulletinType description]
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public function getBulletinType()
    {
        return $this->bulletin_type->where('game', 'xhtw')->get();
    }

    /**
     * 取得公告類別
     * [getBulletinList description]
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public function getBulletinList($id)
    {
        return $this->bulletin->where('type_id', $id)->where('start_time', '<=', Carbon::now())->where('end_time', '>=', Carbon::now())->orderBy('sort')->orderBy('created_at', 'DESC')->paginate(15);
    }

    /**
     * 取得公告內容
     * [getBulletinInfo description]
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public function getBulletinInfo($id)
    {
        $res = $this->bulletin->where('id', $id)->where('start_time', '<=', Carbon::now())->where('end_time', '>=', Carbon::now())->first();
        return empty($res) ? false : $res;
    }

    /**
     * 取得上一則
     * [getBulletinInfo description]
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public function getBulletinPrev($id, $type_id, $sort)
    {
        $res = $this->bulletin->select('id')->where('id', '<>', $id)->where('sort', '<', $sort)->where('type_id', $type_id)->where('start_time', '<=', Carbon::now())->where('end_time', '>=', Carbon::now())->orderBy('sort', 'DESC')->orderBy('created_at', 'ASC')->limit(1)->first();
        return empty($res) ? false : $res;
    }

    /**
     * 取得下一則
     * [getBulletinInfo description]
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public function getBulletinNext($id, $type_id, $sort)
    {
        $res = $this->bulletin->select('id')->where('id', '<>', $id)->where('sort', '>', $sort)->where('type_id', $type_id)->where('start_time', '<=', Carbon::now())->where('end_time', '>=', Carbon::now())->orderBy('sort')->orderBy('created_at', 'DESC')->limit(1)->first();
        return empty($res) ? false : $res;
    }
}
