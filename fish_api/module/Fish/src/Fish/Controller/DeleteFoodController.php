<?php
/**
 * Created by ptk.
 * User: hp
 * Date: 14-12-29
 * Time: 下午3:46
 */

namespace Fish\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class DeleteFoodController extends AbstractRestfulController{
    protected $foodTable;

    public function get($id)
    {
        $foodTable =$this->getFoodTable();
        try{
            return new JsonModel(array(
                'result'=>$foodTable->deleteFoodById($id),
            ));
        }catch (\Exception $e){
            throw new \Exception('not found',404);
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