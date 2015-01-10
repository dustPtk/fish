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
        $img_date= date('Y-m-d H:i:s',time());
        try{
			 $img = $imgTable->createImg($data['img_name'],$data['img_intro'],$data['img_url_max'],$data['img_url_min'],$img_date);
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
      if(!$this->fishCommonTable){
          $sm = $this->getServiceLocator();
          $this->fishCommonTable = $sm->get('Fish\Model\CommonImgTable');
      }
      return $this->fishCommonTable;
    }

}