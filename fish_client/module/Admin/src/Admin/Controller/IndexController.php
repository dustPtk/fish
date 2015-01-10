<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Admin\Controller;

use Admin\Form\AddCommonImgForm;
use Admin\Form\AddFoodForm;
use Admin\Form\AddArticleForm;
use Admin\Form\AddNoticeForm;
use Admin\Form\AddNewsForm;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Stdlib\Hydrator\ClassMethods;
use News\Entity\News;
use News\Entity\Notice;
use News\Entity\Article;
use News\Entity\Food;
use News\Entity\CommonImg;
use News\Entity\Img;
use Api\Client\ApiClient as ApiClient;
use Zend\Validator\File\Size;
use Zend\Validator\File\IsImage;
use Zend\File\Transfer\Adapter\Http;

class IndexController extends AbstractActionController
{public function indexAction()
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

    public function addAction()
    {
        $form = new AddNewsForm();
        $form->get('submit')->setValue('Add');
        $request = $this->getRequest();
        if ($request->isPost()) {

            $data = $request->getPost()->toArray();

            if (!empty($request->getFiles()->img)) {
                $data = array_merge_recursive(
                    $data,
                    $request->getFiles()->toArray()
                );
                $result = $this->createImage($form,$data);
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
            $data = $request->getPost()->toArray();
            $responseNewsCre = ApiClient::createNotice($data);
            return $this->redirect()->toRoute('admin');
        }
        return array('form'=>$form);
    }
    public function addArticleAction()
    {
        $form = new AddArticleForm();
        $form->get('submit')->setValue('addArticle');
        $request = $this->getRequest();
        if($request->isPost()){
            $data = $request->getPost()->toArray();
            $responseArticleCre = ApiClient::createArticle($data);
            return $this->redirect()->toRoute('admin');
        }
        return array('form'=>$form);
    }

    public function addFoodAction()
    {

        $form = new AddFoodForm();
        $form->get('submit')->setValue('AddFood');
        $request = $this->getRequest();
        if ($request->isPost()) {

            $data = $request->getPost()->toArray();

            if (!empty($request->getFiles()->img)) {
                $data = array_merge_recursive(
                    $data,
                    $request->getFiles()->toArray()
                );
                $result = $this->createFoodImage($form,$data);
            }

        }
        return array('form'=>$form);
    }

    public function addCommonImgAction()
    {

        $form = new AddCommonImgForm();
        $form->get('submit')->setValue('AddCommonImg');
        $request = $this->getRequest();
        if ($request->isPost()) {

            $data = $request->getPost()->toArray();

            if (!empty($request->getFiles()->img)) {
                $data = array_merge_recursive(
                    $data,
                    $request->getFiles()->toArray()
                );
                $result = $this->createCommonImage($form,$data);
            }

        }
        return array('form'=>$form);
    }

    protected function createImage($form,$data)
    {
        $form->setData($data);

        $size = new Size(array('max' => 2048000));
        $isImage = new IsImage();
        $filename = $data['img']['name'];

        $adapter = new Http();
        $adapter->setValidators(array($size, $isImage), $filename);

            $destPath = 'public/images/upload/';

            $fileinfo = $adapter->getFileInfo();
            preg_match('/.+\/(.+)/', $fileinfo['img']['type'], $matches);
            $extension = $matches[1];
            $newFilename = sprintf('%s.%s', sha1(uniqid(time(), true)), $extension);

            $adapter->addFilter('File\Rename',
                array(
                    'target' => $destPath . $newFilename,
                    'overwrite' => true,
                )
            );

            if ($adapter->receive($filename)) {
                $data['img_max']= $destPath . $newFilename;
                $data['img_min']= $destPath . $newFilename;
                $responseNewsCre = ApiClient::createNews($data);
                return $this->redirect()->toRoute('admin');
            }

        return $form;
    }

    protected function createFoodImage($form,$data)
    {
        $form->setData($data);

        $size = new Size(array('max' => 2048000));
        $isImage = new IsImage();
        $filename = $data['img']['name'];

        $adapter = new Http();
        $adapter->setValidators(array($size, $isImage), $filename);

        $destPath = 'public/images/food/';

        $fileinfo = $adapter->getFileInfo();
        preg_match('/.+\/(.+)/', $fileinfo['img']['type'], $matches);
        $extension = $matches[1];
        $newFilename = sprintf('%s.%s', sha1(uniqid(time(), true)), $extension);

        $adapter->addFilter('File\Rename',
            array(
                'target' => $destPath . $newFilename,
                'overwrite' => true,
            )
        );

        if ($adapter->receive($filename)) {
            $data['food_img_max']= $destPath . $newFilename;
            $data['food_img_min']= $destPath . $newFilename;
            $responseFoodCre = ApiClient::createFood($data);
            return $this->redirect()->toRoute('admin');
        }

        return $form;
    }

    protected function createCommonImage($form,$data)
    {
        $form->setData($data);

        $size = new Size(array('max' => 2048000));
        $isImage = new IsImage();
        $filename = $data['img']['name'];

        $adapter = new Http();
        $adapter->setValidators(array($size, $isImage), $filename);

        $destPath = 'public/images/commonImg/';

        $fileinfo = $adapter->getFileInfo();
        preg_match('/.+\/(.+)/', $fileinfo['img']['type'], $matches);
        $extension = $matches[1];
        $newFilename = sprintf('%s.%s', sha1(uniqid(time(), true)), $extension);

        $adapter->addFilter('File\Rename',
            array(
                'target' => $destPath . $newFilename,
                'overwrite' => true,
            )
        );

        if ($adapter->receive($filename)) {
            $data['img_url_max']= $destPath . $newFilename;
            $data['img_url_min']= $destPath . $newFilename;
            $responseImgCre = ApiClient::createImg($data);
            return $this->redirect()->toRoute('admin');
        }

        return $form;
    }


}