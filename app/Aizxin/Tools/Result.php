<?php
namespace Aizxin\Tools;

class Result {

    public $code;
    public $status;
    public $message;

    public function __construct()
    {
        $this->code = 200;
        $this->status = 'success';
        $this->message = '';
    }
    public function toJson()
    {
        return json_encode($this, JSON_UNESCAPED_UNICODE);
    }

}
