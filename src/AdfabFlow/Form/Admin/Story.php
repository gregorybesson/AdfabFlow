<?php
namespace AdfabFlow\Form\Admin;

use AdfabFlow\Options\ModuleOptions;
use Zend\Form\Form;
use Zend\Form\Element;
use ZfcBase\Form\ProvidesEventsForm;
use Zend\I18n\Translator\Translator;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\ServiceManager\ServiceManager;

class Story extends ProvidesEventsForm
{

    /**
     *
     * @var ModuleOptions
     */
    protected $module_options;

    protected $serviceManager;

    public function __construct ($name = null, ServiceManager $sm, Translator $translator)
    {
        parent::__construct($name);

        $this->setServiceManager($sm);

        $entityManager = $this->getServiceManager()->get('doctrine.entitymanager.orm_default');
        
        $hydrator = new DoctrineHydrator($entityManager, 'AdfabFlow\Entity\OpenGraphStory');
        $hydrator->addStrategy('object', new \AdfabCore\Stdlib\Hydrator\Strategy\ObjectStrategy());
        $hydrator->addStrategy('action', new \AdfabCore\Stdlib\Hydrator\Strategy\ObjectStrategy());
        $this->setHydrator($hydrator);

        $this->setAttribute('enctype', 'multipart/form-data');

        $this->add(array(
            'name' => 'id',
            'type' => 'Zend\Form\Element\Hidden',
            'attributes' => array(
                'value' => 0
            )
        ));

        $this->add(array(
            'name' => 'code',
            'options' => array(
                'label' => $translator->translate('Code', 'adfabflow')
            ),
            'attributes' => array(
                'type' => 'text',
                'placeholder' => $translator->translate('Code', 'adfabflow')
            )
        ));

        $this->add(array(
            'name' => 'label',
            'options' => array(
                'label' => $translator->translate('Label', 'adfabflow')
            ),
            'attributes' => array(
                'type' => 'text',
            	'placeholder' => $translator->translate('Label', 'adfabflow')
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Textarea',
            'name' => 'definition',
            'options' => array(
                'label' => $translator->translate('Definition', 'adfabflow')
            ),
            'attributes' => array(
                'cols' => '10',
                'rows' => '10',
                'id' => 'definition'
            )
        ));
        
        $actions = $this->getActions();
        $this->add(array(
        	'type' => 'Zend\Form\Element\Select',
        	'name' => 'action',
        	'options' => array(
        		'value_options' => $actions,
       			'label' => $translator->translate('Action', 'adfabflow')
       		)
        ));
        
        $objects = $this->getObjects();
        $this->add(array(
        	'type' => 'Zend\Form\Element\Select',
        	'name' => 'object',
       		'options' => array(
   				'value_options' => $objects,
   				'label' => $translator->translate('Object', 'adfabflow')
       		)
        ));

        $submitElement = new Element\Button('submit');
        $submitElement->setLabel($translator->translate('Create', 'adfabflow'))
            ->setAttributes(array(
            'type' => 'submit'
        ));

        $this->add($submitElement, array(
            'priority' => - 100
        ));
    }

    /**
     * Retrieve service manager instance
     *
     * @return ServiceManager
     */
    public function getServiceManager ()
    {
        return $this->serviceManager;
    }

    /**
     * Set service manager instance
     *
     * @param  ServiceManager $serviceManager
     * @return User
     */
    public function setServiceManager (ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;

        return $this;
    }
    
    /**
     *
     * @return array
     */
    public function getObjects ()
    {
    	$objectsArray = array();
    	$objectService = $this->getServiceManager()->get('adfabflow_object_service');
    	$objects = $objectService->getObjectMapper()->findAll();
    
    	foreach ($objects as $object) {
    		$objectsArray[$object->getId()] = $object->getLabel();
    	}
    
    	return $objectsArray;
    }
    
    /**
     *
     * @return array
     */
    public function getActions ()
    {
    	$actionsArray = array();
    	$actionService = $this->getServiceManager()->get('adfabflow_action_service');
    	$actions = $actionService->getActionMapper()->findAll();
    
    	foreach ($actions as $action) {
    		$actionsArray[$action->getId()] = $action->getLabel();
    	}
    
    	return $actionsArray;
    }
}
