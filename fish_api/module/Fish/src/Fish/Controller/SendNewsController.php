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

class SendNewsController extends AbstractRestfulController{
    protected $newsTable;
    protected $imgTable;

    public function create($data)
    {
        $newsTable = $this->getNewsTable();
        $news_date= date('Y-m-d H:i:s',time());
        try{
              if(array_key_exists('img',$data))
             {
                 $rs= $newsTable->createNews($news_date,$data['news_name'],$data['news_editor'],$data['news_content']);
                 $news = $newsTable->getNewsByName($data['news_name']);
                 $imgTable = $this->getImgTable();
                 //$img_url_max = sprintf('public/images/%s.png',sha1(uniqid('max'.$news_date,true)));
                 //$img_url_max = sprintf('data/tmp/%s',sha1(uniqid($news_date, true)));
                 //$img_url_min = sprintf('public/images/%s.png',sha1(uniqid('min'.$news_date,true)));
                 $img = $imgTable->createImg($data['img_max'],$data['img_min'],$news['id']);
//                 foreach($data as $v){
//                    $temp = array(
//                        'img_news_id'=>$news['id']
//                    );
//                    $img_url_max = sprintf('public/images/%s.png',sha1(uniqid('max'.$news_date,true)));
//                    $img_url_min = sprintf('public/images/%s.png',sha1(uniqid('min'.$news_date,true)));
//                    $content = base64_decode($v[]['max_img']);
//                    $content1 = base64_decode($v[]['min_img']);
//                    $image = imagecreatefromstring($content);
//                    $image1 = imagecreatefromstring($content1);
//                    $result = new JsonModel(array(
//                        'result'=>$imgTable->createImg('adsfdasfasdf','sdafadsfas',$news['id'])
//                    ));
//                    imagedestroy($image);
//                    imagedestroy($image1);
//                    }
                 $result = new JsonModel(array(
                     'result'=>$rs,
                     'result1'=>$img,
                 ));

            }else{
                 $result = new JsonModel(array(
                     'result'=>'not'
                 ));
             }
        }catch(\Exception $e){
             throw new \Exception('could not',404);
        }
        return $result;
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