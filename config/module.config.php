<?php

return array(
    'doctrine' => array(
        'driver' => array(
            'adfabflow_entity' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => __DIR__ . '/../src/AdfabFlow/Entity'
            ),

            'orm_default' => array(
                'drivers' => array(
                    'AdfabFlow\Entity'  => 'adfabflow_entity'
                )
            )
        )
    ),

    'view_manager' => array(
        'template_map' => array(
            'adfab-flow/index/init'               => __DIR__ .  '/../view/adfab-flow/frontend/init.phtml',
        ),
        'template_path_stack' => array(
            'adfabflow' => __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),

    'controllers' => array(
        'invokables' => array(
            'adfabflowadmin'        => 'AdfabFlow\Controller\AdminController',
            'adfabflow'             => 'AdfabFlow\Controller\IndexController',
            'adfabflowrest'         => 'AdfabFlow\Controller\RestController',
            'adfabflowrestauthent'  => 'AdfabFlow\Controller\RestAuthentController',
            'adfabflowrestecho'     => 'AdfabFlow\Controller\RestEchoController',
        ),
    ),

    'core_layout' => array(
        'AdfabFlow' => array(
            'default_layout' => 'layout/1column',
        ),
    ),

    'router' => array(
        'routes' => array(
            'flowauthent' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/flow/:appId/rest/authent[/:id]',
                    'constraints' => array(
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'adfabflowrestauthent',
                    ),
                ),
            ),
            'flowecho' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/flow/:appId/rest/echo[/:id]',
                    'constraints' => array(
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'adfabflowrestecho',
                    ),
                ),
            ),
            'flow' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/flow[/:appId]',
                    'defaults' => array(
                        'controller' => 'adfabflow',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' =>array(
                    'init' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/init',
                            'defaults' => array(
                                'controller' => 'adfabflow',
                                'action'     => 'init'
                            ),
                        ),
                    ),
                ),
            ),
            'zfcadmin' => array(
                'child_routes' => array(
                    'adfabflowadmin' => array(
                        'type' => 'Literal',
                        'priority' => 1000,
                        'options' => array(
                            'route' => '/flow',
                            'defaults' => array(
                                'controller' => 'adfabflowadmin',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),

    'translator' => array(
            'locale' => 'fr_FR',
            'translation_file_patterns' => array(
                    array(
                            'type'         => 'phpArray',
                            'base_dir'     => __DIR__ . '/../language',
                            'pattern'      => '%s.php',
                            'text_domain'  => 'adfabflow'
                    ),
            ),
    ),

    'navigation' => array(
        'admin' => array(
            'adfabflowadmin' => array(
                'label' => 'Flow',
                'route' => 'zfcadmin/adfabflowadmin',
                'resource' => 'flow',
                'privilege' => 'index',
                'pages' => array(
                    'create' => array(
                        'label' => 'Flow',
                        'route' => 'zfcadmin/adfabflowadmin',
                        'resource' => 'flow',
                        'privilege' => 'index',
                    ),
                ),
            ),
        ),
    )
);
