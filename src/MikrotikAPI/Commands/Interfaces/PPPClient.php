<?php

namespace MikrotikAPI\Commands\Interfaces;

use MikrotikAPI\Util\SentenceUtil,
    MikrotikAPI\Roar\Roar;

/**
 * Description of PPPClient
 *
 * @author Lalu Erfandi Maula Yusnu nunenuh@gmail.com <http://vthink.web.id>
 * @copyright Copyright (c) 2011, Virtual Think Team.
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @category Libraries
 */
class PPPClient {

    private $roar;

    function __construct(Roar $roar) {
        $this->roar = $roar;
    }

    /**
     * This method used for add new interface ppp-client
     * @param type $param array
     * @return type array
     */
    public function add($param) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/interface/ppp-client/add");
        foreach ($param as $name => $value) {
            $sentence->setAttribute($name, $value);
        }
        $this->roar->send($sentence);
        return "Success";
    }

    /**
     * This method used for disable interface ppp-client
     * @param type $id string
     * @return type array
     */
    public function disable($id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/interface/ppp-client/disable");
        $sentence->where(".id", "=", $id);
        $this->roar->send($sentence);
        return "Success";
    }

    /**
     * This method used for enable interface ppp-client
     * @param type $id string
     * @return type array
     */
    public function enable($id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/interface/ppp-client/enable");
        $sentence->where(".id", "=", $id);
        $this->roar->send($sentence);
        return "Success";
    }

    /**
     * This method used for delete interface ppp-client
     * @param type $id string
     * @return type array
     */
    public function delete($id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/interface/ppp-client/remove");
        $sentence->where(".id", "=", $id);
        $this->roar->send($sentence);
        return "Success";
    }

    /**
     * This method used for detail interface ppp-client
     * @param type $id string
     * @return type array
     */
    public function detail($id) {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/interface/ppp-client/print");
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
     * This method used for set or edit interface ppp-client
     * @param type $param array
     * @param type $id string
     * @return type array
     */
    public function set($param, $id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/interface/ppp-client/set");
        foreach ($param as $name => $value) {
            $sentence->setAttribute($name, $value);
        }
        $sentence->where(".id", "=", $id);
        $this->roar->send($sentence);
        return "Success";
    }

    /**
     * This method used for get all interface ppp-client
     * @return type array
     */
    public function getAll() {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/interface/ppp-client/getall");
        $this->roar->send($sentence);
        $rs = $this->roar->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            return $rs->getResultArray();
        } else {
            return false;
        }
    }

}
