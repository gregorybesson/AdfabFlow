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
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view/admin',
        	__DIR__ . '/../view/frontend',
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),

    'controllers' => array(
        'invokables' => array(
            'adfabflowadmin'        => 'AdfabFlow\Controller\AdminController',
        	'adfabflowadminaction'  => 'AdfabFlow\Controller\Admin\ActionController',
        	'adfabflowadminobject'  => 'AdfabFlow\Controller\Admin\ObjectController',
        	'adfabflowadminstory'   => 'AdfabFlow\Controller\Admin\StoryController',
        	'adfabflowadmindomain'  => 'AdfabFlow\Controller\Admin\DomainController',
            'adfabflow'             => 'AdfabFlow\Controller\IndexController',
            'adfabflowrest'         => 'AdfabFlow\Controller\RestController',
            'adfabflowrestauthent'  => 'AdfabFlow\Controller\RestAuthentController',
            'adfabflowrestsend'     => 'AdfabFlow\Controller\RestSendController',
        ),
    ),

    'core_layout' => array(
        'AdfabFlow' => array(
            'default_layout' => 'layout/1column',
        	'controllers' => array(
       			'adfabflowadmin' => array(
      				'default_layout' => 'application/layout/admin/admin',
     			),
       			'adfabflowadminaction' => array(
       				'default_layout' => 'application/layout/admin/admin',
       			),
       			'adfabflowadminstory' => array(
       				'default_layout' => 'application/layout/admin/admin',
      			),
     			'adfabflowadmindomain' => array(
      				'default_layout' => 'application/layout/admin/admin',
      			),
      			'adfabflowadminobject' => array(
      				'default_layout' => 'application/layout/admin/admin',
       			),
        	),
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
            'flowsend' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/flow/:appId/rest/send[/:id]',
                    'constraints' => array(
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'adfabflowrestsend',
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
            'admin' => array(
                'child_routes' => array(
                    'adfabflow' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/flow',
                            'defaults' => array(
                                'controller' => 'adfabflowadminaction',
                                'action'     => 'index',
                            ),
                        ),
                    	'child_routes' =>array(
                  			'list' => array(
               					'type' => 'Segment',
               					'options' => array(
              						'route' => '/list/:appId[/:p]',
            						'defaults' => array(
          								'controller' => 'adfabflowadminaction',
              							'action'     => 'list',
              							'appId'     => 0
               						),
                   				),
                   			),
                    		'action' => array(
                    			'type' => 'Segment',
                    			'options' => array(
                   					'route' => '/action',
                   					'defaults' => array(
                   						'controller' => 'adfabflowadminaction',
               							'action'     => 'list',
              						),
               					),
                    			'may_terminate' => true,
                    			'child_routes' =>array(
                    				'pagination' => array(
                    					'type' => 'Segment',
                    					'options' => array(
           									'route' => '/:p',
                    						'defaults' => array(
                    							'controller' => 'adfabflowadminaction',
               									'action'     => 'list',
                    						),
                    					),
                   					),
                    				'create' => array(
                    					'type' => 'Segment',
                    					'options' => array(
           									'route' => '/create/:actionId',
                							'defaults' => array(
              	     							'controller' => 'adfabflowadminaction',
               									'action'     => 'create',
       											'actionId'     => 0
                    						),
                    					),
                    				),
                    				'edit' => array(
                    					'type' => 'Segment',
                    					'options' => array(
           									'route' => '/edit/:actionId',
                    						'defaults' => array(
                    							'controller' => 'adfabflowadminaction',
              									'action'     => 'edit',
       											'actionId'     => 0
                    						),
                   						),
                   					),
                    				'remove' => array(
                    					'type' => 'Segment',
                    					'options' => array(
           									'route' => '/remove/:actionId',
           									'defaults' => array(
                    							'controller' => 'adfabflowadminaction',
                   								'action'     => 'remove',
       											'actionId'     => 0
                    						),
                    					),
                   					),                    					
                   				),
                    		),
                    		'story' => array(
                    			'type' => 'Segment',
               					'options' => array(
          							'route' => '/story',
                    				'defaults' => array(
                    					'controller' => 'adfabflowadminstory',
                    					'action'     => 'list',
                    				),
                    			),
                    			'may_terminate' => true,
                    			'child_routes' =>array(
                    				'pagination' => array(
                    					'type' => 'Segment',
                    					'options' => array(
                    						'route' => '/:p',
      										'defaults' => array(
                    							'controller' => 'adfabflowadminstory',
                    							'action'     => 'list',
       										),
                    					),
                    				),
                    				'create' => array(
                    					'type' => 'Segment',
                    					'options' => array(
                    						'route' => '/create/:storyId',
                    						'defaults' => array(
                    							'controller' => 'adfabflowadminstory',
                    							'action'     => 'create',
                    							'storyId'     => 0
                    						),
                    					),
                    				),
                    				'edit' => array(
                    					'type' => 'Segment',
                    					'options' => array(
                    						'route' => '/edit/:storyId',
                    						'defaults' => array(
                    							'controller' => 'adfabflowadminstory',
                    							'action'     => 'edit',
                    							'storyId'     => 0
                    						),
                    					),
                    				),
                    				'remove' => array(
                    					'type' => 'Segment',
                    					'options' => array(
                    						'route' => '/remove/:storyId',
                    						'defaults' => array(
                    							'controller' => 'adfabflowadminstory',
                    							'action'     => 'remove',
   												'storyId'     => 0
                    						),
                    					),
                   					),
               					),
                    		),
                    		'domain' => array(
                    			'type' => 'Segment',
                    			'options' => array(
                    				'route' => '/domain',
                    				'defaults' => array(
                    					'controller' => 'adfabflowadmindomain',
                    					'action'     => 'list',
               						),
               					),
                    			'may_terminate' => true,
                    			'child_routes' =>array(
                    				'pagination' => array(
                    					'type' => 'Segment',
                    					'options' => array(
                    						'route' => '/:p',
                    						'defaults' => array(
                    							'controller' => 'adfabflowadmindomain',
                    							'action'     => 'list',
                    						),
               							),
           							),
                    				'create' => array(
                    					'type' => 'Segment',
                    					'options' => array(
                    						'route' => '/create/:domainId',
                    						'defaults' => array(
                    							'controller' => 'adfabflowadmindomain',
                    							'action'     => 'create',
   												'domainId'     => 0
                    						),
                    					),
                   					),
                    				'edit' => array(
                    					'type' => 'Segment',
                    					'options' => array(
                    						'route' => '/edit/:domainId',
                    						'defaults' => array(
   												'controller' => 'adfabflowadmindomain',
                    							'action'     => 'edit',
                    							'domainId'     => 0
                    						),
                    					),
              						),
                    				'remove' => array(
                   						'type' => 'Segment',
       									'options' => array(
                    						'route' => '/remove/:domainId',
                   							'defaults' => array(
   												'controller' => 'adfabflowadmindomain',
                    							'action'     => 'remove',
                    							'domainId'     => 0
      										),
                    					),
                    				),
                    				'story' => array(
                    					'type' => 'Segment',
                    					'options' => array(
           									'route' => '/:domainId/story',
                    						'defaults' => array(
                    							'controller' => 'adfabflowadmindomain',
                    							'action'     => 'listStory',
               									'domainId'     => 0
                    						),
                    					),
                    					'may_terminate' => true,
                    					'child_routes' =>array(
                    						'pagination' => array(
                    							'type' => 'Segment',
               									'options' => array(
                    								'route' => '/:p',
                    								'defaults' => array(
           												'controller' => 'adfabflowadmindomain',
                    									'action'     => 'listStory',
                    								),
               									),
                    						),
                    						'create' => array(
                    							'type' => 'Segment',
               									'options' => array(
                    								'route' => '/create/:mappingId',
                    								'defaults' => array(
          												'controller' => 'adfabflowadmindomain',
              											'action'     => 'createStory',
                    									'mappingId'     => 0
       												),
                    							),
                    						),
                    						'edit' => array(
                    							'type' => 'Segment',
                    							'options' => array(
                    								'route' => '/edit/:mappingId',
                    								'defaults' => array(
                    									'controller' => 'adfabflowadmindomain',
                    									'action'     => 'editStory',
                    									'mappingId'     => 0
                    								),
                    							),
           									),
                    						'remove' => array(
                    							'type' => 'Segment',
               									'options' => array(
                    								'route' => '/remove/:mappingId',
                    								'defaults' => array(
                    									'controller' => 'adfabflowadmindomain',
                    									'action'     => 'removeStory',
                    									'mappingId'     => 0
                    								),
                    							),
           									),
                    						'attribute' => array(
                    							'type' => 'Segment',
                    							'options' => array(
                    								'route' => '/:mappingId/attribute',
                   									'defaults' => array(
                    									'controller' => 'adfabflowadmindomain',
                    									'action'     => 'listAttribute',
                    									'mappingId'     => 0
                    								),
                    							),
                    									'may_terminate' => true,
                    									'child_routes' =>array(
                    											'pagination' => array(
                    													'type' => 'Segment',
                    													'options' => array(
                    															'route' => '/:p',
                    															'defaults' => array(
                    																	'controller' => 'adfabflowadmindomain',
                    																	'action'     => 'listAttribute',
                    															),
                    													),
                    											),
                    											'create' => array(
                    													'type' => 'Segment',
                    													'options' => array(
                    															'route' => '/create/:attributeId',
                    															'defaults' => array(
                    																	'controller' => 'adfabflowadmindomain',
                    																	'action'     => 'createAttribute',
                    																	'attributeId'     => 0
                    															),
                    													),
                    											),
                    											'edit' => array(
                    													'type' => 'Segment',
                    													'options' => array(
                    															'route' => '/edit/:attributeId',
                    															'defaults' => array(
                    																	'controller' => 'adfabflowadmindomain',
                    																	'action'     => 'editAttribute',
                    																	'attributeId'     => 0
                    															),
                    													),
                    											),
                    											'remove' => array(
                    													'type' => 'Segment',
                    													'options' => array(
                    															'route' => '/remove/:attributeId',
                    															'defaults' => array(
                    																	'controller' => 'adfabflowadmindomain',
                    																	'action'     => 'removeAttribute',
                    																	'attributeId'     => 0
                    															),
                    													),
                    											),
                    									),
                    							),
                    					),
                    				),
                    			),
                    		),
                    		'object' => array(
                    			'type' => 'Segment',
                    			'options' => array(
               						'route' => '/object',
               						'defaults' => array(
          								'controller' => 'adfabflowadminobject',
                  						'action'     => 'list',
                   					),
                   				),
               					'may_terminate' => true,
               					'child_routes' =>array(
               						'pagination' => array(
               							'type' => 'Segment',
                  						'options' => array(
                   						'route' => '/:p',
                    						'defaults' => array(
                    							'controller' => 'adfabflowadminobject',
                    							'action'     => 'list',
                    						),
                   						),
               						),
           							'create' => array(
               							'type' => 'Segment',
              							'options' => array(
                   							'route' => '/create/:objectId',
                   							'defaults' => array(
                   								'controller' => 'adfabflowadminobject',
                   								'action'     => 'create',
                   								'objectId'     => 0
               								),
               							),
           							),
           							'edit' => array(
               							'type' => 'Segment',
               							'options' => array(
                   							'route' => '/edit/:objectId',
                   							'defaults' => array(
                   								'controller' => 'adfabflowadminobject',
                  								'action'     => 'edit',
                    							'objectId'     => 0
                   							),
                   						),
                   					),
                 					'remove' => array(
                   						'type' => 'Segment',
               							'options' => array(
               								'route' => '/remove/:objectId',
               								'defaults' => array(
               									'controller' => 'adfabflowadminobject',
               									'action'     => 'remove',
           										'objectId'     => 0
           									),
               							),
               						),
               						'attribute' => array(
               							'type' => 'Segment',
               							'options' => array(
           									'route' => '/attribute',
        									'defaults' => array(
               									'controller' => 'adfabflowadminobject',
               									'action'     => 'listAttribute',
               								),
               							),
               							'may_terminate' => true,
               							'child_routes' =>array(
               								'pagination' => array(
               									'type' => 'Segment',
       											'options' => array(
               										'route' => '/:p',
               										'defaults' => array(
               											'controller' => 'adfabflowadminobject',
														'action'     => 'listAttribute',
               										),
               									),
               								),
               								'create' => array(
               									'type' => 'Segment',
               									'options' => array(
               										'route' => '/create/:attributeId',
               										'defaults' => array(
               											'controller' => 'adfabflowadminobject',
														'action'     => 'createAttribute',
               											'attributeId'     => 0
               										),
       											),
        									),
               								'edit' => array(
               									'type' => 'Segment',
               									'options' => array(
               										'route' => '/edit/:attributeId',
               										'defaults' => array(
               											'controller' => 'adfabflowadminobject',
               											'action'     => 'editAttribute',
               											'attributeId'     => 0
               										),
               									),
       										),
               								'remove' => array(
               									'type' => 'Segment',
               									'options' => array(
       												'route' => '/remove/:attributeId',
               										'defaults' => array(
               											'controller' => 'adfabflowadminobject',
               											'action'     => 'removeAttribute',
               											'attributeId'     => 0
               										),
               									),
               								),
               							),
               						),
                    			),
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
    		'adfabflow'     => array(
    			'label'     => 'Open Graph',
    			'route'     => 'admin/adfabflow/story',
    			'resource'  => 'flow',
    			'privilege' => 'list',
    			'pages' => array(
    				'list' => array(
    					'label'     => 'Liste des stories',
    					'route'     => 'admin/adfabflow/story',
    					'resource'  => 'flow',
    					'privilege' => 'list',
    				),
    					'create' => array(
    							'label'     => 'Creer une story',
    							'route'     => 'admin/adfabflow/story/create',
    							'resource'  => 'flow',
    							'privilege' => 'list',
    					),
    					'listactions' => array(
    						'label'     => 'Liste des actions',
    						'route'     => 'admin/adfabflow/action',
    						'resource'  => 'flow',
    						'privilege' => 'list',
    					),
    					'listobjects' => array(
    						'label'     => 'Liste des objets',
    						'route'     => 'admin/adfabflow/object',
    						'resource'  => 'flow',
   							'privilege' => 'list',
    					),
    					'listapps' => array(
    							'label'     => 'Liste des domaines',
    							'route'     => 'admin/adfabflow/domain',
    							'resource'  => 'flow',
    							'privilege' => 'list',
    					),
    					'listdomains' => array(
    							'label'     => 'Liste des apps',
    							'route'     => 'admin/adfabflow/list',
    							'resource'  => 'flow',
    							'privilege' => 'list',
    					),
    			),
    		),
    	),
    ),
);
