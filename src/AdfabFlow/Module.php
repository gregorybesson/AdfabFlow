<?php

namespace AdfabFlow;

use Zend\Mvc\MvcEvent;
use Zend\Validator\AbstractValidator;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $application     = $e->getTarget();
        $serviceManager  = $application->getServiceManager();
        $eventManager    = $application->getEventManager();

        $translator = $serviceManager->get('translator');

        AbstractValidator::setDefaultTranslator($translator,'adfabcore');
    }


    public function getConfig()
    {
        return include __DIR__ . '/../../config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/../../src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        return array(
            'aliases' => array(
                    'adfabflow_doctrine_em' => 'doctrine.entitymanager.orm_default',
            ),

            'invokables' => array(
                    'adfabflow_flow_service'         => 'AdfabFlow\Service\Flow',
            		'adfabflow_action_service'       => 'AdfabFlow\Service\Action',
            		'adfabflow_object_service'       => 'AdfabFlow\Service\Object',
            		'adfabflow_story_service'        => 'AdfabFlow\Service\Story',
            		'adfabflow_domain_service'       => 'AdfabFlow\Service\Domain',
                    'adfabflow_broadcast_service'    => 'AdfabFlow\Service\Broadcast',
            ),

            'factories' => array(
                'adfabflow_module_options' => function ($sm) {
                    $config = $sm->get('Configuration');

                    return new Options\ModuleOptions(isset($config['adfabflow']) ? $config['adfabflow'] : array());
                },
                'adfabflow_action_mapper' => function ($sm) {
                	$mapper = new \AdfabFlow\Mapper\Action(
                			$sm->get('doctrine.entitymanager.orm_default'),
                			$sm->get('adfabflow_module_options')
                	);
                
                	return $mapper;
                },
                'adfabflow_action_form' => function($sm) {
                	$translator = $sm->get('translator');
                	$form = new Form\Admin\Action(null, $sm, $translator);
                	$action = new Entity\OpenGraphAction();
                	$form->setInputFilter($action->getInputFilter());
                
                	return $form;
                },
                'adfabflow_object_mapper' => function ($sm) {
                	$mapper = new \AdfabFlow\Mapper\Object(
                			$sm->get('doctrine.entitymanager.orm_default'),
                			$sm->get('adfabflow_module_options')
                	);
                
                	return $mapper;
                },
                'adfabflow_objectattribute_mapper' => function ($sm) {
                	$mapper = new \AdfabFlow\Mapper\ObjectAttribute(
                			$sm->get('doctrine.entitymanager.orm_default'),
                			$sm->get('adfabflow_module_options')
                	);
                
                	return $mapper;
                },
                'adfabflow_story_mapper' => function ($sm) {
                	$mapper = new \AdfabFlow\Mapper\Story(
                			$sm->get('doctrine.entitymanager.orm_default'),
                			$sm->get('adfabflow_module_options')
                	);
                
                	return $mapper;
                },
                'adfabflow_domain_mapper' => function ($sm) {
                	$mapper = new \AdfabFlow\Mapper\Domain(
                			$sm->get('doctrine.entitymanager.orm_default'),
                			$sm->get('adfabflow_module_options')
                	);
                
                	return $mapper;
                },
                'adfabflow_storymapping_mapper' => function ($sm) {
                	$mapper = new \AdfabFlow\Mapper\StoryMapping(
                			$sm->get('doctrine.entitymanager.orm_default'),
                			$sm->get('adfabflow_module_options')
                	);
                
                	return $mapper;
                },
                'adfabflow_objectattributemapping_mapper' => function ($sm) {
                	$mapper = new \AdfabFlow\Mapper\ObjectAttributeMapping(
                			$sm->get('doctrine.entitymanager.orm_default'),
                			$sm->get('adfabflow_module_options')
                	);
                
                	return $mapper;
                },
                'adfabflow_object_form' => function($sm) {
                	$translator = $sm->get('translator');
                	$form = new Form\Admin\Object(null, $sm, $translator);
                	$object = new Entity\OpenGraphObject();
                	$form->setInputFilter($object->getInputFilter());
                
                	return $form;
                },
                'adfabflow_objectattribute_form' => function($sm) {
                	$translator = $sm->get('translator');
                	$form = new Form\Admin\ObjectAttribute(null, $sm, $translator);
                	$objectAttribute = new Entity\OpenGraphObjectAttribute();
                	$form->setInputFilter($objectAttribute->getInputFilter());
                
                	return $form;
                },
                'adfabflow_story_form' => function($sm) {
                	$translator = $sm->get('translator');
                	$form = new Form\Admin\Story(null, $sm, $translator);
                	$story = new Entity\OpenGraphStory();
                	$form->setInputFilter($story->getInputFilter());
                
                	return $form;
                },
                'adfabflow_domain_form' => function($sm) {
                	$translator = $sm->get('translator');
                	$form = new Form\Admin\Domain(null, $sm, $translator);
                	$domain = new Entity\OpenGraphDomain();
                	$form->setInputFilter($domain->getInputFilter());
                
                	return $form;
                },
                'adfabflow_storymapping_form' => function($sm) {
                	$translator = $sm->get('translator');
                	$form = new Form\Admin\StoryMapping(null, $sm, $translator);
                	$story = new Entity\OpenGraphStoryMapping();
                	$form->setInputFilter($story->getInputFilter());
                
                	return $form;
                },
                'adfabflow_objectattributemapping_form' => function($sm) {
                	$translator = $sm->get('translator');
                	$form = new Form\Admin\ObjectAttributeMapping(null, $sm, $translator);
                	$attribute = new Entity\OpenGraphObjectAttributeMapping();
                	$form->setInputFilter($attribute->getInputFilter());
                
                	return $form;
                },
            ),
        );
    }
}
