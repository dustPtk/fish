<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Fish\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Stdlib\Hydrator\ClassMethods;
use News\Entity\News;
use News\Entity\Notice;
use News\Entity\Article;
use News\Entity\Food;
use News\Entity\CommonImg;
use News\Entity\Img;
use Api\Client\ApiClient as ApiClient;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $viewData = array();

        $responseNews = ApiClient::getWall();
        if ($responseNews !== FALSE) {
            foreach($responseNews as $k=>$v){
                $hydrator = new ClassMethods();
                $news[$k] = $hydrator->hydrate($v, new News());
            }
        } else {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        $responseNews1 = ApiClient::getWall();
        if ($responseNews1 !== FALSE) {
            foreach($responseNews1 as $k=>$v){
                if(array_key_exists('img',$responseNews1[$k])){
                    $hydrator = new ClassMethods();
                    $img[$k] = $hydrator->hydrate($responseNews1[$k]['img'][0], new Img());
                }
            }
        } else {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        $responseNotice = ApiClient::getNotice();
        if($responseNotice !== FALSE){
            foreach($responseNotice as $k => $v){
                $hydrator = new ClassMethods();
                $notice[$k] = $hydrator->hydrate($v,new Notice());
            }
        }else{
            $this->getResponse()->seStatusCode(404);
            return ;
        }

        $responseArticle = ApiClient::getArticle();
        if($responseArticle !== FALSE){
            foreach($responseArticle as $k => $v){
                $hydrator = new ClassMethods();
                $article[$k] = $hydrator->hydrate($v,new Article());
            }
        }else{
            $this->getResponse()->seStatusCode(404);
            return ;
        }


        $responseFood = ApiClient::getFood();
        if($responseFood !== FALSE){
            foreach($responseFood['result'] as $k => $v){
                $hydrator = new ClassMethods();
                $food[$k] = $hydrator->hydrate($v,new Food());
            }
        }else{
            $this->getResponse()->seStatusCode(404);
            return ;
        }

        $responseImg = ApiClient::getImg();
        if($responseImg !== FALSE){
            foreach($responseImg['result'] as $k => $v){
                $hydrator = new ClassMethods();
                $commonImg[$k] = $hydrator->hydrate($v,new CommonImg());
            }
        }else{
            $this->getResponse()->seStatusCOde(404);
            return ;
        }

        $viewData['newsData'] = $news;
        $viewData['noticeData'] = $notice;
        $viewData['articleData'] = $article;
        $viewData['foodData'] = $food;
        $viewData['imgData'] = $img;
        $viewData['commonImgData'] = $commonImg;
        return $viewData;
    }


}