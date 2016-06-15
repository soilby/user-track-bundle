<?php
/**
 * Created by PhpStorm.
 * User: fliak
 * Date: 15.6.16
 * Time: 7.35
 */

namespace Soil\UserTrackBundle\Entity;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * Class ActivityEntry
 * @package Soil\UserTrackBundle\Entity
 * @ODM\Document(collection="page_visit")
 */
class PageVisit
{
    /**
     * @var \MongoId
     * @ODM\Id
     */
    protected $id;


    /**
     * @var string
     * @ODM\Field(type="string")
     */
    protected $pageURI;

    /**
     * @var integer
     * @ODM\Field(type="integer")
     */
    protected $visitCount;

    /**
     * @return \MongoId
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \MongoId $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getPageURI()
    {
        return $this->pageURI;
    }

    /**
     * @param string $pageURI
     */
    public function setPageURI($pageURI)
    {
        $this->pageURI = $pageURI;
    }

    /**
     * @return int
     */
    public function getVisitCount()
    {
        return $this->visitCount;
    }

    /**
     * @param int $visitCount
     */
    public function setVisitCount($visitCount)
    {
        $this->visitCount = $visitCount;
    }


    public function incrementVisit()    {
        $this->visitCount++;
    }

    
}