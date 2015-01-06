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

class DeleteImgController extends AbstractRestfulController{
    protected $fishCommonTable;

    public function get($id)
    {
        $imgTable =$this->getimgTable();
        try{
            return new JsonModel(array(
                'result'=>$imgTable->deleteImgById($id),
            ));
        }catch (\Exception $e){
            throw new \Exception('not found',404);
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