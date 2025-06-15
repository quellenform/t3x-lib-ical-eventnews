<?php

defined('TYPO3') || die();

use GeorgRinger\News\Domain\Repository\NewsRepository;
use Quellenform\LibIcal\IcalRegistry;
use Quellenform\LibIcalEventnews\Provider\EventnewsProvider;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

if (ExtensionManagementUtility::isLoaded('lib_ical')) {
    GeneralUtility::makeInstance(
        IcalRegistry::class
    )->registerProvider(
        'eventnews',
        EventnewsProvider::class,
        [
            'components' => 'vevent',
            'class' => NewsRepository::class
        ]
    );
}
