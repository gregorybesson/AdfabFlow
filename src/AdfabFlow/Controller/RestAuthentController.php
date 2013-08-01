<?php

namespace AdfabFlow\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
 
class RestAuthentController extends AbstractRestfulController
{
    
    /*
     * http://127.0.0.1/playground/flow/XX-XX-YY/rest/authent
    */
    public function getList()
    {
        $response = $this->getResponse();
        $contentType = 'application/json';
        $adapter = '\Zend\Serializer\Adapter\Json';
        $response->getHeaders()->addHeaderLine('Content-Type',$contentType);
        $adapter = new $adapter;
        
        $appId = $this->getEvent()->getRouteMatch()->getParam('appId');
        
        /*
        $content = array(
            'login' => array(
                'urls' => array(
                    'page' => 'http://ic.adfab.fr/pmagento/index.php/customer/account/login/',
                    'success' => 'http://ic.adfab.fr/pmagento/index.php/customer/account/',
                ),
                'items' => array(
                    array('selector' => 'id', 'name' => 'email')
                ),
            ),
            'logout' => array(
                'urls' => array(
                    'page' => 'http://ic.adfab.fr/pmagento/',
                    'success' => 'http://ic.adfab.fr/pmagento/index.php/customer/account/logoutSuccess/',
                ),
            ),
            'taxonomy' => array(
                'config' => array(
                    'broadcast' => false,
                ),
                'items' => array(
                    array(
                        'url' => '/account', 
                        'xpath' => "//div[@class='block-account']",
                        'id' =>  'account'
                    ),
                    array(
                        'url' => '/checkout',
                        'id' =>  'checkout'
                    ),
                    array(
                        'xpath' => "//div[@class='my-wishlist']",
                        'id' =>  'wishlist'
                    ),
                ),
            ),
        );*/

        $content = array(
	        'library' => array(
	        	'config' => array(
	        		'broadcast' => false
	        	),
	        	'stories' => array(
	        		'login_user' => array(
	        			'events' => array(
	        				'before' => array(
	        					'url' => '/customer\\/account\\/login/',
	        					'xpath' => "//a[@title='Log In']"
	        				),
	        				'after' => array(
	                        	'url' => '/customer\\/account/',
	                            'xpath' => "//a[@title='Log Out']"
	        				),
	        			),
	        			'conditions' => array(
	        				'url' => '/customer\\/account\\/login/',
	        				'xpath' => "//input[@id='email']"
	        			),
	        			'action' => 'login',
	                	'objects' => array(
	        				'id'=> 'login_id',
	        				'properties'=> array(
	        					array(
	        						'name'=> 'email',
	        						'xpath'=> "//input[@id='email']"
	        					),
	        					array(
	        						'name'=> 'email2',
	        						'xpath'=> "//input[@id='email2']"
								),
	        				),
	                	),
	        		),
	        		'logout_user' => array(
	        			'events'=> array(
	        				'before'=> array(
	        					'url'=> '/p.magento/',
	        					'xpath'=> "//a[@title='Log Out']"
	        				),
	        				'after'=> array(
	        					'url'=> '/p.magento/',
	        					'xpath'=> "//a[@title='Log In']"
	        				),
	        			),
	                	'conditions'=> array(
	        				'url'=> '/logoutSuccess/',
	        				'xpath'=> "//a[@title='Log In']"
	        			),
	        			'action'=> 'logout'
	        		),
	        		'tips1' => array(
	                	'conditions'=> array(
	        				'url'=> '/pmagento.dev/'
	        			),
	        			'action'=> 'find',
	        			'objects'=> array(
	        				'id'=> 'tip 1'
	        			),
	        			'events'=> array(
	        				'xpath'=>'//body',
	        				'type'=>'mouseup',
							'area'=> array(
	        					'y'=>38,
	        					'x'=>303,
	       						'text'=>null,
	   							'width'=>96,
								'height'=>45,
								'xpath'=>'//html[1]/body[1]/div[1]/div[1]/div[1]/div[1]/h1[1]/a[1]/img[1]'
							),
	        			),
	        		),
				),
	        )
	    );
        				
        $response->setContent($adapter->serialize($content));
        
        return $response;
    }
 
    /*
     * http://127.0.0.1/playground/flow/XX-XX-YY/rest/authent/9
     */
    public function get($id)
    {
        $response = $this->getResponse();
        $contentType = 'application/json';
        $adapter = '\Zend\Serializer\Adapter\Json';
        $response->getHeaders()->addHeaderLine('Content-Type',$contentType);
        $adapter = new $adapter;
        
        $content = array('data' => 'grg2 was there');
        $response->setContent($adapter->serialize($content));
        
        return $response;
    }
 
    public function create($data)
    {
        # code...
    }
 
    public function update($id, $data)
    {
        # code...
    }
 
    public function delete($id)
    {
        # code...
    }
}
