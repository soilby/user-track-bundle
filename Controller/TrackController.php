<?php
namespace Soil\UserTrackBundle\Controller;

use Doctrine\ODM\MongoDB\DocumentManager;
use Soil\UserTrackBundle\Entity\ActivityEntry;
use Soil\UserTrackBundle\Service\ActivityService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Created by PhpStorm.
 * User: fliak
 * Date: 15.9.15
 * Time: 6.24
 */

class TrackController {

    /**
     * @var ActivityService
     */
    protected $activityService;

    public function __construct($activityService)   {
        $this->activityService = $activityService;

    }

    public function trackAction($track_id, $user_uri, Request $request)   {
        try {
            if ($request->isMethod('POST')) {
                $content = $request->getContent();
                $data = json_decode($content, true);

                if (!$data) throw new \Exception('Request malformed');

                //setup uri and id from post body
                if (!$user_uri) {
                    $user_uri = array_key_exists('user_uri', $data) ? $data['user_uri'] : null;
                }
                if (!$track_id) {
                    $track_id = array_key_exists('track_id', $data) ? $data['user_uri'] : null;
                }
                unset($data['user_uri']);
                unset($data['track_id']);

            } else {
                $data = [];
            }

            if (!$user_uri) throw new \Exception("User should be defined");

            $trackDoc = $this->activityService->getTrackDoc($user_uri, $track_id);

            $activityEntry = new ActivityEntry();
            $activityEntry->setIp($_SERVER['REMOTE_ADDR']);
            $activityEntry->setAgent($_SERVER['HTTP_USER_AGENT']);
            $activityEntry->setReferer($_SERVER['HTTP_REFERER']);

            if (array_key_exists('page', $data))    {
                $activityEntry->setPage($data['page']);
            }

            $trackDoc->addActivity($activityEntry);

            $this->activityService->flush();

            return new JsonResponse('OK');
        }
        catch (\Exception $e)   {
            return new JsonResponse($e->getMessage(), 500);
        }

    }

} 