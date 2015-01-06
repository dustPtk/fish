<?php
/**
 * Created by ptk.
 * User: hp
 * Date: 14-12-30
 * Time: 上午11:12
 */

namespace Fish\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class SendNoticeController extends AbstractRestfulController{
    protected $noticeTable;

    public function create($data)
    {
        $noticeTable = $this->getNoticeTable();
        $noticeDate = Time();

        return new JsonModel(array(
            'result'=>$noticeTable->createNotice($noticeDate,$data['notice_name'],$data['notice_content'],$data['notice_editor']),
        ));
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