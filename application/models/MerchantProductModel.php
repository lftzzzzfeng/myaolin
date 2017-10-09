<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/10/3
 * Time: 8:09
 */
require_once dirname(__FILE__) . '/../util/Constant.php';

class MerchantProductModel extends CI_Model
{
    const TABLE_MERCHANT_PRODUCT = 'merchantproduct';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * 存储商户商品
     *
     * @param int $merchantId
     * @param array $productIds
     * @param array $productUnitPrices
     *
     * @return boolean
     */
    public function saveMerchantProducts($merchantId, $productIds, $productUnitPrices)
    {
        $this->db->where('merchantId', $merchantId);
        $this->db->delete(self::TABLE_MERCHANT_PRODUCT);

        $count = count($productIds);

        for ($i = 0; $i < $count; $i++) {
            $data['merchantId'] = $merchantId;
            $data['productId'] = $productIds[$i];
            $data['unitPrice'] = $productUnitPrices[$i];

            $this->db->insert(self::TABLE_MERCHANT_PRODUCT, $data);
        }

        return true;
    }

    /**
     * 获取商户商品
     *
     * @param int $merchantId
     *
     * @return array
     */
    public function getMerchantProducts($merchantId)
    {
        $condition = [];
        $condition['merchantId'] = $merchantId;
        $products = $this->db->where($condition)
            ->join('product', 'product.id = merchantProduct.productId', 'LEFT')
            ->get(self::TABLE_MERCHANT_PRODUCT)->result_array();
        return $products;
    }
}
