<?php
/**
 * Created by ptk.
 * User: hp
 * Date: 14-12-29
 * Time: 下午3:04
 */

namespace Fish\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\AdapterAwareInterface;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;

class ImgTable extends AbstractTableGateway implements AdapterAwareInterface{
    protected $table='fish_img';

    public function setDbAdapter(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->initialize();
    }

    public function getImgById($id)
    {
        $result = $this->select(array('id'=>$id));
        return $result;
    }

    public function getImgByNewsId($id)
    {
        $result =$this->select(array('img_news_id'=>$id));
        return $result;
    }

    public function createImg($img_url_max,$img_url_min,$img_news_id)
    {
        return $this->insert(array(
            'img_url_max'=>$img_url_max,
            'img_url_min'=>$img_url_min,
            'img_news_id'=>$img_news_id
        ));
    }

    public function deleteImgById($id)
    {
        return $this->delete(array('id'=>$id));
    }
}