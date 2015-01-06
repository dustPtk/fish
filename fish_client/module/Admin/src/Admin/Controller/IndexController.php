<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Admin\Controller;

use Admin\Form\AddNewsForm;
use Admin\Form\AddNoticeForm;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Stdlib\Hydrator\ClassMethods;
use News\Entity\News;
use News\Entity\Notice;
use News\Entity\Article;
use News\Entity\Food;
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

        $responseNotice = ApiClient::getNotice();
        if($responseNotice !== FALSE){
            foreach($responseNotice as $k => $v){
                $hydrator = new ClassMethods();
                $notice[$k] = $hydrator->hydrate($v,new Notice());
            }
        }else{
            $this->getResponse()->seStatusCOde(404);
            return ;
        }

        $responseArticle = ApiClient::getArticle();
        if($responseArticle !== FALSE){
            foreach($responseArticle as $k => $v){
                $hydrator = new ClassMethods();
                $article[$k] = $hydrator->hydrate($v,new Article());
            }
        }else{
            $this->getResponse()->seStatusCOde(404);
            return ;
        }


        $responseFood = ApiClient::getFood();
        if($responseFood !== FALSE){
            foreach($responseFood as $k => $v){
                $hydrator = new ClassMethods();
                $food[$k] = $hydrator->hydrate($v,new Food());
            }
        }else{
            $this->getResponse()->seStatusCOde(404);
            return ;
        }


        $responseImg = ApiClient::getImg();
        if($responseImg !== FALSE){
            foreach($responseImg as $k => $v){
                $hydrator = new ClassMethods();
                $img[$k] = $hydrator->hydrate($v,new Img());
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
        return $viewData;
    }

    public function addAction()
    {

        $form = new AddNewsForm();
        $form->get('submit')->setValue('Add');
        $request = $this->getRequest();
        if($request->isPost()){
            $news = new News();
            $form->setData($request->getPost());
            if($form->isValid()){
                $data_temp = $form->getData();

                $news->setNewsContent($data_temp['content']);
                $news->setNewsDate($data_temp['date']);
                $news->setNewsEditor($data_temp['editor']);
                $news->setNewsName($data_temp['name']);
                $news->setNewsStatus($data_temp['status']);

                $data= array(
                    'news_name' =>$news->getNewsName(),
                    'news_content' =>$news->getNewsContent(),
                    'news_date'=>$news->getNewsDate(),
                    'news_editor'=>$news->getNewsEditor(),
                    'news_status' =>$news->getNewsStatus(),
                    'img'=>$data_temp['img']
                );
                $responseNewsCre = ApiClient::createNews($data);

                return $this->redirect()->toRoute('fish');
            }
        }
        return array('form'=>$form);
    }
    public function addNoticeAction()
    {

        $form = new AddNoticeForm();
        $form->get('submit')->setValue('AddNotice');
        $request = $this->getRequest();
        if($request->isPost()){
            $notice = new Notice();
            $form->setData($request->getPost());
            if($form->isValid()){
                $data_temp = $form->getData();

                $notice->setNoticeContent($data_temp['content']);
                $notice->setNoticeDate($data_temp['date']);
                $notice->setNoticeEditor($data_temp['editor']);
                $notice->setNoticeName($data_temp['name']);
                $notice->setNoticeStatus($data_temp['status']);

                $data= array(
                    'notice_name' =>$notice->getNoticeName(),
                    'notice_content' =>$notice->getNoticeContent(),
                    'notice_date'=>$notice->getNoticeDate(),
                    'notice_editor'=>$notice->getNoticeEditor(),
                    'notice_status' =>$notice->getNoticeStatus(),
                );
                $responseNewsCre = ApiClient::createNotice($data);

                return $this->redirect()->toRoute('fish');
            }
        }
        return array('form'=>$form);
    }


}