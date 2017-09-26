<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/8/23
 * Time: 14:35
 */
require_once dirname(__FILE__) . '/../util/Constant.php';
require_once dirname(__FILE__) . '/../util/TimeTool.php';

class JottingModel extends CI_Model
{
    const TABLE_JOTTING = 'jotting';

    const TYPE_MEMBER = 1;
    const TYPE_ADMINISTRATOR = 2;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    /**
     * 存储游记
     *
     * @param int $id
     * @param string $title 标题
     * @param string $content 内容
     * @param int $status 状态
     * @param int $type 用户类型
     *
     * @return int
     */
    public function saveJotting($id, $title, $content, $status = null, $type = 1)
    {
        $data = [];

        if ($id) {
            $jotting = $this->db->where(['id' => $id, 'isDeleted' => \util\Constant::IS_DELETED_NO])->get(self::TABLE_JOTTING)->row_array();
            if (!$jotting) {
                echo '非法参数';
                exit;
            }
        }

        if ($title) {
            $data['title'] = $title;
        }
        if ($content) {
            $data['content'] = $content;
        }
        $data['status'] = $status ? $status : \util\Constant::STATUS_ACTIVE;

        if ($id) {
            $savedId = $id;

            if ($type == self::TYPE_MEMBER) {
                $data['lastEditorId'] = $_SESSION['member']['id'];
            } else if ($type == self::TYPE_ADMINISTRATOR) {
                $data['lastEditorId'] = $_SESSION['user']['id'];
            }

            $data['lastEditedTimestamp'] = time();

            $this->db->where('id', intval($id));
            $this->db->update(self::TABLE_JOTTING, $data);
        } else {
//            $data['memberId'] = $_SESSION['member']['id'] ? $_SESSION['member']['id'] : 2;
            $data['memberId'] = 2;
//            $data['creatorId'] = $_SESSION['member']['id'] ? $_SESSION['member']['id'] : 2;
            $data['creatorId'] = 2;
            $data['createdTimestamp'] = time();

            $this->db->insert(self::TABLE_JOTTING, $data);
            $savedId = $this->db->insert_id();
        }

        return $savedId;
    }

    /**
     * 更新点击量
     *
     * @param int $jottingId
     */
    public function updateHits($jottingId)
    {
        $this->db->where('id', intval($jottingId));
        $this->db->set('hits', '`hits`+ 1', false);
        $this->db->update(self::TABLE_JOTTING);
    }

    /**
     * 获取游记通过id
     *
     * @param int $id
     *
     * @return array
     */
    public function getJottingById($id) {
        return $this->db->where(['id' => $id])->get(self::TABLE_JOTTING)->row_array();
    }

    /**
     * 获取游记详细信息通过id
     *
     * @param array $jotting
     *
     * @return array
     */
    public function getDetailJottingById(&$jotting,$commentid=null) {
        $jotting['jottingTime'] = \util\TimeTool::convertUnixTimestampToChineseBlogTime($jotting['jottingTime']);
        $jotting['jottingImages'] = [];

        $images = $this->jottingImageModel->getJottingImages($jotting['jottingId']);
        if (count($images) > 0) {
            foreach ($images as $image) {
                $jotting['jottingImages'][] = base_url() . 'ui/img/jotting/images/' . $jotting['jottingId'] . '_' . $image['id'] . '.' . explode('.', $image['image'])[1] . '?' . time();
            }
        }

        $jotting['jottingCommentsCount'] = $this->commentModel->getCountOfJottingComment($jotting['jottingId'],$commentid);

        return $jotting;
    }

    /**
     * 获取游记列表
     *
     * @param int $currentPageNumber
     * @param string $keyword
     * @param int $type 用户类型
     * @param int $pageNumber
     * @param int $jottingId
     *
     * @return array
     */
    public function getJottings($currentPageNumber = 0, $keyword = null, $type = 1, $pageNumber = 2, $jottingId = null) {
        $result['totalPageNumber'] = 0;
        if ($currentPageNumber > 1) {
            $start = ($currentPageNumber - 1) * $pageNumber;
        } else {
            $start = 0;
        }

        $condition = '`jotting.isDeleted` = ' . \util\Constant::IS_DELETED_NO;

        if ($type == self::TYPE_MEMBER) {
            $condition .= ' AND `jotting.status` = ' . \util\Constant::STATUS_ACTIVE;
        }

        if ($keyword) {
            $keyword = urldecode($keyword);
            $condition .= ' AND (`jotting.title` LIKE "%' . $keyword . '%")';
        }

        if ($jottingId) {
            $condition .= ' AND `jotting.id` = ' . $jottingId;
        }

        $result['count'] = count($this->db->where($condition)->get(self::TABLE_JOTTING)->result_array());

        $fields = 'jotting.id AS jottingId, creator.id AS creatorId, creator.username AS creatorName, jotting.createdTimestamp AS jottingTime,';
        $fields .= 'jotting.title AS jottingTitle, jotting.content AS jottingContent, jotting.hits AS jottingHits, jotting.status AS jottingStatus';
        $result['jottings'] = $this->db->select($fields)
            ->join('member creator', 'creator.id = jotting.creatorId', 'LEFT')
            ->where($condition)
            ->order_by('jotting.id DESC')
            ->limit($pageNumber, $start)->get(self::TABLE_JOTTING)->result_array();

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
     * 获取游记列表
     *
     * @param int $currentPageNumber
     * @param string $keyword
     * @param int $type 用户类型
     * @param int $pageNumber
     * @param int $jottingId
     *
     * @return array
     */
    public function getJottingsM($currentPageNumber = 0, $keyword = null, $type = 1, $pageNumber = 4, $jottingId = null) {
        $result['totalPageNumber'] = 0;
        if ($currentPageNumber > 1) {
            $start = ($currentPageNumber - 1) * $pageNumber;
        } else {
            $start = 0;
        }

        $condition = '`jotting.isDeleted` = ' . \util\Constant::IS_DELETED_NO;

        if ($type == self::TYPE_MEMBER) {
            $condition .= ' AND `jotting.status` = ' . \util\Constant::STATUS_ACTIVE;
        }

        if ($keyword) {
            $keyword = urldecode($keyword);
            $condition .= ' AND (`jotting.title` LIKE "%' . $keyword . '%")';
        }

        if ($jottingId) {
            $condition .= ' AND `jotting.id` = ' . $jottingId;
        }

        $result['count'] = count($this->db->where($condition)->get(self::TABLE_JOTTING)->result_array());

        $fields = 'jotting.id AS jottingId, creator.id AS creatorId, creator.username AS creatorName, jotting.createdTimestamp AS jottingTime,';
        $fields .= 'jotting.title AS jottingTitle, jotting.content AS jottingContent, jotting.hits AS jottingHits, jotting.status AS jottingStatus';
        $result['jottings'] = $this->db->select($fields)
            ->join('member creator', 'creator.id = jotting.creatorId', 'LEFT')
            ->where($condition)
            ->order_by('jotting.id DESC')
            ->limit($pageNumber, $start)->get(self::TABLE_JOTTING)->result_array();

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
