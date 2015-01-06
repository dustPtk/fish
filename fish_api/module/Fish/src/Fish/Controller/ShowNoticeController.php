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

class ShowNoticeController extends AbstractRestfulController{
    protected $noticeTable;

    public function getList()
    {
        $noticeTable = $this->getNoticeTable();
        $noticeInfo= $noticeTable->getNoticeList()->toArray();
        return new JsonModel($noticeInfo);
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