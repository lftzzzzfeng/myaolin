<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/8/22
 * Time: 9:26
 */
require_once dirname(__FILE__) . '/../util/Constant.php';

class MemberModel extends CI_Model
{
    const TABLE_MEMBER = 'member';

    const SOURCE_TYPE_WEIBO = 1;
    const SOURCE_TYPE_WECHAT = 2;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    /**
     * 是否为会员
     *
     * @param int $sourceType 来源
     * @param string $username 用户名
     *
     * @return boolean
     */
    public function existMember($sourceType, $username)
    {
        $condition = [
            'sourceType' => $sourceType,
            'username' => $username,
            'status' => \util\Constant::STATUS_ACTIVE
        ];

        $member = $this->db->select('id')->where($condition)->get(self::TABLE_MEMBER)->result_array();

        if ($member) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 存储会员
     *
     * @param int $sourceType 来源
     * @param string $uid 第三方id
     * @param string $username 用户名称
     * @param string $email 邮件
     * @param string $mobile 手机
     * @param int $status 状态
     *
     * @return int
     */
    public function saveMember($sourceType, $uid, $username, $email = null, $mobile = null, $status = 1)
    {
        $data = [];

        if ($sourceType == self::SOURCE_TYPE_WEIBO) {
            $member = $this->db->where(['uid' => $uid, 'isDeleted' => \util\Constant::IS_DELETED_NO])->get(self::TABLE_MEMBER)->row_array();
        } else if ($sourceType == self::SOURCE_TYPE_WECHAT) {
            $member = $this->db->where(['uid' => $uid, 'isDeleted' => \util\Constant::IS_DELETED_NO])->get(self::TABLE_MEMBER)->row_array();
        }

        $data['sourceType'] = $sourceType;

        if ($uid) {
            $data['uid'] = $uid;
        }
        if ($username) {
            $data['username'] = $username;
        }
        if ($email) {
            $data['email'] = $email;
        }
        if ($mobile) {
            $data['mobile'] = $mobile;
        }
        $data['status'] = $status;

        if ($member) {
            $savedId = $member['id'];
            $data['lastLoginTimestamp'] = time();

            $this->db->where('id', intval($savedId));
            $this->db->update(self::TABLE_MEMBER, $data);
        } else {
            $data['createdTimestamp'] = time();

            $this->db->insert(self::TABLE_MEMBER, $data);
            $savedId = $this->db->insert_id();
        }

        return $savedId;
    }

    /**
     * 获取微博渠道会员
     *
     * @param string $uid 三方id
     *
     * @return array
     */
    public function getMemberInWeiBo($uid)
    {
        $condition = [
            'sourceType' => self::SOURCE_TYPE_WEIBO,
            'uid' => $uid,
            'status' => \util\Constant::STATUS_ACTIVE
        ];

        return $this->db->select('id, sourceType, uid, username, email, mobile')->where($condition)->get(self::TABLE_MEMBER)->row_array();
    }
}
