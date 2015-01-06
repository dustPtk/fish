<?php
/**
 * Created by ptk.
 * User: hp
 * Date: 14-12-29
 * Time: 下午3:03
 */
namespace Fish\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\AdapterAwareInterface;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\InputFilter\Factory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;

class NewsTable extends AbstractTableGateway implements AdapterAwareInterface{
    protected $table = 'fish_news';

    public function setDbAdapter(Adapter $adapter){
        $this->adapter = $adapter;
        $this->initialize();
    }

    public function createNews($news_date,$news_name,$news_editor,$news_content)
    {
        return $this->insert(array(
            'news_name'=>$news_name,
            'news_date'=>$news_date,
            'news_editor'=>$news_editor,
            'news_content'=>$news_content,
            'news_status'=>0,
        ));
    }

    public function getNewsList()
    {
        $rowSet = $this->select(array('news_status'=>1));
        return $rowSet;
    }

    public function getNewsById($id)
    {
        $rowSet = $this->select(array('id'=>$id));
        $row = $rowSet->current();
        return $row;
    }

    public function getNewsByName($name)
    {
        $rowSet = $this->select(array('news_name'=>$name));
        return $rowSet->current();
    }

    public function deleteNewsById($id)
    {
        return $this->delete(array('id'=>$id));
    }

}