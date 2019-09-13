<?php


namespace data;


class CustomData
{
    public static $flatArray = [
        ['id' => 1,  'name' => 'node1',  'parent_id' => null],
        ['id' => 2,  'name' => 'node2',  'parent_id' => null],
        ['id' => 3,  'name' => 'node3',  'parent_id' => null],
        ['id' => 4,  'name' => 'node4',  'parent_id' => 3],
        ['id' => 5,  'name' => 'node5',  'parent_id' => 3],
        ['id' => 6,  'name' => 'node6',  'parent_id' => 3],
        ['id' => 7,  'name' => 'node7',  'parent_id' => null],
        ['id' => 8,  'name' => 'node8',  'parent_id' => null],
        ['id' => 9,  'name' => 'node9',  'parent_id' => null],
        ['id' => 10, 'name' => 'node10', 'parent_id' => 6],
        ['id' => 11, 'name' => 'node11', 'parent_id' => 6],
        ['id' => 12, 'name' => 'node12', 'parent_id' => 6],
        ['id' => 13, 'name' => 'node13', 'parent_id' => 6],
        ['id' => 14, 'name' => 'node14', 'parent_id' => 6],
        ['id' => 15, 'name' => 'node15', 'parent_id' => 6],
        ['id' => 16, 'name' => 'node16', 'parent_id' => 6],
        ['id' => 17, 'name' => 'node17', 'parent_id' => 6],
        ['id' => 18, 'name' => 'node18', 'parent_id' => 2],
        ['id' => 19, 'name' => 'node19', 'parent_id' => 2],
        ['id' => 20, 'name' => 'node20', 'parent_id' => 15],
        ['id' => 21, 'name' => 'node21', 'parent_id' => 15],
        ['id' => 22, 'name' => 'node22', 'parent_id' => 15],
    ];
    public static $resultArray = [
        1 => [
            'id' => 1,
            'name' => 'node1',
            'parent_id' => null,
        ],
        2 => [
            'id' => 2,
            'name' => 'node2',
            'parent_id' => null,
            'children' => [
                18 => [
                    'id' => 18,
                    'name' => 'node18',
                    'parent_id' => 2,
                ],
                19 => [
                    'id' => 19,
                    'name' => 'node19',
                    'parent_id' => 2,
                ],
            ],
        ],
        3 => [
            'id' => 3,
            'name' => 'node3',
            'parent_id' => null,
            'children' => [
                4 => [
                    'id' => 4,
                    'name' => 'node4',
                    'parent_id' => 3,
                ],
                5 => [
                    'id' => 5,
                    'name' => 'node5',
                    'parent_id' => 3,
                ],
                6 => [
                    'id' => 6,
                    'name' => 'node6',
                    'parent_id' => 3,
                    'children' => [
                        10 => [
                            'id' => 10,
                            'name' => 'node10',
                            'parent_id' => 6,
                        ],
                        11 => [
                            'id' => 11,
                            'name' => 'node11',
                            'parent_id' => 6,
                        ],
                        12 => [
                            'id' => 12,
                            'name' => 'node12',
                            'parent_id' => 6,
                        ],
                        13 => [
                            'id' => 13,
                            'name' => 'node13',
                            'parent_id' => 6,
                        ],
                        14 => [
                            'id' => 14,
                            'name' => 'node14',
                            'parent_id' => 6,
                        ],
                        15 => [
                            'id' => 15,
                            'name' => 'node15',
                            'parent_id' => 6,
                            'children' => [
                                20 => [
                                    'id' => 20,
                                    'name' => 'node20',
                                    'parent_id' => 15,
                                ],
                                21 => [
                                    'id' => 21,
                                    'name' => 'node21',
                                    'parent_id' => 15,
                                ],
                                22 => [
                                    'id' => 22,
                                    'name' => 'node22',
                                    'parent_id' => 15,
                                ],
                            ],
                        ],
                        16 => [
                            'id' => 16,
                            'name' => 'node16',
                            'parent_id' => 6,
                        ],
                        17 => [
                            'id' => 17,
                            'name' => 'node17',
                            'parent_id' => 6,
                        ],
                    ],
                ],
            ],
        ],
        7 => [
            'id' => 7,
            'name' => 'node7',
            'parent_id' => null,
        ],
        8 => [
            'id' => 8,
            'name' => 'node8',
            'parent_id' => null,
        ],
        9 => [
            'id' => 9,
            'name' => 'node9',
            'parent_id' => null,
        ],
    ];

    public static $config = [
        'db' => [
            'connection' => [
                'dsn' => 'mysql:host=localhost;dbname=somedb',
                'user' => 'user',
                'password' => 'password',
            ]
        ],
        'cache' => [
            'ttl' => 300,
            'path' => __DIR__ . '/cache',
            'invalidation' => null
        ],
    ];
}