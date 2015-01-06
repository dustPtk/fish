<?php
/**
 * Created by Ptk.
 * User: hp
 * Date: 14-12-29
 * Time: 下午3:03
 */
namespace Fish\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class SendImgController extends AbstractRestfulController{
    protected $fishCommonTable;

    public function create($data)
    {
        $imgTable = $this->getImgTable();
        $img_date= time();
        try{
			 $img_url_max = sprintf('public/images/%s.png',sha1(uniqid('max'.$img_date,true)));
			 $img_url_min = sprintf('public/images/%s.png',sha1(uniqid('min'.$img_date,true)));
			 $img = $imgTable->createImg($data['img_name'],$data['img_intro'],$img_url_max,$img_url_min,$img_date);
			 
			 $result = new JsonModel(array(
				 'result'=>$img,
			 ));
        }catch(\Exception $e){
             throw new \Exception('could not',404);
        }
        return $result;
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