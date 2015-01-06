<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 14-12-30
 * Time: ����9:15
 */

namespace Fish\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class ShowArticleController extends  AbstractRestfulController{
    protected $articleTable;

    public function getList()
    {
        $articleTable = $this->getArticleTable();

        $articleInfo = $articleTable->getArticleList()->toArray();

        if($articleInfo !== false){
            return new JsonModel($articleInfo);
        }else{
            throw new \Exception('could not find status',404);
        }
    }

    public function getArticleTable()
    {
        if(!$this->articleTable){
            $sm = $this->getServiceLocator();
            $this->articleTable = $sm->get('Fish\Model\ArticleTable');
        }
        return $this->articleTable;
    }
}