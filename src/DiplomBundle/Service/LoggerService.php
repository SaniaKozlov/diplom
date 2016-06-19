<?php

namespace DiplomBundle\Service;

use DiplomBundle\Entity\Log;
use Doctrine\ORM\EntityManager;

class LoggerService
{
    private $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function logEvent($subject, $action) {
        $log = new Log();
        $log->setAction($action);
        $log->setSubject($subject);

        $this->em->persist($log);
        $this->em->flush();
    }
}