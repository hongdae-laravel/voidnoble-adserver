<?php

namespace App\Http\Controllers;

use App\Advertisement;
use App\Log;
use http\Env\Response;
use Request;

class CollectController extends Controller
{
    public function view($id)
    {
        // 광고 $id 에 대한 access log DB에 저장
        $adver = Advertisement::find($id);

        $log = new Log();

        $log->ad_id = $adver->id;
        $log->hit = 0;
        $log->view = 1;
        $log->datetime = date("Y-m-d H:i:s");
        $log->ip = Request::server("REMOTE_ADDR");
        $log->user_agent = Request::server("HTTP_USER_AGENT");

        $log->save();

        return "";
    }

    public function click($id)
    {
        // 광고 $id 의 클릭수를 +1 해 주고 로그 DB에 저장, 배너의 지정된 링크로 redirect 시켜줌.
        $adver = Advertisement::find($id);

        $log = new Log();

        $log->ad_id = $adver->id;
        $log->hit = 1;
        $log->view = 0;
        $log->datetime = date("Y-m-d H:i:s");
        $log->ip = Request::server("REMOTE_ADDR");
        $log->useragent = Request::server("HTTP_USER_AGENT");

        $log->save();

        return Response::redirect($adver->link);
    }
}
