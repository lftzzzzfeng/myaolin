<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/9/1
 * Time: 15:51
 */
class AccommodationImageModel extends CI_Model
{
    const TABLE_ACCOMMODATION_IMAGE = 'accommodationimage';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * 存储住在瑶琳照片
     *
     * @param int $accommodationId
     * @param array $images
     *
     * @return boolean
     */
    public function saveAccommodationImages($accommodationId, $images)
    {
        if ((!empty($images['name'][0])) && count($images['name']) > 0) {
            $this->db->where('accommodationId', $accommodationId);
            $this->db->delete(self::TABLE_ACCOMMODATION_IMAGE);

            $count = count($images['name']);

            for ($m = 0; $m < $count; $m++) {
                $data['accommodationId'] = $accommodationId;
                $data['image'] = $images['name'][$m];

                $this->db->insert(self::TABLE_ACCOMMODATION_IMAGE, $data);
                $savedId = $this->db->insert_id();

                $info = pathinfo($images['name'][$m]);
                $ext = $info['extension'];
                $accommodationImagesPublicPath = dirname(__FILE__) . '/../../ui/img/accommodation/';
                $newName = $accommodationId . '_' . $savedId . '.' . $ext;
                $target = $accommodationImagesPublicPath . $newName;
                move_uploaded_file($images['tmp_name'][$m], $target);
            }
        }

        return true;
    }

    /**
     * 获取住在瑶琳照片通过住在瑶琳id
     *
     * @param int $accommodationId
     *
     * @return array
     */
    public function getAccommodationImages($accommodationId)
    {
        $condition = [];
        $condition['accommodationId'] = $accommodationId;
        $images = $this->db->where($condition)->get(self::TABLE_ACCOMMODATION_IMAGE)->result_array();

        return $images;
    }
}
