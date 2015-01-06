<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 14-12-30
 * Time: 上午9:15
 */

namespace Fish\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class ShowNewsController extends  AbstractRestfulController{
    protected $newsTable;
    protected $imgTable;

    public function getList()
    {
        $newsTable = $this->getNewsTable();
        $imgTable  = $this->getImgTable();

        $newsInfo = $newsTable->getNewsList()->toArray();

        foreach($newsInfo as $v){
            $imgInfo = $imgTable->getImgByNewsId($v['id'])->toArray();
            if(count($imgInfo>0)){
                $v['img'] = $imgInfo;
            }
        }

        if($newsInfo !== false){
            return new JsonModel($newsInfo);
        }else{
            throw new \Exception('could not find status',404);
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

    public function getImgTable()
    {
        if(!$this->imgTable){
            $sm = $this->getServiceLocator();
            $this->imgTable = $sm->get('Fish\Model\ImgTable');
        }
        return $this->imgTable;
    }
}