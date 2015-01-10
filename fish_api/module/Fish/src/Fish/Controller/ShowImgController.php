<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 14-12-30
 * Time: 上午11:24
 */

namespace Fish\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class ShowImgController extends AbstractRestfulController{
    protected $imgTable;

    public function getList()
    {
        $imgTable = $this->getImgTable();
        $imgInfo= $imgTable->getImgList()->toArray();
        if($imgInfo !== false ){
            return new JsonModel(array(
                'result'=>$imgInfo
            ));
        }else{
            return new JsonModel(array(
                'result'=>false
            ));
        }

    }

    public function getImgTable()
    {
        if(!$this->imgTable){
            $sm = $this->getServiceLocator();
            $this->imgTable = $sm->get('Fish\Model\CommonImgTable');
        }
        return $this->imgTable;
    }
}