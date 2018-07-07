<?php

/**
 * 接口返回值
 * @author       乔永刚 <helloqyg@163.com>
 * @version      0.1
 * @copyright    Copyright (c) 2018
 * @date         2018/06/13
 */

namespace App\Controller;

class ReturnData
{

    private $code;
    private $message;
    private $status;

    function __construct()
    {
        return 'abc';
    }

    public function getCode()
    {
        return $this->code;
    }

    public function getMessage()
    {
        return  $this->message;
    }

    public function getStatus()
    {
        return  $this->status;
    }


    public function setCode($code)
    {
        //self::$code = $code;
        $this->code = $code;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getAll(){
        return array("code"=>$this->code,"message"=>$this->message,"status"=>$this->status);
    }
}