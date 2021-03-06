<?php
namespace AdfabFlow\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\ORM\Mapping\PrePersist;
use Doctrine\ORM\Mapping\PreUpdate;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

/**
 * An Open Graph Story.
 * @ORM\Entity @HasLifecycleCallbacks
 * @ORM\Table(name="opengraph_story")
 */
class OpenGraphStory
{
	protected $inputFilter;
	
    /**
     * @ORM\Id
     * @ORM\Column(type="integer");
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string", length=255, unique=true, nullable=false)
     */
    protected $code;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    protected $label;
    
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $definition;
    
    /**
     * @ORM\ManyToOne(targetEntity="OpenGraphAction")
     */
    protected $action;
    
    /**
     * @ORM\ManyToOne(targetEntity="OpenGraphObject")
     */
    protected $object;

    /**
     * @ORM\Column(name="created_at", type="datetime")
     */
    protected $createdAt;

    /**
     * @ORM\Column(name="updated_at", type="datetime")
     */
    protected $updatedAt;

    public function __construct()
    {

    }

    /** @PrePersist */
    public function createChrono()
    {
        $this->createdAt = new \DateTime("now");
        $this->updatedAt = new \DateTime("now");
    }

    /** @PreUpdate */
    public function updateChrono()
    {
        $this->updatedAt = new \DateTime("now");
    }

    /**
     *
     * @return the $id
     */
    public function getId ()
    {
        return $this->id;
    }

    /**
     *
     * @param field_type $id
     */
    public function setId ($id)
    {
        $this->id = $id;
    }
    
    /**
     *
     * @return the $code
     */
    public function getCode ()
    {
        return $this->code;
    }

    /**
     *
     * @param field_type $code
     */
    public function setCode ($code)
    {
        $this->code = $code;
    }

    /**
     * @return the $label
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param field_type $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * @return the $user
     */
    public function getDefinition()
    {
        return $this->definition;
    }

    /**
     * @param field_type $definition
     */
    public function setDefinition($definition)
    {
        $this->definition = $definition;
    }

    /**
	 * @return the $action
	 */
	public function getAction() {
		return $this->action;
	}

	/**
	 * @param field_type $action
	 */
	public function setAction($action) {
		$this->action = $action;
	}

	/**
	 * @return the $object
	 */
	public function getObject() {
		return $this->object;
	}

	/**
	 * @param field_type $object
	 */
	public function setObject($object) {
		$this->object = $object;
	}

	/**
     * @return the $createdAt
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return the $updatedAt
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * Convert the object to an array.
     *
     * @return array
     */
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

    /**
     * Populate from an array.
     *
     * @param array $data
     */
    public function populate($data = array())
    {
    }
    
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
    	throw new \Exception("Not used");
    }
    
    public function getInputFilter()
    {
    	if (!$this->inputFilter) {
    		$inputFilter = new InputFilter();
    		$factory = new InputFactory();
    
    		$this->inputFilter = $inputFilter;
    	}
    
    	return $this->inputFilter;
    }
}
