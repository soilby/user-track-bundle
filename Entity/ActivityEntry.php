<?php
/**
 * Created by PhpStorm.
 * User: fliak
 * Date: 15.9.15
 * Time: 7.06
 */

namespace Soil\UserTrackBundle\Entity;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * Class ActivityEntry
 * @package Soil\UserTrackBundle\Entity
 * @ODM\EmbedDocument
 */
class ActivityEntry {

    public function __construct()   {
        $this->timestamp = new \DateTime();
    }

    /**
     * @var string
     * @ODM\String
     */
    protected $ip;

    /**
     * @var string
     * @ODM\String
     */
    protected $agent;

    /**
     * @var \DateTime
     * @ODM\DateTime
     */
    protected $timestamp;

    /**
     * @var string
     * @ODM\String
     */
    protected $referer;

    /**
     * @var string
     * @ODM\String
     */
    protected $page;

    /**
     * @return string
     */
    public function getAgent()
    {
        return $this->agent;
    }

    /**
     * @param string $agent
     */
    public function setAgent($agent)
    {
        $this->agent = $agent;
    }

    /**
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @param string $ip
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
    }

    /**
     * @return string
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @param string $page
     */
    public function setPage($page)
    {
        $this->page = $page;
    }

    /**
     * @return string
     */
    public function getReferer()
    {
        return $this->referer;
    }

    /**
     * @param string $referer
     */
    public function setReferer($referer)
    {
        $this->referer = $referer;
    }

    /**
     * @return array
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * @param array $timestamp
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;
    }

}
