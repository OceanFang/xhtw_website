<?php

namespace App\Services;

use App\Repository\BulletinRepo;

class BulletinService
{

    protected $repo;

    public function __construct(BulletinRepo $repo)
    {
        $this->repo = $repo;
    }

    // 取得公告
    public function getBulletin($params)
    {
        $res = $this->repo->getBulletin($params);
        return $res;
    }

    // 取得公告類別選單
    public function getBulletinType()
    {
        $res = $this->repo->getBulletinType();
        return $res;
    }

    // 取得公告類別
    public function getBulletinList($params)
    {
        $res = $this->repo->getBulletinList($params);
        return $res;
    }

    // 取得公告內容
    public function getBulletinInfo($id)
    {
        $res = $this->repo->getBulletinInfo($id);
        return $res;
    }

    // 取得上下一則
    public function getBulletinPrevNext($id, $type_id, $sort)
    {
        $prev = $this->repo->getBulletinPrev($id, $type_id, $sort);
        $next = $this->repo->getBulletinNext($id, $type_id, $sort);

        $obj = new \stdClass();
        $obj->prev = (!$prev) ? null : $prev->id;
        $obj->next = (!$next) ? null : $next->id;
        // $obj->next = null;

        return $obj;
    }
}
