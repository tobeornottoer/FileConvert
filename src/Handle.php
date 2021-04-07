<?php
/**
 * @author Administrator
 * @date 2021/4/7 17:29
 * @desciption:
 */

namespace FileConvert;


class Handle
{
    private static $errno  = 0;
    private static $errstr = null;

    public static function exec($command){
        $command .= " 2>&1";
        self::$errno    = 0;
        self::$errstr   = null;
        try {
            exec($command,self::$errstr,self::$errno);
        }catch (\Throwable $e){
            self::$errno    = -1;
            self::$errstr   = $e->getMessage();
        }
        return [self::$errstr,self::$errno];
    }
}