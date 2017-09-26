<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/8/23
 * Time: 17:30
 */
require_once dirname(__FILE__) . '/../util/Constant.php';
require_once dirname(__FILE__) . '/../util/TimeTool.php';

class CommentModel extends CI_Model
{
    const TABLE_COMMENT = 'comment';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    /**
     * 存储评论
     *
     * @param int $jottingId
     * @param string $content 内容
     * @param int $commentId
     * @param int $receiverMemberId
     * @param int $status 状态
     *
     * @return int
     */
    public function saveComment($jottingId, $content, $commentId = null, $receiverMemberId = null, $status = null)
    {
        $data = [];

        $data['jottingId'] = $jottingId;
        $data['creatorMemberId'] = 2; //$_SESSION['member']['id']
        if ($receiverMemberId) {
            $data['receiverMemberId'] = $receiverMemberId;
        }
        if ($commentId) {
            if (!$receiverMemberId) {
                $data['receiverMemberId'] = $this->getCommentById($commentId)['creatorMemberId'];
            }
            $data['commentId'] = $commentId;
        }
        $data['content'] = $content;
        $data['status'] = $status ? $status : \util\Constant::STATUS_ACTIVE;
        $data['createdTimestamp'] = time();

        $this->db->insert(self::TABLE_COMMENT, $data);
        $savedId = $this->db->insert_id();

        return $savedId;
    }

    /**
     * 获取评论通过id
     *
     * @param int $id
     *
     * @return array
     */
    public function getCommentById($id) {
        $item = $this->db
            ->select('comment.id, comment.jottingId AS commentJottingId, comment.creatorMemberId, comment.commentId AS commentId, creator.username AS sender, receiver.username AS recipient, comment.content, comment.createdTimestamp')
            ->join('member creator', 'creator.id = comment.creatorMemberId', 'LEFT')
            ->join('member receiver', 'receiver.id = comment.receiverMemberId', 'LEFT')
            ->where(['comment.id' => $id])->order_by('comment.id DESC')->get(self::TABLE_COMMENT)->row_array();

        $item['createdTimestamp'] = \util\TimeTool::convertUnixTimestampToChineseBlogTime($item['createdTimestamp']);

        return $item;
    }

    /**
     * 获取随记评论列表
     *
     * @param int $jottingId
     * @param int $currentPageNumber
     *
     * @return array
     */
    public function getCommentsByJottingId($jottingId, $currentPageNumber = 0) {
        $pageNumber = 20;
        $result['totalPageNumber'] = 0;
        if ($currentPageNumber > 1) {
            $start = ($currentPageNumber - 1) * $pageNumber;
        } else {
            $start = 0;
        }

        $condition = '`comment.isDeleted` = ' . \util\Constant::IS_DELETED_NO;
        $condition .= ' AND `comment.jottingId` = ' . $jottingId;
        $condition .= ' AND `comment.status` = ' . \util\Constant::STATUS_ACTIVE;

        $result['count'] = count($this->db->where($condition)->get(self::TABLE_COMMENT)->result_array());
        $result['comments'] = $this->db
            ->select('comment.id, comment.jottingId AS commentJottingId, comment.commentId AS commentId, creator.username AS sender, receiver.username AS recipient, comment.content, comment.createdTimestamp')
            ->join('member creator', 'creator.id = comment.creatorMemberId', 'LEFT')
            ->join('member receiver', 'receiver.id = comment.receiverMemberId', 'LEFT')
            ->where($condition)->order_by('id DESC')
            ->limit($pageNumber, $start)->get(self::TABLE_COMMENT)->result_array();

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
     * 获取随笔评论数量
     *
     * @param $jottingId
     *
     * @return int
     *
     */
    public function getCountOfJottingComment($jottingId,$commentid=null)
    {
        $condition = [];
        $condition['status'] = \util\Constant::STATUS_ACTIVE;
        $condition['isDeleted'] = \util\Constant::IS_DELETED_NO;
        $condition['jottingId'] = $jottingId;
        if($commentid){
            $condition['commentid'] = null;
        }
        $this->db->where($condition);
        $this->db->from(self::TABLE_COMMENT);
        return $this->db->count_all_results();
    }

    /**
     * 获取一级评论
     *
     * @param int $jottingId 随笔id
     * @param int $currentPageNumber 当前页数
     * @param int $pageNumber 每页显示数目
     *
     * @return array
     */
    public function getFirstLevelComment($jottingId, $currentPageNumber = 0, $pageNumber = 2)
    {
//        $pageNumber = 10;
        $result['totalPageNumber'] = 0;
        if ($currentPageNumber > 1) {
            $start = ($currentPageNumber - 1) * $pageNumber;
        } else {
            $start = 0;
        }

        $condition = '`comment.isDeleted` = ' . \util\Constant::IS_DELETED_NO;
        $condition .= ' AND `comment.jottingId` = ' . $jottingId;
        $condition .= ' AND `comment.status` = ' . \util\Constant::STATUS_ACTIVE;
        $condition .= ' AND `comment.commentId` IS NULL';

        $result['count'] = count($this->db->where($condition)->get(self::TABLE_COMMENT)->result_array());
        $result['comments'] = $this->db
            ->select('comment.id, comment.jottingId AS commentJottingId, comment.commentId AS commentId, creator.username AS sender, receiver.username AS recipient, comment.content, comment.createdTimestamp')
            ->join('member creator', 'creator.id = comment.creatorMemberId', 'LEFT')
            ->join('member receiver', 'receiver.id = comment.receiverMemberId', 'LEFT')
            ->where($condition)->order_by('id DESC')
            ->limit($pageNumber, $start)->get(self::TABLE_COMMENT)->result_array();

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
     * 获取二级评论
     *
     * @param int $commentId 随笔id
     * @param int $currentPageNumber 当前页数
     * @param int $pageNumber 每页显示数目
     *
     * @return array
     */
    public function getSecondLevelJottingComments($commentId, $currentPageNumber = 0, $pageNumber = 2)
    {
//        $pageNumber = 10;
        $result['totalPageNumber'] = 0;
        if ($currentPageNumber > 1) {
            $start = ($currentPageNumber - 1) * $pageNumber;
        } else {
            $start = 0;
        }

        $condition = '`comment.isDeleted` = ' . \util\Constant::IS_DELETED_NO;
        $condition .= ' AND `comment.status` = ' . \util\Constant::STATUS_ACTIVE;
        $condition .= ' AND `comment.commentId` = ' . $commentId;

        $result['count'] = count($this->db->where($condition)->get(self::TABLE_COMMENT)->result_array());
        $result['comments'] = $this->db
            ->select('comment.id, comment.jottingId AS commentJottingId, comment.commentId AS commentId, creator.username AS sender, receiver.username AS recipient, comment.content, comment.createdTimestamp')
            ->join('member creator', 'creator.id = comment.creatorMemberId', 'LEFT')
            ->join('member receiver', 'receiver.id = comment.receiverMemberId', 'LEFT')
            ->where($condition)->order_by('id DESC')
            ->limit($pageNumber, $start)->get(self::TABLE_COMMENT)->result_array();

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
