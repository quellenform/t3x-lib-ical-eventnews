<?php

namespace Quellenform\LibIcalEventnews\Provider;

/*
 * This file is part of the "lib_ical" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

use GeorgRinger\Eventnews\Domain\Model\News;
use GeorgRinger\News\Domain\Repository\NewsRepository;
use Quellenform\LibIcal\Domain\Model\Calendar;
use Quellenform\LibIcal\Ical;
use Quellenform\LibIcal\IcalProviderInterface;
use Quellenform\LibIcal\Utility\IcalUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class EventnewsProvider
 */
class EventnewsProvider implements IcalProviderInterface
{
    /**
     * iCal Calender Model
     *
     * @var Calendar
     */
    public $calendar = null;

    /**
     * Get eventnews record and prepare data for iCal.
     *
     * @param Ical $ical
     * @param array $params
     *
     * @return bool
     */
    public function query(Ical $ical, array $params = []): bool
    {
        /** @var NewsRepository $newsRepository */
        $newsRepository = GeneralUtility::makeInstance(NewsRepository::class);

        if (!empty($params['uid'])) {
            // Create query
            $query = $newsRepository->createQuery();
            $query->getQuerySettings()->setLanguageUid($params['L']);
            $query->getQuerySettings()->setRespectStoragePage(false);
            $query->getQuerySettings()->setRespectSysLanguage(false);

            // Find record by given UID
            /** @var News $eventRecord */
            $eventRecord = $query->matching(
                $query->logicalAnd(
                    $query->equals('uid', $params['uid']),
                    $query->equals('deleted', 0)
                )
            )->execute()->getFirst();

            if ($eventRecord !== null && $eventRecord->getIsEvent()) {
                $calendar = $ical->getCalendar();

                $organizerName = $eventRecord->getOrganizer();
                if (empty($organizerName)) {
                    $organizerName = $eventRecord->getOrganizerSimple();
                } else {
                    $organizerName = $eventRecord->getOrganizer()->getTitle();
                }
                $location = $eventRecord->getLocation();
                if (empty($location)) {
                    $location = $eventRecord->getLocationSimple();
                } else {
                    $location = $eventRecord->getLocation()->getTitle();
                }
                $hasEndDateSet = empty($eventRecord->getEventEnd()) ? false : true;
                $allDay = $eventRecord->getFullDay();
                if ($allDay) {
                    $dateStart = $eventRecord->getDatetime()->modify('today')->getTimestamp();
                    if ($hasEndDateSet) {
                        $dateEnd = $eventRecord->getEventEnd()->modify('tomorrow')->getTimestamp();
                    } else {
                        $dateEnd = $eventRecord->getDatetime()->modify('tomorrow')->getTimestamp();
                    }
                } else {
                    $dateStart = $eventRecord->getDatetime()->getTimestamp();
                    if ($hasEndDateSet) {
                        $dateEnd = $eventRecord->getEventEnd()->getTimestamp();
                    } else {
                        $dateEnd = $eventRecord->getDatetime()->modify('+1 hour')->getTimestamp();
                    }
                }

                $component = $ical->getComponent();
                $component->setSummary($eventRecord->getTitle());
                $teaser = IcalUtility::stripHtml($eventRecord->getTeaser());
                if (!empty($teaser)) {
                    $component->setDescription($teaser);
                }
                $component->setDateStart($dateStart);
                $component->setDateEnd($dateEnd);
                $component->setLocation($location);
                $component->setIsAlldayEvent($allDay);
                $component->setOrganizerName($organizerName);

                if (!empty($params['referrer'])) {
                    $component->setUrl($params['referrer']);
                }
                $calendar->addComponent('event', $component);

                $ical->setCalendar($calendar);
                $ical->setFilename($eventRecord->getTitle());

                return true;
            }
        }
        return false;
    }
}
