<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 14-12-30
 * Time: 下午1:54
 */
namespace Fish\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\AdapterAwareInterface;
use Zend\Db\TableGateway\AbstractTableGateway;

class ArticleTable extends AbstractTableGateway implements AdapterAwareInterface{
    protected $table = 'fish_article';

    public function setDbAdapter(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->initialize();
    }
	
	public function getArticleList()
    {
        $rowSet = $this->select();
        return $rowSet;
    }
	
	public function createArticle($article_date,$article_name,$article_editor,$article_content)
    {
        return $this->insert(array(
            'article_name'=>$article_name,
            'article_date'=>$article_date,
            'article_editor'=>$article_editor,
            'article_content'=>$article_content,
        ));
    }
	
	public function getArticleById($id)
    {
        $rowSet = $this->select(array('id'=>$id));
        $row = $rowSet->current();
        return $row;
    }
	
	public function deleteArticleById($id)
    {
        return $this->delete(array('id'=>$id));
    }
}