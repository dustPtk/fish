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

class DeleteNewsController extends AbstractRestfulController{
    protected $newsTable;

    public function get($id)
    {
        $newsTable =$this->getNewsTable();
        try{
            return new JsonModel(array(
                'result'=>$newsTable->deleteNewsById($id),
            ));
        }catch (\Exception $e){
            throw new \Exception('not found',404);
        }

    }
    public function getNewsTable()
    {
        if(!$this->newsTable){
            $sm = $this->getServiceLocator();
            $this->newsTable = $sm->get('Fish\Model\NewsTable');
        }
        return $this->newsTable;
    }

}