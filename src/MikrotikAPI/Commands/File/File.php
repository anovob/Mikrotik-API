<?php

namespace MikrotikAPI\Commands\File;

use MikrotikAPI\Util\SentenceUtil,
    MikrotikAPI\Roar\Roar;

/**
 * Description of Mapi_File
 *
 * @author Lalu Erfandi Maula Yusnu nunenuh@gmail.com <http://vthink.web.id>
 * @copyright Copyright (c) 2011, Virtual Think Team.
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @category Libraries
 */
class File {

    /**
     * @access private
     * @var type array
     */
    private $roar;

    function __construct(Roar $roar) {
        $this->roar = $roar;
    }

    /**
     * This method is used to display all file in mikrotik RouterOs
     * @return type array
     */
    public function get_all_file() {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/file/getall");
        $this->roar->send($sentence);
        $rs = $this->roar->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            return $rs->getResultArray();
        } else {
            return "No File";
        }
    }

    /**
     * This method is used to display one file 
     * in detail based on the id
     * @param type $id string 
     * @return type array
     */
    public function detail_file($id) {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/file/print");
        $sentence->where(".id", "=", $id);
        $this->roar->send($sentence);
        $rs = $this->roar->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            foreach ($rs->getResultArray() as $resust){
                return $resust;
            }
        } else {
            return false;
        }
    }

    /**
     * This method is used to delete file by id
     * @param type $id string
     * @return type array
     */
    public function delete_file($id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/file/remove");
        $sentence->where(".id", "=", $id);
        $enable = $this->roar->send($sentence);
        return "Success";
    }
    
    /**
     * [[Description]]
     * @param  [[Type]] $filename [[Description]]
     * @param  [[Type]] $contents [[Description]]
     * @return string   [[Description]]
     */
    public function create_file_compat($filename, $contents){
        $sentence = new SentenceUtil();
        $sentence->addCommand("/file/print");
        $sentence->setAttribute("file", $filename);
        $this->roar->send($sentence);
        $sentence = new SentenceUtil();
        $sentence->addCommand("/file/set");
        $sentence->setAttribute("$filename.txt", "contents=\"$contents\"");
        $enable = $this->roar->send($sentence);
        return "Success";        
    }
    
    public function create_file($filename, $content){
        $sentence = new SentenceUtil();
        $sentence->addCommand('[/lua "local f=assert(io.open(/'.$filename.', w+));');
        $sentence->addCommand('f:write('.$content.');');
        $sentence->addCommand('f:close();');
        $this->roar->send($sentence);
        return "Success";
    }

}
