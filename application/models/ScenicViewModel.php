<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/8/17
 * Time: 14:14
 */
require_once dirname(__FILE__) . '/../util/Constant.php';

class ScenicViewModel extends CI_Model
{
    const TABLE_SCENIC_VIEW = 'scenicview';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('scenicViewImageModel');
        $this->load->library('session');
    }

    /**
     * 存储景点介绍
     *
     * @param int $id
     * @param string $title 标题
     * @param string $coverImage 封面照片
     * @param string $description 描述
     * @param int $isRecommended 是否推荐
     * @param int $status 状态
     *
     * @return int
     */
    public function saveScenicView($id, $title, $coverImage, $description, $isRecommended, $status)
    {
        $data = [];

        if ($id) {
            $scenicView = $this->db->where(['id' => $id, 'isDeleted' => \util\Constant::IS_DELETED_NO])->get(self::TABLE_SCENIC_VIEW)->row_array();
            if (!$scenicView) {
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
        $data['isRecommended'] = $isRecommended;
        $data['status'] = $status;

        if ($id) {
            $savedId = $id;

            $data['lastEditorId'] = $_SESSION['user']['id'];
            $data['lastEditedTimestamp'] = time();

            $this->db->where('id', intval($id));
            $this->db->update(self::TABLE_SCENIC_VIEW, $data);
        } else {
            $data['creatorId'] = $_SESSION['user']['id'];
            $data['createdTimestamp'] = time();

            $this->db->insert(self::TABLE_SCENIC_VIEW, $data);
            $savedId = $this->db->insert_id();

            if ($savedId) {
                $this->db->set('orderNumber', $savedId);
                $this->db->where('id', intval($savedId));
                $this->db->update(self::TABLE_SCENIC_VIEW);
            }
        }

        return $savedId;
    }

    /**
     * 获取详细景点介绍通过id
     *
     * @param int $id
     * @param int $isRecommended
     *
     * @return array
     */
    public function getDetailScenicViewById($id, $isRecommended = 0) {
        if ($id) {
            $condition['id'] = intval($id);
        }
        $condition['status'] = \util\Constant::STATUS_ACTIVE;
        if ($isRecommended == \util\Constant::IS_RECOMMENDED_YES) {
            $condition['isRecommended'] = \util\Constant::IS_RECOMMENDED_YES;
        }

        $result['scenicView'] = $this->db->select('id, title, description, coverImage')->where($condition)->order_by('id DESC')->get(self::TABLE_SCENIC_VIEW)->row_array();
        $result['scenicView']['coverImage'] = $this->baseUrl . 'ui/img/scenicview/coverimage/' . $result['scenicView']['id']
            . '.' . explode('.', $result['scenicView']['coverImage'])[1] .'?' . time();

        $result['scenicViewImages'] = $this->scenicViewImageModel->getScenicViewImages($result['scenicView']['id']);
        if (count($result['scenicViewImages']) > 0) {
            foreach ($result['scenicViewImages'] as &$scenicViewImage) {
                $scenicViewImage['image'] = $this->baseUrl . 'ui/img/scenicview/images/' . $result['scenicView']['id']
                    . '_' . $scenicViewImage['id'] . '.' . explode('.', $scenicViewImage['image'])[1] .'?' . time();
            }
        }

        return $result;
    }

    /**
     * 获取推荐景点介绍
     *
     * @param int $number
     *
     * @return array
     */
    public function getCertainNumberScenicViews($number) {
        $items = $this->db->order_by('isRecommended DESC, id DESC')->limit(6)->get(self::TABLE_SCENIC_VIEW)->result_array();

        foreach ($items as &$item) {
            $item['coverImage'] = $this->baseUrl . 'ui/img/scenicview/coverimage/' . $item['id']
                . '.' . explode('.', $item['coverImage'])[1] .'?' . time();
        }

        return $items;
    }

    /**
     * 获取景点介绍通过id
     *
     * @param int $id
     *
     * @return array
     */
    public function getScenicViewById($id) {
        return $this->db->where(['id' => $id])->get(self::TABLE_SCENIC_VIEW)->row_array();
    }

    /**
     * 获取景点介绍列表
     *
     * @param int $currentPageNumber
     * @param string $keyword
     * @param int $pageNumber
     *
     * @return array
     */
    public function getScenicViews($currentPageNumber = 0, $keyword = null, $pageNumber = 10) {
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

        $result['count'] = count($this->db->where($condition)->get(self::TABLE_SCENIC_VIEW)->result_array());
        $result['scenicViews'] = $this->db->where($condition)->order_by('orderNumber DESC')
            ->limit($pageNumber, $start)->get(self::TABLE_SCENIC_VIEW)->result_array();

        if ($result['count'] > 0) {
            if ($result['count'] % $pageNumber == 0) {
                $result['totalPageNumber'] = $result['count'] / $pageNumber;
            } else {
                $result['totalPageNumber'] = intval($result['count'] / $pageNumber) + 1;
            }
        }

        return $result;
    }
    
    /**
     * 移动端
     * 获取景点介绍列表
     *
     * @param int $currentPageNumber
     * @param string $keyword
     * @param int $pageNumber
     *
     * @return array
     */
    public function getScenicViewsM($currentPageNumber = 0, $keyword = null, $pageNumber = 10) {
        $result['totalPageNumber'] = 0;
        if ($currentPageNumber > 1) {
            $start = ($currentPageNumber) * $pageNumber;
        } else {
            $start = 0;
        }

        $condition = '`isDeleted` = ' . \util\Constant::IS_DELETED_NO;
        $condition .= ' AND `status` = ' . \util\Constant::STATUS_ACTIVE;
        if ($keyword) {
            $keyword = urldecode($keyword);
            $condition .= ' AND (`title` LIKE "%' . $keyword . '%")';
        }

        $result['count'] = count($this->db->where($condition)->get(self::TABLE_SCENIC_VIEW)->result_array());
        $result['scenicViews'] = $this->db->where($condition)->order_by('orderNumber DESC')
            ->limit($pageNumber, $start)->get(self::TABLE_SCENIC_VIEW)->result_array();
        foreach ($result['scenicViews'] as $k => &$item) {
            $img = $this->db->where('scenicViewId='.$item['id'])->order_by('id DESC')->limit(3)->get('scenicviewimage')->result_array();
            foreach ($img as $k1 => $v1){
                $img[$k1]['image'] = $this->baseUrl . 'ui/img/scenicview/images/' . $item['id'].'_'.$v1['id']
                . '.' . explode('.', $item['coverImage'])[1] .'?' . time();
            }
            $result['scenicViews'][$k]['img'] = $img;
            $item['coverImage'] = $this->baseUrl . 'ui/img/scenicview/coverimage/' . $item['id']
                . '.' . explode('.', $item['coverImage'])[1] .'?' . time();
        }
        
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
