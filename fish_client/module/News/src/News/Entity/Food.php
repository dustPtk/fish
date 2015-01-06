<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 14-12-30
 * Time: 下午2:47
 */

namespace News\Entity;

class Food{
    protected $id;
    protected $food_name;
    protected $food_intro;
    protected $food_img_max;
    protected $food_img_min;
    protected $food_date;

    /**
     * @param mixed $food_date
     */
    public function setFoodDate($food_date)
    {
        $this->food_date = $food_date;
    }

    /**
     * @return mixed
     */
    public function getFoodDate()
    {
        return $this->food_date;
    }

    /**
     * @param mixed $food_img_max
     */
    public function setFoodImgMax($food_img_max)
    {
        $this->food_img_max = $food_img_max;
    }

    /**
     * @return mixed
     */
    public function getFoodImgMax()
    {
        return $this->food_img_max;
    }

    /**
     * @param mixed $food_img_min
     */
    public function setFoodImgMin($food_img_min)
    {
        $this->food_img_min = $food_img_min;
    }

    /**
     * @return mixed
     */
    public function getFoodImgMin()
    {
        return $this->food_img_min;
    }

    /**
     * @param mixed $food_intro
     */
    public function setFoodIntro($food_intro)
    {
        $this->food_intro = $food_intro;
    }

    /**
     * @return mixed
     */
    public function getFoodIntro()
    {
        return $this->food_intro;
    }

    /**
     * @param mixed $food_name
     */
    public function setFoodName($food_name)
    {
        $this->food_name = $food_name;
    }

    /**
     * @return mixed
     */
    public function getFoodName()
    {
        return $this->food_name;
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