<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 14-12-30
 * Time: 下午2:47
 */

namespace News\Entity;

class Img{
    protected $id;
    protected $img_name;
    protected $img_intro;
    protected $img_url_max;
    protected $img_url_min;
    protected $img_news_id;

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

    /**
     * @param mixed $img_intro
     */
    public function setImgIntro($img_intro)
    {
        $this->img_intro = $img_intro;
    }

    /**
     * @return mixed
     */
    public function getImgIntro()
    {
        return $this->img_intro;
    }

    /**
     * @param mixed $img_name
     */
    public function setImgName($img_name)
    {
        $this->img_name = $img_name;
    }

    /**
     * @return mixed
     */
    public function getImgName()
    {
        return $this->img_name;
    }

    /**
     * @param mixed $img_news_id
     */
    public function setImgNewsId($img_news_id)
    {
        $this->img_news_id = $img_news_id;
    }

    /**
     * @return mixed
     */
    public function getImgNewsId()
    {
        return $this->img_news_id;
    }

    /**
     * @param mixed $img_url_max
     */
    public function setImgUrlMax($img_url_max)
    {
        $this->img_url_max = $img_url_max;
    }

    /**
     * @return mixed
     */
    public function getImgUrlMax()
    {
        return $this->img_url_max;
    }

    /**
     * @param mixed $img_url_min
     */
    public function setImgUrlMin($img_url_min)
    {
        $this->img_url_min = $img_url_min;
    }

    /**
     * @return mixed
     */
    public function getImgUrlMin()
    {
        return $this->img_url_min;
    }

    public function setFeed($feed)
    {
        $hydrator = new ClassMethods();
        foreach ($feed as $entry) {
            if (array_key_exists('status', $entry)) {
                $this->feed[] = $hydrator->hydrate(
                    $entry, new Status()
                );
            } else if (array_key_exists('filename', $entry)) {
                $this->feed[] = $hydrator->hydrate(
                    $entry, new Image()
                );
            }
        }
    }



}
