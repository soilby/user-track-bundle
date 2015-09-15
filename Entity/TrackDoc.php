<?php
namespace Soil\UserTrackBundle\Entity;

/**
 * Created by PhpStorm.
 * User: fliak
 * Date: 15.9.15
 * Time: 6.32
 */
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * Class TrackDoc
 * @package Soil\UserTrackBundle\Entity
 * @ODM\Document(collection="activity")
 * @ODM\Index(keys={"userUri": "asc", "browserTrackId": "asc"})
 */
class TrackDoc {

    /**
     * @var \MongoId
     * @ODM\Id
     */
    protected $id;

    /**
     * @var string
     * @ODM\String
     */
    protected $userUri;

    /**
     * @var string
     * @ODM\String
     */
    protected $browserTrackId;

    /**
     * @var ArrayCollection
     * @ODM\Collection
     */
    protected $activity;

    public function __construct()   {
        $this->activity = new ArrayCollection();
    }

    /**
     * @return array
     */
    public function getActivity()
    {
        return $this->activity;
    }

    /**
     * @param array $activity
     */
    public function setActivity($activity)
    {
        $this->activity = $activity;
    }

    /**
     * @return string
     */
    public function getUserUri()
    {
        return $this->userUri;
    }

    /**
     * @param string $userUri
     */
    public function setUserUri($userUri)
    {
        $this->userUri = $userUri;
    }

    /**
     * @return string
     */
    public function getBrowserTrackId()
    {
        return $this->browserTrackId;
    }

    /**
     * @param string $browserTrackId
     */
    public function setBrowserTrackId($browserTrackId)
    {
        $this->browserTrackId = $browserTrackId;
    }

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



    public function addActivity($activity)  {
        $this->activity->add($activity);
    }


} 