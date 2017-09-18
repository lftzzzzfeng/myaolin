<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/8/14
 * Time: 16:02
 */
require_once dirname(__FILE__) . '/../util/Constant.php';

class DistributorModel extends CI_Model
{
    const TABLE_DISTRIBUTOR = 'distributor';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    /**
     * 存储分销商
     *
     * @param int $id
     * @param string $incharge 负责人
     * @param int $mobile 手机号码
     * @param string $name 公司名称
     * @param string $description 公司描述
     * @param string $content 公司内容
     * @param string $address 公司地址
     * @param int $status 状态
     * @param int $creatorId 创建者id
     * @param int $createdTimestamp 创建时间戳
     * @param int $lastEditorId 上次修改者id
     * @param int $lastEditedTimestamp 上次修改时间戳
     * @param string $logo 公司商标
     * @param string $coverImage 公司封面
     *
     * @return int
     *
     */
    public function saveDistributor($id, $incharge, $mobile, $name, $description, $content, $address, $status,
    $creatorId, $createdTimestamp, $lastEditorId, $lastEditedTimestamp, $logo, $coverImage)
    {
        $data = [];

        if ($id) {
            $distributor = $this->db->where(['id' => $id, 'isDeleted' => \util\Constant::IS_DELETED_NO])->get(self::TABLE_DISTRIBUTOR)->row_array();
            if (!$distributor) {
                echo '非法参数';
                exit;
            }
        }

        if ($id) {
            $savedId = $id;

            $data = [];
            if ($incharge) {
                $data['incharge'] = $incharge;
            }
            if ($mobile) {
                $data['mobile'] = $mobile;
            }
            if ($name) {
                $data['name'] = $name;
            }
            if ($description) {
                $data['description'] = $description;
            }
            if ($content) {
                $data['content'] = $content;
            }
            if ($address) {
                $data['address'] = $address;
            }
            if ($status) {
                $data['status'] = $status;
            }
            if ($logo) {
                $data['logo'] = $logo;
            }
            if ($coverImage) {
                $data['coverImage'] = $coverImage;
            }
            $data['lastEditorId'] = $lastEditorId;
            $data['lastEditedTimestamp'] = $lastEditedTimestamp;

            $this->db->where('id', intval($id));
            $this->db->update(self::TABLE_DISTRIBUTOR, $data);
        } else {
            if ($incharge) {
                $data['incharge'] = $incharge;
            }
            if ($mobile) {
                $data['mobile'] = $mobile;
            }
            if ($name) {
                $data['name'] = $name;
            }
            if ($description) {
                $data['description'] = $description;
            }
            if ($content) {
                $data['content'] = $content;
            }
            if ($address) {
                $data['address'] = $address;
            }
            $data['status'] = $status;
            $data['creatorId'] = $creatorId;
            $data['createdTimestamp'] = $createdTimestamp;
            if ($logo) {
                $data['logo'] = $logo;
            }
            if ($coverImage) {
                $data['coverImage'] = $coverImage;
            }
            $this->db->insert(self::TABLE_DISTRIBUTOR, $data);
            $savedId = $this->db->insert_id();
        }

        return $savedId;
    }

    /**
     * 存储qrCode
     *
     * @param int $id
     *
     * @return boolean
     */
    public function saveQRCode($id)
    {
        $this->db->set('qrCode', $id . '.png');
        $this->db->where('id', $id);
        return $this->db->update(self::TABLE_DISTRIBUTOR);
    }

    /**
     * 获取分销商通过id
     *
     * @param int $id
     *
     * @return array
     */
    public function getDistributorById($id)
    {
        return $this->db->where(['id' => $id])->get(self::TABLE_DISTRIBUTOR)->row_array();
    }

    /**
     * 获取分销商列表
     *
     * @param int $currentPageNumber
     * @param string $keyword
     *
     * @return array
     */
    public function getDistributors($currentPageNumber = 0, $keyword = null)
    {
        $pageNumber = 2;
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
            $condition .= ' AND (`incharge` LIKE "%' . $keyword . '%" OR `mobile` LIKE "%' . $keyword . '%" OR `name` LIKE "%' . $keyword . '%")';
        }

        $result['count'] = count($this->db->where($condition)->get(self::TABLE_DISTRIBUTOR)->result_array());
        $result['distributors'] = $this->db->where($condition)->order_by('id DESC')
            ->limit($pageNumber, $start)->get(self::TABLE_DISTRIBUTOR)->result_array();

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
