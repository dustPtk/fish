<?php
/**
 * Created by Ptk.
 * User: hp
 * Date: 14-12-30
 * Time: 上午10:55
 */

namespace Fish\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\AdapterAwareInterface;
use Zend\Db\TableGateway\AbstractTableGateway;

class NoticeTable extends AbstractTableGateway implements AdapterAwareInterface{
    protected $table='fish_notice';

    public function setDbAdapter(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->initialize();
    }

    public function createNotice($notice_date,$notice_name,$notice_content,$notice_editor,$notice_status)
    {
        return $this->insert(array(
            'notice_name' => $notice_name,
            'notice_editor'=> $notice_editor,
            'notice_date' => $notice_date,
            'notice_content'=>$notice_content,
            'notice_status'=>$notice_status,
        ));
    }

    public function getNoticeList()
    {
        $rowSet = $this->select();
        return $rowSet;
    }

    public function getNoticeById($id)
    {
        $rowSet = $this->select(array('id'=>$id));
        return $rowSet->current();
    }

    public function deleteNoticeById($id)
    {
        return $this->delete(array('id'=>$id));
    }
}