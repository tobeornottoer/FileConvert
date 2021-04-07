<?php
/**
 * @author Administrator
 * @date 2021/4/7 19:54
 * @desciption:
 */

namespace FileConvert\Handle;


use FileConvert\Base;
use FileConvert\BaseInterface;
use FileConvert\Handle;

class Doc2Html extends Base implements BaseInterface
{
    protected $bin    = "soffice";

    /**
     * @param string $origin
     * @param string $new_path
     * @return string | false
     */
    public function change(string $origin,string $new_path = '')
    {
        $path = pathinfo($origin);
        if(empty($new_path)){
            $new_path = $path["dirname"];
        }
        $command = sprintf("%s --headless --convert-to \"html:XHTML Writer File:UTF8\" \ --convert-images-to \"jpg\" --outdir %s %s",
            $this->bin,$new_path . DIRECTORY_SEPARATOR,$origin);
        list($output,$errno) = Handle::exec($command);
        $this->errno = $errno;
        $this->error = $output;
        if($errno !== 0){
            return false;
        }
        $file = $new_path . DIRECTORY_SEPARATOR .$path["filename"] . '.html';
        return is_file($file) ? $file : false;
    }
}