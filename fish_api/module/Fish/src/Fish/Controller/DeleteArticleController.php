<?php
/**
 * Created by ptk.
 * User: hp
 * Date: 14-12-29
 * Time: 下午3:46
 */

namespace Fish\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class DeleteArticleController extends AbstractRestfulController{
    protected $articleTable;

    public function get($id)
    {
        $articleTable =$this->getArticleTable();
        try{
            return new JsonModel(array(
                'result'=>$articleTable->deleteArticleById($id),
            ));
        }catch (\Exception $e){
            return new JsonModel(array(
                'result'=>false,
            ));
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