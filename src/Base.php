<?php
/**
 * @author Administrator
 * @date 2021/4/7 19:18
 * @desciption:
 */

namespace FileConvert;


abstract class Base implements BaseInterface
{
    protected $bin    = null;
    protected $errno  = 0;
    protected $error  = null;

    public function getOutput(){
        return implode(",",$this->error);
    }

    public function getCode(){
        return $this->errno;
    }

}