<?php
namespace Soil\UserTrackBundle\Service;

use Doctrine\ODM\MongoDB\DocumentManager;
use Soil\UserTrackBundle\Entity\TrackDoc;

/**
 * Created by PhpStorm.
 * User: fliak
 * Date: 15.9.15
 * Time: 6.53
 */

class ActivityService {


    protected $trackEntryRepo;

    /**
     * @var DocumentManager
     */
    protected $dm;

    public function __construct($dm)   {
        $this->dm = $dm;

    }

    public function getTrackDoc($userUri)   {
        $entry = $this->getRepository()->find($userUri);
        if (!$entry)    {
            $entry = $this->factory($userUri);
        }

        return $entry;
    }

    public function factory($userUri)   {
        $entry = new TrackDoc();
        $entry->setUserUri($userUri);

        $this->dm->persist($entry);

        return $entry;
    }

    public function getRepository() {
        if (!$this->trackEntryRepo) {
            $this->trackEntryRepo = $this->dm->getRepository('Soil\UserTrackBundle\Entity\TrackEntry');

        }

        return $this->trackEntryRepo;
    }

    public function flush() {
        $this->dm->flush();
    }

} 