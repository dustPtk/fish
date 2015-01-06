<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 14-12-30
 * Time: 下午1:57
 */

namespace Fish\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\AdapterAwareInterface;
use Zend\Db\TableGateway\AbstractTableGateway;

class FoodTable extends AbstractTableGateway implements AdapterAwareInterface{
    protected $table = 'fish_food';

    public function setDbAdapter(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->initialize();
    }
	
	
	public function getFoodList()
    {
        $rowSet = $this->select();
        return $rowSet;
    }
	
	public function createFood($food_date,$food_name,$food_intro,$food_img_max,$food_img_min)
    {
        return $this->insert(array(
            'food_name'=>$food_name,
            'food_date'=>$food_date,
            'food_intro'=>$food_intro,
            'food_url_max'=>$food_img_max,
			'food_url_min'=>$food_img_min,
        ));
    }
	
	public function getFoodById($id)
    {
        $rowSet = $this->select(array('id'=>$id));
        $row = $rowSet->current();
        return $row;
    }
	
	public function deleteFoodById($id)
    {
        return $this->delete(array('id'=>$id));
    }
}