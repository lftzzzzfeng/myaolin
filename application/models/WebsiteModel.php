<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/8/24
 * Time: 15:53
 */
require_once dirname(__FILE__) . '/../util/Constant.php';

class WebsiteModel extends CI_Model
{
    const TABLE_WEBSITE = 'website';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    /**
     * 存储网站首页配置信息
     *
     * @param string $title 标题
     * @param string $content 内容
     * @param string $backgroundImage 背景图片
     *
     * @return int
     */
    public function saveWebsite($title, $content, $backgroundImage)
    {
        $data = [];

        if ($title) {
            $data['title'] = $title;
        }
        if ($content) {
            $data['content'] = $content;
        }
        if ($backgroundImage) {
            $data['backgroundImage'] = $backgroundImage;
        }

        $data['lastEditorId'] = $_SESSION['user']['id'];
        $data['lastEditedTimestamp'] = time();

        $this->db->where('id', 1);
        $this->db->update(self::TABLE_WEBSITE, $data);

        return true;
    }

    /**
     * 获取网站首页配置通过id
     *
     * @return array
     */
    public function getWebsiteById()
    {
        return $this->db->where(['id' => 1])->get(self::TABLE_WEBSITE)->row_array();
    }
}