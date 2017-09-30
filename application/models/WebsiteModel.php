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
    const TABLE_SCENICVIEW = 'scenicview';
    const TABLE_NEWS = 'news';

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

    /**
     * 搜索
     *
     * @return array
     */
    public function searchs($search)
    {
        if($search) {
            $rst = '';
            $rst['scenicview'] = $this->db->where("isDeleted=0 and status=1 and title LIKE '%$search%'")->order_by('orderNumber ASC')->get(self::TABLE_SCENICVIEW)->result_array();
            foreach ($rst['scenicview'] as $k => &$item) {
                $img = $this->db->where('scenicViewId='.$item['id'])->order_by('id DESC')->limit(3)->get('scenicviewimage')->result_array();
                foreach ($img as $k1 => $v1){
                    $img[$k1]['image'] = $this->baseUrl . 'ui/img/scenicview/images/' . $item['id'].'_'.$v1['id']
                        . '.' . explode('.', $item['coverImage'])[1] .'?' . time();
                }
                $rst['scenicview'][$k]['img'] = $img;
                $item['coverImage'] = $this->baseUrl . 'ui/img/scenicview/coverimage/' . $item['id']
                    . '.' . explode('.', $item['coverImage'])[1] .'?' . time();
            }
            $rst['news'] = $this->db->where("isDeleted=0 and status=1 and title LIKE '%$search%'")->order_by('orderNumber ASC')->get(self::TABLE_NEWS)->result_array();
            foreach ($rst['news'] as $k => &$item) {
                $item['coverImage'] = $this->baseUrl . 'ui/img/news/' . $item['id']
                    . '.' . explode('.', $item['coverImage'])[1] .'?' . time();
            }
            return $rst;
        }
    }
}