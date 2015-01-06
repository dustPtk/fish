<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 14-12-30
 * Time: 下午1:59
 */

namespace Fish\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\AdapterAwareInterface;
use Zend\Db\TableGateway\AbstractTableGateway;

class CommonImgTable extends AbstractTableGateway implements AdapterAwareInterface{
    protected $table = 'fish_common_img';

    public function setDbAdapter(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->initialize();
    }
	
	
	public function getImgList()
    {
        $rowSet = $this->select();
        return $rowSet;
    }
	
	public function createImg($img_name,$img_intro,$img_url_max,$img_url_min,$img_date)
    {
        return $this->insert(array(
            'img_name'=>$img_name,
            'img_date'=>$img_date,
            'img_intro'=>$img_intro,
            'img_url_max'=>$img_url_max,
			'img_url_min'=>$img_url_min,
        ));
    }
	
	public function getImgById($id)
    {
        $rowSet = $this->select(array('id'=>$id));
        $row = $rowSet->current();
        return $row;
    }
	
	public function deleteImgById($id)
    {
        return $this->delete(array('id'=>$id));
    }
}