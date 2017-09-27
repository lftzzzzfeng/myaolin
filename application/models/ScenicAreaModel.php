<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/8/17
 * Time: 15:26
 */
require_once dirname(__FILE__) . '/../util/Constant.php';

class ScenicAreaModel extends CI_Model
{
    const TABLE_SCENIC_AREA = 'scenicarea';
    const TABLE_SCENIC_AREA_IMG = 'scenicareaimage';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('scenicAreaImageModel');
        $this->load->library('session');
    }

    /**
     * 存储景区介绍
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
    public function saveScenicArea($id, $title, $coverImage, $description, $isRecommended, $status)
    {
        $data = [];

        if ($id) {
            $scenicArea = $this->db->where(['id' => $id, 'isDeleted' => \util\Constant::IS_DELETED_NO])->get(self::TABLE_SCENIC_AREA)->row_array();
            if (!$scenicArea) {
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
            $this->db->update(self::TABLE_SCENIC_AREA, $data);
        } else {
            $data['creatorId'] = $_SESSION['user']['id'];
            $data['createdTimestamp'] = time();

            $this->db->insert(self::TABLE_SCENIC_AREA, $data);
            $savedId = $this->db->insert_id();

            if ($savedId) {
                $this->db->set('orderNumber', $savedId);
                $this->db->where('id', intval($savedId));
                $this->db->update(self::TABLE_SCENIC_AREA);
            }
        }

        return $savedId;
    }

    /**
     * 获取详细景区介绍通过id
     *
     * @param int $id
     * @param int $isRecommended
     *
     * @return array
     */
    public function getDetailScenicAreaById($id, $isRecommended = 0) {
        if ($id) {
            $condition['id'] = intval($id);
        }
        $condition['status'] = \util\Constant::STATUS_ACTIVE;
        if ($isRecommended == \util\Constant::IS_RECOMMENDED_YES) {
            $condition['isRecommended'] = \util\Constant::IS_RECOMMENDED_YES;
        }

        $result['scenicArea'] = $this->db->select('id, title, description, coverImage')->where($condition)->order_by('id DESC')->get(self::TABLE_SCENIC_AREA)->row_array();
        if ($result['scenicArea']) {
            $result['scenicArea']['coverImage'] = $this->baseUrl . 'ui/img/scenicarea/coverimage/' . $result['scenicArea']['id']
                . '.' . explode('.', $result['scenicArea']['coverImage'])[1] .'?' . time();

            $result['scenicAreaImages'] = $this->scenicAreaImageModel->getScenicAreaImages($result['scenicArea']['id']);
            if (count($result['scenicAreaImages']) > 0) {
                foreach ($result['scenicAreaImages'] as &$scenicAreaImage) {
                    $scenicAreaImage['image'] = $this->baseUrl . 'ui/img/scenicarea/images/' . $result['scenicArea']['id']
                        . '_' . $scenicAreaImage['id'] . '.' . explode('.', $scenicAreaImage['image'])[1] .'?' . time();
                }
            }
        }

        return $result;
    }

    /**
     * 获取景区介绍通过id
     *
     * @param int $id
     *
     * @return array
     */
    public function getScenicAreaById($id) {
        return $this->db->where(['id' => $id])->get(self::TABLE_SCENIC_AREA)->row_array();
    }

    /**
     * 获取景区介绍列表
     *
     * @param int $currentPageNumber
     * @param string $keyword
     * @param int $pageNumber
     *
     * @return array
     */
    public function getScenicAreas($currentPageNumber = 0, $keyword = null, $pageNumber = 10) {
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

        $result['count'] = count($this->db->where($condition)->get(self::TABLE_SCENIC_AREA)->result_array());
        $result['scenicAreas'] = $this->db->where($condition)->order_by('orderNumber DESC')
            ->limit($pageNumber, $start)->get(self::TABLE_SCENIC_AREA)->result_array();

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
     * 获取景区介绍列表
     *
     * @param int $currentPageNumber
     * @param string $keyword
     * @param int $pageNumber
     * const TABLE_SCENIC_AREA_IMG = 'scenicareaimage';
     * @return array
     */
    public function getScenicAreasM($currentPageNumber = 0, $keyword = null, $pageNumber = 10) {
        $result['totalPageNumber'] = 0;
        if ($currentPageNumber > 1) {
            $start = $currentPageNumber * $pageNumber;
        } else {
            $start = 0;
        }

        $condition = '`isDeleted` = ' . \util\Constant::IS_DELETED_NO;
        $condition .= ' AND `status` = ' . \util\Constant::STATUS_ACTIVE;
        if ($keyword) {
            $keyword = urldecode($keyword);
            $condition .= ' AND (`title` LIKE "%' . $keyword . '%")';
        }

        $result['count'] = count($this->db->where($condition)->get(self::TABLE_SCENIC_AREA)->result_array());
        $result['scenicAreas'] = $this->db->where($condition)->order_by('orderNumber DESC')
            ->limit($pageNumber, $start)->get(self::TABLE_SCENIC_AREA)->result_array();
        foreach ($result['scenicAreas'] as $k => &$item) {
            $item['num'] = count($this->db->where('scenicAreaId='.$item['id'])->get(self::TABLE_SCENIC_AREA_IMG)->result_array());
            $item['coverImage'] = $this->baseUrl . 'ui/img/scenicArea/coverimage/' . $item['id']
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
