<?php

namespace App\Service\Relacional;

use Psr\Log\LoggerInterface;
use Exception;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Track;

/**
 * Class Relacional
 * @package App\Service\Relacional
 */
class Relacional
{
    /**
     * @var LoggerInterface $logger
     */
    protected $logger;

    /**
     * @var EntityManagerInterface
     */
    protected $em;

    public function persistTrack(array $data)
    {
        try {
            $newTrack = new Track();
            $newTrack->setImo($data['imo']);
            $newTrack->setTimeStamp(gmdate("Y-m-d\TH:i:s.u\Z", time()));
            $newTrack->setCoordinates($data['coordinates']);
            $this->em->persist($newTrack);
            $this->em->flush();
        } catch (Exception $e) {
            $this->logger->error('Error: ' . $e->getMessage());
        }
    }

    public function getAllTracks()
    {
        $result = [];

        $allTracks = $this->em->getRepository(Track::class)->findAll();
        if (!empty($allTracks)) {
            foreach ($allTracks as $track) {
                $result[] = $this->getDataTrack($track);
            }
        }

        return $result;
    }

    private function getDataTrack($track)
    {
        return [
            'IMO' => $track->getImo(),
            'timeStamp' => $track->getTimeStamp(),
            'Coordinates' => $track->getCoordinates()
        ];
    }

    /**
     * @required
     * @param LoggerInterface $logger
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param EntityManagerInterface $em
     * @required
     */
    public function setEm(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
}
