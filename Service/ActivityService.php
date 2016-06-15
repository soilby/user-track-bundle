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
    
    protected $pageVisitRepo;

    /**
     * @var DocumentManager
     */
    protected $dm;

    public function __construct($dm)   {
        $this->dm = $dm->getManager();;

    }

    public function getTrackDoc($userUri, $trackId)   {
        $entry = $this->getRepository()->findOneBy([
            'userUri' => $userUri,
            'browserTrackId' => $trackId
        ]);
        if (!$entry)    {
            $entry = $this->factory($userUri, $trackId);
        }

        return $entry;
    }

    public function factory($userUri, $trackId)   {
        $entry = new TrackDoc();
        $entry->setUserUri($userUri);
        $entry->setBrowserTrackId($trackId);

        $this->dm->persist($entry);

        return $entry;
    }

    public function getRepository() {
        if (!$this->trackEntryRepo) {
            $this->trackEntryRepo = $this->dm->getRepository('Soil\UserTrackBundle\Entity\TrackDoc');

        }

        return $this->trackEntryRepo;
    }

    /**
     * @return \Doctrine\ODM\MongoDB\DocumentRepository
     */
    public function getPageVisitRepository() {
        if (!$this->pageVisitRepo) {
            $this->pageVisitRepo = $this->dm->getRepository('Soil\UserTrackBundle\Entity\PageVisit');

        }

        return $this->pageVisitRepo;
    }

    public function flush() {
        $this->dm->flush();
    }

} 