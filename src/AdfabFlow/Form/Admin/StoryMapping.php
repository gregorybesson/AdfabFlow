<?php
namespace AdfabFlow\Form\Admin;

use AdfabFlow\Options\ModuleOptions;
use Zend\Form\Form;
use Zend\Form\Element;
use ZfcBase\Form\ProvidesEventsForm;
use Zend\I18n\Translator\Translator;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\ServiceManager\ServiceManager;

class StoryMapping extends ProvidesEventsForm
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
        
        // Mapping of an Entity to get value by getId()... Should be taken in charge by Doctrine Hydrator Strategy...
        // having to fix a DoctrineModule bug :( https://github.com/doctrine/DoctrineModule/issues/180
        // so i've extended DoctrineHydrator ...
        $hydrator = new DoctrineHydrator($entityManager, 'AdfabFlow\Entity\OpenGraphStoryMapping');
        $hydrator->addStrategy('story', new \AdfabCore\Stdlib\Hydrator\Strategy\ObjectStrategy());
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
        	'name' => 'domainId',
        	'type'  => 'Zend\Form\Element\Hidden',
       		'attributes' => array(
       			'value' => 0,
       		),
        ));
        
        $stories = $this->getStories();
        $this->add(array(
        	'type' => 'Zend\Form\Element\Select',
        	'name' => 'story',
       		'options' => array(
       			'value_options' => $stories,
       			'label' => $translator->translate('Story', 'adfabflow')
       		)
        ));
        
        $this->add(array(
       		'name' => 'eventBeforeUrl',
       		'options' => array(
       				'label' => $translator->translate('Event before Url', 'adfabflow')
       		),
       		'attributes' => array(
       				'type' => 'text',
        			'placeholder' => $translator->translate('Event before Url', 'adfabflow')
        	)
        ));
        
        $this->add(array(
        	'name' => 'eventBeforeXpath',
        	'options' => array(
       			'label' => $translator->translate('Event before Xpath', 'adfabflow')
       		),
       		'attributes' => array(
       			'type' => 'text',
       			'placeholder' => $translator->translate('Event before Xpath', 'adfabflow')
       		)
        ));
        
        $this->add(array(
        	'name' => 'eventAfterUrl',
       		'options' => array(
       			'label' => $translator->translate('Event after Url', 'adfabflow')
       		),
       		'attributes' => array(
       			'type' => 'text',
       			'placeholder' => $translator->translate('Event after Url', 'adfabflow')
       		)
        ));
        
        $this->add(array(
       		'name' => 'eventAfterXpath',
       		'options' => array(
        		'label' => $translator->translate('Event after Xpath', 'adfabflow')
       		),
       		'attributes' => array(
   				'type' => 'text',
       			'placeholder' => $translator->translate('Event after Xpath', 'adfabflow')
        	)
        ));
        
        $this->add(array(
       		'name' => 'conditionsUrl',
       		'options' => array(
       				'label' => $translator->translate('Conditions URL', 'adfabflow')
       		),
       		'attributes' => array(
       			'type' => 'text',
        		'placeholder' => $translator->translate('Conditions URL', 'adfabflow')
        	)
        ));
        
        $this->add(array(
       		'name' => 'conditionsXpath',
       		'options' => array(
       			'label' => $translator->translate('Conditions Xpath', 'adfabflow')
       		),
       		'attributes' => array(
       			'type' => 'text',
       			'placeholder' => $translator->translate('Conditions Xpath', 'adfabflow')
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
    public function getStories ()
    {
    	$storiesArray = array();
    	$storyService = $this->getServiceManager()->get('adfabflow_story_service');
    	$stories = $storyService->getStoryMapper()->findAll();
    
    	foreach ($stories as $story) {
    		$storiesArray[$story->getId()] = $story->getLabel();
    	}
    
    	return $storiesArray;
    }
}
