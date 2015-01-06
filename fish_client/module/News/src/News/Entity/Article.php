<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 14-12-30
 * Time: 下午2:47
 */

namespace News\Entity;

class Article{
    protected $id;
    protected $article_name;
    protected $article_editor;
    protected $article_content;
    protected $article_date;

    /**
     * @param mixed $article_content
     */
    public function setArticleContent($article_content)
    {
        $this->article_content = $article_content;
    }

    /**
     * @return mixed
     */
    public function getArticleContent()
    {
        return $this->article_content;
    }

    /**
     * @param mixed $article_date
     */
    public function setArticleDate($article_date)
    {
        $this->article_date = $article_date;
    }

    /**
     * @return mixed
     */
    public function getArticleDate()
    {
        return $this->article_date;
    }

    /**
     * @param mixed $article_editor
     */
    public function setArticleEditor($article_editor)
    {
        $this->article_editor = $article_editor;
    }

    /**
     * @return mixed
     */
    public function getArticleEditor()
    {
        return $this->article_editor;
    }

    /**
     * @param mixed $article_name
     */
    public function setArticleName($article_name)
    {
        $this->article_name = $article_name;
    }

    /**
     * @return mixed
     */
    public function getArticleName()
    {
        return $this->article_name;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

}
