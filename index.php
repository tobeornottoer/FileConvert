<?php
/**
 * @author Administrator
 * @date 2021/4/7 17:22
 * @desciption:
 */

use FileConvert\Handle\Pdf2Docx;

function auto_load($class){
    $class = str_replace("FileConvert\\",__DIR__ . DIRECTORY_SEPARATOR . "src" . DIRECTORY_SEPARATOR,$class);
    require $class . ".php";
}

spl_autoload_register("auto_load");


$d = new Pdf2Docx();

$result = $d->change(__DIR__ . "/test/pdf2doc/pdf2doc.pdf");
if($result === false){
    echo "错误码：" . $d->getCode() . ",错误信息：" . $d->getOutput();exit;
}
echo $result;exit;