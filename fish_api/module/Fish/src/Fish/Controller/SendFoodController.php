<?php
/**
 * Created by Ptk.
 * User: hp
 * Date: 14-12-29
 * Time: 下午3:03
 */
namespace Fish\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class SendFoodController extends AbstractRestfulController{
    protected $FoodTable;

    public function create($data)
    {
        $foodTable = $this->getFoodTable();
        $food_date= date('Y-m-d H:i:s',time());
        try{
			 $rs= $foodTable->createFood($food_date,$data['food_name'],$data['food_intro'],$data['food_img_max'],$data['food_img_min']);
			 $result = new JsonModel(array(
				 'result'=>$rs,
			 ));
        }catch(\Exception $e){
             $result = new JsonModel(array(
                 'result'=>false
             ));
        }
        return $result;
    }

    public function getFoodTable()
    {
      if(!$this->FoodTable){
          $sm = $this->getServiceLocator();
          $this->FoodTable = $sm->get('Fish\Model\FoodTable');
      }
      return $this->FoodTable;
    }

}