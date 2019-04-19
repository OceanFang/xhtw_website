<?php

namespace App\Services;

use App\Repository\EventRepo;

class EventService
{

    protected $repo;

    public function __construct(EventRepo $repo)
    {
        $this->repo = $repo;
    }

    // 取得類別選單ID
    public function getFBPaintingTypeID($params)
    {
        $res = $this->repo->getFBPaintingTypeID($params);
        return $res;
    }

    // 取得類別清單內容
    public function getFBPaintingList($params)
    {
        $res = $this->repo->getFBPaintingList($params);
        return $res;
    }

    // 取得內容
    public function getFBPaintingInfo($id)
    {
        $res = $this->repo->getFBPaintingInfo($id);
        return $res;
    }

    // 取得投票內容
    public function getFBPaintingVote($id, $tid, $oid)
    {
        $res = $this->repo->getFBPaintingVote($id, $tid, $oid);
        return $res;
    }

    // 進行投票
    public function doFBPaintingVote($params, $wparams)
    {
        $res = $this->repo->doFBPaintingVote($params, $wparams);
        return $res;
    }
}
