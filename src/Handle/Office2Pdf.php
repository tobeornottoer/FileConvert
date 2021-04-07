<?php
/**
 * @author Administrator
 * @date 2021/4/7 17:43
 * @desciption:利用 libreoffice ，将 doc、execl、ppt 转换成 pdf
 */

namespace FileConvert\Handle;


use FileConvert\Base;
use FileConvert\BaseInterface;
use FileConvert\Handle;

class Office2Pdf extends Base implements BaseInterface
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
        $command = sprintf("%s --headless --convert-to pdf:writer_pdf_Export --outdir %s %s",
            $this->bin,$new_path . DIRECTORY_SEPARATOR,$origin);
        list($output,$errno) = Handle::exec($command);
        $this->errno = $errno;
        $this->error = $output;
        if($errno !== 0){
            return false;
        }
        $file = $new_path . DIRECTORY_SEPARATOR .$path["filename"] . '.pdf';
        return is_file($file) ? $file : false;
    }

}