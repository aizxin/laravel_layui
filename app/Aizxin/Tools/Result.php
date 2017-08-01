<?php
namespace Aizxin\Tools;

class Result {

    public $code;
    public $message;

    public function __construct()
    {
        $this->code = 200;
        $this->message = '获取成功';
    }
    public function toJson()
    {
        return json_encode($this, JSON_UNESCAPED_UNICODE);
    }

}
