<?php

namespace MikrotikAPI\Commands\IP\Hotspot;

use MikrotikAPI\Roar\Roar,
    MikrotikAPI\Util\SentenceUtil;

/**
 * Description of Server
 * @author Lalu Erfandi Maula Yusnu nunenuh@gmail.com <http://vthink.web.id>
 * @copyright Copyright (c) 2011, Virtual Think Team.
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @category Libraries
 */
class HotspotServer {

    /**
     *
     * @var Roar
     */
    private $roar;

    function __construct(Roar $roar) {
        $this->roar = $roar;
    }

    /**
     * This function is used to add hotspot
     * @return type array
     */
    public function add($param) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/ip/hotspot/add");
        foreach ($param as $name => $value) {
            $sentence->setAttribute($name, $value);
        }
        $this->roar->send($sentence);
        return "Success";
    }

    /**
     * This method is used to delete hotspot by id
     * @param type $id string
     * @return type array
     * 
     */
    public function delete($id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/ip/hotspot/remove");
        $sentence->where(".id", "=", $id);
        $enable = $this->roar->send($sentence);
        return "Success";
    }

    /**
     * This method is used to enable hotspot by id
     * @param type $id string
     * @return type array
     * 
     */
    public function enable($id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/ip/hotspot/enable");
        $sentence->where(".id", "=", $id);
        $enable = $this->roar->send($sentence);
        return "Success";
    }

    /**
     * This method is used to disable hotspot by id
     * @param type $id string
     * @return type array
     * 
     */
    public function disable($id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/ip/hotspot/disable");
        $sentence->where(".id", "=", $id);
        $disable = $this->roar->send($sentence);
        return "Success";
    }

    /**
     * This method is used to set or edit by id
     * @param type $param array
     * @param type $id string
     * @return type array
     * 
     */
    public function set($param, $id) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/ip/hotspot/set");
        foreach ($param as $name => $value) {
            $sentence->setAttribute($name, $value);
        }
        $sentence->where(".id", "=", $id);
        $this->roar->send($sentence);
        return "Success";
    }

    /**
     * This method is used to display all hotspot
     * @return type array
     * 
     */
    public function getAll() {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/ip/hotspot/getall");
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
     * This method is used to display hotspot
     * in detail based on the name
     * @param type $name string
     * @return type array
     *
     */
    public function detailByName($name) {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/ip/hotspot/print");
        $sentence->where("name", "=", $id);
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
     * This method is used to display one ppp profile
     * get Id By name
     * @param type $name string not array
     * @return type array
     *
     */
    public function getId($name) {
        $sentence = new SentenceUtil();
        $sentence->fromCommand("/ip/hotspot/print");
        $sentence->where("name", "=", $name);
        $this->roar->send($sentence);
        $rs = $this->roar->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            $rsArray = $rs->getResultArray();
            foreach ($rsArray as $Id) {
                return $Id['.id'];
            }
        } else {
            return false;
        }
    }

}
