<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'TYPO3 Library: iCalendar Provider for "EXT:eventnews"',
    'description' => 'iCalendar Provider for Events',
    'category' => 'services',
    'state' => 'beta',
    'clearcacheonload' => true,
    'author' => 'Stephan Kellermayr',
    'author_email' => 'stephan.kellermayr@gmail.com',
    'author_company' => 'quellenform.at - MULTIMEDIA ART DESIGN',
    'version' => '0.3.0',
    'constraints' => [
        'depends' => [
            'typo3' => '11.5-11.5.99',
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
