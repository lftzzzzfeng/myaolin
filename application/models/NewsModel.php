<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/8/16
 * Time: 16:11
 */
require_once dirname(__FILE__) . '/../util/Constant.php';

class NewsModel extends CI_Model
{
    const TABLE_NEWS = 'news';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    /**
     * 存储瑶琳资讯
     *
     * @param int $id
     * @param string $title 标题
     * @param string $coverImage 封面照片
     * @param string $description 描述
     * @param string $content 内容
     * @param int $hits 点击/阅读量
     * @param int $publishedTimestamp 发布时间戳
     * @param int $isRecommended 是否推荐
     * @param int $status 状态
     *
     * @return int
     */
    public function saveNews($id, $title, $coverImage, $description, $content, $hits, $publishedTimestamp, $isRecommended, $status)
    {
        $data = [];

        if ($id) {
            $news = $this->db->where(['id' => $id, 'isDeleted' => \util\Constant::IS_DELETED_NO])->get(self::TABLE_NEWS)->row_array();
            if (!$news) {
                echo '非法参数';
                exit;
            }
        }

        $data['title'] = $title;
        if ($coverImage) {
            $data['coverImage'] = $coverImage;
        }
        if ($description) {
            $data['description'] = $description;
        }
        if ($content) {
            $data['content'] = $content;
        }
        if ($hits) {
            $data['hits'] = $hits;
        }
        $data['isRecommended'] = $isRecommended;
        $data['status'] = $status;
        $data['publishedTimestamp'] = $publishedTimestamp;

        if ($id) {
            $savedId = $id;

            $data['lastEditorId'] = $_SESSION['user']['id'];
            $data['lastEditedTimestamp'] = time();

            $this->db->where('id', intval($id));
            $this->db->update(self::TABLE_NEWS, $data);
        } else {
            $data['creatorId'] = $_SESSION['user']['id'];
            $data['createdTimestamp'] = time();

            $this->db->insert(self::TABLE_NEWS, $data);
            $savedId = $this->db->insert_id();

            if ($savedId) {
                $this->db->set('orderNumber', $savedId);
                $this->db->where('id', intval($savedId));
                $this->db->update(self::TABLE_NEWS);
            }
        }

        return $savedId;
    }

    /**
     * 获取瑶琳资讯通过id
     *
     * @param int $id
     *
     * @return array
     */
    public function getNewsById($id)
    {
        return $this->db->where(['id' => $id])->get(self::TABLE_NEWS)->row_array();
    }

    /**
     * 获取最近的瑶琳资讯
     *
     * @param int $number
     *
     * @return array
     */
    public function getLatestNews($number)
    {
        $items = $this->db->order_by('id DESC')->limit($number)->get(self::TABLE_NEWS)->result_array();

        foreach ($items as &$item) {
            $item['publishedTimestamp'] = date('Y年m月d日 H:i', $item['publishedTimestamp']);
            $item['coverImage'] = base_url() . 'ui/img/news/' . $item['id']
                . '.' . explode('.', $item['coverImage'])[1] .'?' . time();
        }
        
        return $items;
    }

    /**
     * 获取瑶琳资讯列表
     *
     * @param int $currentPageNumber
     * @param string $keyword
     * @param int $pageNumber
     *
     * @return array
     */
    public function getNews($currentPageNumber = 0, $keyword = null, $pageNumber = 10)
    {
        $result['totalPageNumber'] = 0;
        if ($currentPageNumber > 1) {
            $start = ($currentPageNumber - 1) * $pageNumber;
        } else {
            $start = 0;
        }

        $condition = '`isDeleted` = ' . \util\Constant::IS_DELETED_NO;
        $condition .= ' AND `status` = ' . \util\Constant::STATUS_ACTIVE;
        if ($keyword) {
            $keyword = urldecode($keyword);
            $condition .= ' AND (`title` LIKE "%' . $keyword . '%")';
        }

        $result['count'] = count($this->db->where($condition)->get(self::TABLE_NEWS)->result_array());
        $result['news'] = $this->db->where($condition)->order_by('orderNumber DESC')
            ->limit($pageNumber, $start)->get(self::TABLE_NEWS)->result_array();

        if ($result['count'] > 0) {
            if ($result['count'] % $pageNumber == 0) {
                $result['totalPageNumber'] = $result['count'] / $pageNumber;
            } else {
                $result['totalPageNumber'] = intval($result['count'] / $pageNumber) + 1;
            }
        }

        return $result;
    }
}
