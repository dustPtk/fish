<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 14-12-30
 * Time: ����9:15
 */

namespace Fish\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class ShowFoodController extends  AbstractRestfulController{
    protected $foodTable;

    public function getList()
    {
        $foodTable = $this->getFoodTable();

        $foodInfo = $foodTable->getFoodList()->toArray();
        if($foodInfo !== false){
            return new JsonModel($foodInfo);
        }else{
            throw new \Exception('could not find status',404);
        }
    }

    public function getFoodTable()
    {
        if(!$this->foodTable){
            $sm = $this->getServiceLocator();
            $this->foodTable = $sm->get('Fish\Model\FoodTable');
        }
        return $this->foodTable;
    }
}