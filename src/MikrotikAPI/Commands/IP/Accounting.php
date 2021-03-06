<?php

namespace MikrotikAPI\Commands\IP;

use MikrotikAPI\Roar\Roar,
    MikrotikAPI\Util\SentenceUtil;

/**
 * Description of Mapi_Ip_Accounting
 * 
 * @author      Lalu Erfandi Maula Yusnu nunenuh@gmail.com <http://vthink.web.id>
 * @copyright   Copyright (c) 2011, Virtual Think Team.
 * @license     http://opensource.org/licenses/gpl-license.php GNU Public License
 * @category	Libraries
 */
class Accounting {

    /**
     *
     * @var type array
     */
    private $roar;

    function __construct(Roar $roar) {
        $this->roar = $roar;
    }

    /**
     * This method is used to set or edit ip accountng
     * @param type $account_local_traffic string
     * @param type $enabled string
     * @param type $threshold string
     * @return type array
     */
    public function setAccounting($account_local_traffic, $enabled, $threshold) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/ip/accounting/set");
        $sentence->setAttribute("account-local-traffic", $account_local_traffic);
        $sentence->setAttribute("enabled", $enabled);
        $sentence->setAttribute("threshold", $threshold);
        $this->roar->send($sentence);
        return "Success";
    }

    /**
     * This method is used to display all accounting
     * @return type array
     * 
     */
    public function getAll_accounting() {
        $sentence = new SentenceUtil();
        $sentence->fromCommand('/ip/accounting/getall');
        $this->roar->send($sentence);
        $rs = $this->roar->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            return $rs->getResultArray();
        } else {
            return false;
        }
    }

    /**
     * This method is used to display all snapshot
     * @return type array
     * 
     */
    public function get_all_snapshot() {
        $sentence = new SentenceUtil();
        $sentence->fromCommand('/ip/accounting/snapshot/getall');
        $this->roar->send($sentence);
        $rs = $this->roar->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            return $rs->getResultArray();
        } else {
            return false;
        }
    }

    /**
     * This method is used to display all uncounted
     * @return type array
     * 
     */
    public function get_all_uncounted() {
        $sentence = new SentenceUtil();
        $sentence->fromCommand('/ip/accounting/uncounted/getall');
        $this->roar->send($sentence);
        $rs = $this->roar->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            return $rs->getResultArray();
        } else {
            return false;
        }
    }

    /**
     * This method is used to display all web-acces
     * @return type array
     * 
     */
    public function get_all_web_access() {
        $sentence = new SentenceUtil();
        $sentence->fromCommand('/ip/accounting/web-access/getall');
        $this->roar->send($sentence);
        $rs = $this->roar->getResult();
        $i = 0;
        if ($i < $rs->size()) {
            return $rs->getResultArray();
        } else {
            return false;
        }
    }

    /**
     * This method is used to ip accounting set web-acces
     * @param type $accessible_via_web string default : yes or no
     * @return type array
     * 
     */
    public function set_web_access($accessible_via_web) {
        $sentence = new SentenceUtil();
        $sentence->addCommand("/ip/accounting/web-access/set");
        $sentence->setAttribute("accessible-via-web", $accessible_via_web);
        $sentence->setAttribute("address", "0.0.0.0/0");
        $this->roar->send($sentence);
        return "Success";
    }

}
