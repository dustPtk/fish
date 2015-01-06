<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 14-12-30
 * Time: 下午2:47
 */

namespace News\Entity;

class News{
    protected $id;
    protected $news_name;
    protected $news_editor;
    protected $news_content;
    protected $news_date;
    protected $news_status;

    public function setId($id)
    {
        $this->id = (int)$id;
    }

    public function setNewsName($news_name)
    {
        $this->news_name = $news_name;
    }

    public function setNewsEditor($news_editor)
    {
        $this->news_editor = $news_editor;
    }

    public function setNewsContent($news_content)
    {
        $this->news_content = $news_content;
    }

    public function setNewsDate($news_date)
    {
        $this->news_date = $news_date;
    }

    public function setNewsStatus($news_status)
    {
        $this->news_status = $news_status;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNewsName()
    {
        return $this->news_name;
    }

    public function getNewsContent()
    {
        return $this->news_content;
    }

    public function getNewsEditor()
    {
        return $this->news_editor;
    }

    public function getNewsStatus()
    {
        return $this->news_status;
    }

    public function getNewsDate()
    {
        return $this->news_date;
    }
}
