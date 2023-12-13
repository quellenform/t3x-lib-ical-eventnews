<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'TYPO3 Library: iCalendar Provider for "EXT:eventnews"',
    'description' => 'iCalendar Provider for Events',
    'category' => 'services',
    'state' => 'beta',
    'clearcacheonload' => true,
    'author' => 'Stephan Kellermayr',
    'author_email' => 'typo3@quellenform.at',
    'author_company' => 'Kellermayr KG',
    'version' => '0.4.2',
    'constraints' => [
        'depends' => [
            'typo3' => '11.5-12.4.99',
            'lib_ical' => '0.3.0-0.3.99',
            'eventnews' => '6.0.0-6.99'
        ],
        'conflicts' => [],
        'suggests' => []
    ],
    'autoload' => [
        'psr-4' => ['Quellenform\\LibIcalEventnews\\' => 'Classes']
    ]
];
