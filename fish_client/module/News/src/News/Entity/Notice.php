<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 14-12-31
 * Time: 上午8:47
 */

namespace News\Entity;

class Notice{
    protected $id;
    protected $notice_name;
    protected $notice_editor;
    protected $notice_content;
    protected $notice_date;
    protected $notice_status;

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
     * @param mixed $notice_content
     */
    public function setNoticeContent($notice_content)
    {
        $this->notice_content = $notice_content;
    }

    /**
     * @return mixed
     */
    public function getNoticeContent()
    {
        return $this->notice_content;
    }

    /**
     * @param mixed $notice_date
     */
    public function setNoticeDate($notice_date)
    {
        $this->notice_date = $notice_date;
    }

    /**
     * @return mixed
     */
    public function getNoticeDate()
    {
        return $this->notice_date;
    }

    /**
     * @param mixed $notice_editor
     */
    public function setNoticeEditor($notice_editor)
    {
        $this->notice_editor = $notice_editor;
    }

    /**
     * @return mixed
     */
    public function getNoticeEditor()
    {
        return $this->notice_editor;
    }

    /**
     * @param mixed $notice_name
     */
    public function setNoticeName($notice_name)
    {
        $this->notice_name = $notice_name;
    }

    /**
     * @return mixed
     */
    public function getNoticeName()
    {
        return $this->notice_name;
    }

    /**
     * @param mixed $notice_status
     */
    public function setNoticeStatus($notice_status)
    {
        $this->notice_status = $notice_status;
    }

    /**
     * @return mixed
     */
    public function getNoticeStatus()
    {
        return $this->notice_status;
    }


}