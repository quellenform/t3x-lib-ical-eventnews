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
    'version' => '0.5.0',
    'constraints' => [
        'depends' => [
            'typo3' => '11.5.0-13.9.99',
            'lib_ical' => '0.5.0-0.5.99',
            'eventnews' => '6.0.0-7.99'
        ],
        'conflicts' => [],
        'suggests' => []
    ]
];
