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
