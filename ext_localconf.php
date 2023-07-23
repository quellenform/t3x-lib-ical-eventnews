<?php

defined('TYPO3_MODE') || die();

if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('lib_ical')) {
    \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
        \Quellenform\LibIcal\IcalRegistry::class
    )->registerProvider(
        'eventnews',
        \Quellenform\LibIcalEventnews\Provider\EventnewsProvider::class,
        [
            'components' => 'vevent',
            'class' => \GeorgRinger\News\Domain\Repository\NewsRepository::class
        ]
    );
}
