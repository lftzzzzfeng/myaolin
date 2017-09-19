<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/9/18
 * Time: 17:26
 */
require_once dirname(__FILE__) . '/../util/Constant.php';

class MerchantDetailModel extends CI_Model
{
    const TABLE_MERCHANT_DETAIL = 'merchantdetail';

    const TYPE_HOTEL = 1;
    const TYPE_RESTAURANT = 2;
    const TYPE_TRAVEL_AGENCY = 3;
    const TYPE_OTHERS = 4;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    /**
     * 存储商户
     *
     * @param int $merchantId
     * @param int $merchantType
     * @param int $type
     * @param string $name
     * @param string $bankCardNumber
     * @param string $contactNumber
     * @param string $image
     * @param string $companyContactName
     * @param string $ic
     * @param string $logo
     *
     * @return int
     */
    public function saveMerchantDetail($merchantId, $merchantType, $type, $name, $bankCardNumber, $contactNumber, $image, $companyContactName = null, $ic = null, $logo = null)
    {
        $data = [];

        $data['merchantId'] = $merchantId;
        $data['type'] = $type;
        $data['name'] = $name;
        $data['bankCardNumber'] = $bankCardNumber;
        $data['contactNumber'] = $contactNumber;
        if ($image) {
            $data['image'] = $image;
        }

        if ($merchantType == MerchantModel::TYPE_INDIVIDUAL) {
            $data['ic'] = $ic;
        } else if ($merchantType == MerchantModel::TYPE_COMPANY) {
            $data['companyContactName'] = $companyContactName;
        }

        if ($logo) {
            $data['logo'] = $logo;
        }

        if (!$this->getMerchantDetailById($merchantId)) {
            $data['creatorId'] = $_SESSION['merchant']['id'];
            $data['createdTimestamp'] = time();

            $this->db->insert(self::TABLE_MERCHANT_DETAIL, $data);
        } else {
            $data['lastEditorId'] = $_SESSION['merchant']['id'];
            $data['lastEditedTimestamp'] = time();
            $this->db->where('merchantId', intval($merchantId));

            $this->db->update(self::TABLE_MERCHANT_DETAIL, $data);
        }

        return $merchantId;
    }

    /**
     * 获取商户资料通过id
     *
     * @param int $merchantId
     *
     * @return array
     *
     */
    public function getMerchantDetailById($merchantId)
    {
        $condition = '`status` = ' . \util\Constant::STATUS_ACTIVE;
        $condition .= ' AND `isDeleted` = ' . \util\Constant::IS_DELETED_NO;
        $condition .= ' AND `merchantId` = ' . intval($merchantId);

        return $this->db->select('merchantId, name, companyContactName, ic, contactNumber, bankCardNumber, image, logo')->where($condition)->get(self::TABLE_MERCHANT_DETAIL)->row();
    }
}
