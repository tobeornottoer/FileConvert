<?php
/**
 * @author Administrator
 * @date 2021/4/7 20:08
 * @desciption:
 */

namespace FileConvert\Handle;


use FileConvert\Base;
use FileConvert\BaseInterface;
use FileConvert\Handle;

class Pdf2Docx extends Base implements BaseInterface
{
    protected $bin    = "pdf2docx";

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
        $file = $new_path . DIRECTORY_SEPARATOR .$path["filename"] . '.pdf';
        $command = sprintf("%s convert %s %s --multi_processing=True",
            $this->bin,$origin,$file);
        list($output,$errno) = Handle::exec($command);
        $this->errno = $errno;
        $this->error = $output;
        if($errno !== 0){
            return false;
        }
        return is_file($file) ? $file : false;
    }
}