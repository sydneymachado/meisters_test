<?php

namespace TodosApp;

use Laminas\Router\Http\Segment;

use TodosApp\Controller\ToDoController;

use Laminas\ServiceManager\Factory\InvokableFactory;


return [
	'router' => [
		'routes' => [
			'todo-app' => [
				'type' => Segment::class,
				'options' => [
					'route' => '/todo-app[/:action[/:id]]',
					'constraints' => [
						'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
						'id' => '[1-9]\d*',
					],
					'defaults' => [
						'controller' => ToDoController::class,
						'action' => 'index'
					],
				]
			]
		]
	],
//    'controllers' => [
//        'factories' => [
//             ToDoController::class => InvokableFactory::class
//         ]
//    ],
   'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
		'template_map' => [
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
        ],
        'template_path_stack' => [
        __DIR__ . '/../view',
        ]
   ]
];