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

class SendArticleController extends AbstractRestfulController{
    protected $articleTable;

    public function create($data)
    {
        $articleTable = $this->getArticleTable();
        $article_date= time();
        try{
			 $rs= $articleTable->createArticle($article_date,$data['article_name'],$data['article_editor'],$data['article_content']);
			 
			 $result = new JsonModel(array(
				 'result'=>$rs,
			 ));
        }catch(\Exception $e){
             throw new \Exception('could not',404);
        }
        return $result;
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