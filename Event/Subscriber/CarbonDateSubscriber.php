<?php

namespace Nicosomb\WallabagCarbondateBundle\Event\Subscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Psr\Log\LoggerInterface;
use Wallabag\CoreBundle\Helper\CarbonDate;
use Wallabag\CoreBundle\Event\EntrySavedEvent;
use Doctrine\ORM\EntityManager;

class CarbonDateSubscriber implements EventSubscriberInterface
{
    private $em;
    private $logger;
    private $carbonDate;
    private $enabled;

    public function __construct(EntityManager $em, $enabled, CarbonDate $carbonDate, LoggerInterface $logger)
    {
        $this->em = $em;
        $this->carbonDate = $carbonDate;
        $this->logger = $logger;
        $this->enabled = $enabled;
    }

    public static function getSubscribedEvents()
    {
        return [
            EntrySavedEvent::NAME => 'onEntrySaved',
        ];
    }

    /**
     * Try to guess creation date.
     *
     * @param EntrySavedEvent $event
     */
    public function onEntrySaved(EntrySavedEvent $event)
    {
        if (false === $this->enabled) {
            $this->logger->debug('CarbonDateSubscriber: disabled.');

            return;
        }

        $entry = $event->getEntry();

        if (null !== $entry->getPublishedAt()) {
            $this->logger->debug('CarbonDateSubscriber: publishedBy is not null.');

            return;
        }

        $date = $this->carbonDate->fetchDate($entry->getUrl());

        if (null === $date) {
            $this->logger->debug('CarbonDateSubscriber: CarbonDate can\'t guess publication date.');

            return;
        }

        $entry->setPublishedAt($date);

        $this->em->persist($entry);
        $this->em->flush();
    }
}
