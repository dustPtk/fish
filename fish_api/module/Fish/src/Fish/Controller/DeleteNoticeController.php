<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 14-12-30
 * Time: 上午11:04
 */

namespace Fish\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class DeleteNoticeController extends AbstractRestfulController{
    protected $noticeTable;

    public function get($id)
    {
        $noticeTable = $this->getNoticeTable();
        try{
            return new JsonModel(array(
                'result'=>$noticeTable->deleteNoticeById($id),
            ));
        }catch (\Exception $e){
            return new JsonModel(array(
                'result'=>false
            ));
        }

    }

    public function getNoticeTable()
    {
        if(!$this->noticeTable){
            $sm = $this->getServiceLocator();
            $this->noticeTable = $sm->get('Fish\Model\NoticeTable');
        }
        return $this->noticeTable;
    }
}