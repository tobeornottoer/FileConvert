<?php
/**
 * @author Administrator
 * @date 2021/4/7 17:42
 * @desciption:
 */

namespace FileConvert;


interface BaseInterface
{
    public function change(string $origin,string $new_path);

}