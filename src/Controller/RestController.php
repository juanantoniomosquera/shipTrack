<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Psr\Log\LoggerInterface;
use App\Service\Util\Util;
use App\Service\Mqtt\Mqtt;
use Exception;
use App\Service\Relacional\Relacional;

/**
 * @Route("/api")
 */
class RestController extends AbstractController
{

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var Util
     */
    private $util;

    /**
     * @var Mqtt
     */
    private $mqtt;

    /**
     * @var Relacional
     */
    private $relacionalService;

    /**
     * @param LoggerInterface $logger
     * @param Mqtt $mqtt
     * @param Util $util
     * @param Relacional $relacionalService
     */
    public function __construct(LoggerInterface $logger, Mqtt $mqtt, Util $util, Relacional $relacionalService)
    {
        $this->logger = $logger;
        $this->util = $util;
        $this->mqtt = $mqtt;
        $this->relacionalService = $relacionalService;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \Exception
     * @Route("/publish", name="api_publish")
     */
    public function publish(Request $request)
    {
        $result = ['result' => 'OK'];

        try {
            $this->mqtt->publishMessage($request->getContent());
        } catch (Exception $e) {
            $result = ['result' => $e->getMessage()];
        }

        return $this->json($result);
    }

    /**
     * @return void
     * @throws \Exception
     * @Route("/subscribe", name="api_subscribe")
     */
    public function subscribe()
    {
        $this->mqtt->subscribe();
    }

    /**
     * @return JsonResponse
     * @throws \Exception
     * @Route("/gettracks", name="api_gettracks")
     */
    public function gettracks()
    {
        $result = [];

        try {
            $allTracks = $this->relacionalService->getAllTracks();
            if (!empty($allTracks)) {
                $result = $allTracks;
            }
        } catch (Exception $e) {
            $result = ['result' => $e->getMessage()];
            $this->logger->error('Error: ' . $e->getMessage());
        }

        return $this->json($result);
    }
}
