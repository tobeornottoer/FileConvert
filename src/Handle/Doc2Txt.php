<?php
/**
 * @author Administrator
 * @date 2021/4/7 19:35
 * @desciption:
 */

namespace FileConvert\Handle;


use FileConvert\Base;
use FileConvert\BaseInterface;
use FileConvert\Handle;

class Doc2Txt extends Base implements BaseInterface
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
        $command = sprintf("%s --headless --convert-to \"txt:Text (encoded):UTF8\" --outdir %s %s",
            $this->bin,$new_path . DIRECTORY_SEPARATOR,$origin);
        list($output,$errno) = Handle::exec($command);
        $this->errno = $errno;
        $this->error = $output;
        if($errno !== 0){
            return false;
        }
        $file = $new_path . DIRECTORY_SEPARATOR .$path["filename"] . '.txt';
        return is_file($file) ? $file : false;
    }

}