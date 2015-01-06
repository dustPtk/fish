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
        $food_date= time();
        try{
			 $img_url_max = sprintf('public/images/%s.png',sha1(uniqid('max'.$food_date,true)));
			 $img_url_min = sprintf('public/images/%s.png',sha1(uniqid('min'.$food_date,true)));
			 $rs= $foodTable->createFood($food_date,$data['food_name'],$data['food_intro'],$data['food_img_max'],$data['food_img_min']);
			 $result = new JsonModel(array(
				 'result'=>$rs,
			 ));
        }catch(\Exception $e){
             throw new \Exception('could not',404);
        }
        return $result;
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