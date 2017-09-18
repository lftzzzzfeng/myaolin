<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/8/18
 * Time: 14:18
 */
class ScenicViewImageModel extends CI_Model
{
    const TABLE_SCENIC_VIEW_IMAGE = 'scenicviewimage';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * 存储景点介绍照片
     *
     * @param int $scenicViewId
     * @param array $images
     *
     * @return boolean
     */
    public function saveScenicViewImages($scenicViewId, $images)
    {
        if ((!empty($images['name'][0])) && count($images['name']) > 0) {
            $this->db->where('scenicViewId', $scenicViewId);
            $this->db->delete(self::TABLE_SCENIC_VIEW_IMAGE);

            $count = count($images['name']);

            for ($m = 0; $m < $count; $m++) {
                $data['scenicViewId'] = $scenicViewId;
                $data['image'] = $images['name'][$m];

                $this->db->insert(self::TABLE_SCENIC_VIEW_IMAGE, $data);
                $savedId = $this->db->insert_id();

                $info = pathinfo($images['name'][$m]);
                $ext = $info['extension'];
                $scenicViewImagesPublicPath = dirname(__FILE__) . '/../../ui/img/scenicview/images/';
                $newName = $scenicViewId . '_' . $savedId . '.' . $ext;
                $target = $scenicViewImagesPublicPath . $newName;
                move_uploaded_file($images['tmp_name'][$m], $target);
            }
        }

        return true;
    }

    /**
     * 获取景点介绍照片通过景点id
     *
     * @param int $scenicViewId
     *
     * @return array
     */
    public function getScenicViewImages($scenicViewId)
    {
        $condition = [];
        $condition['scenicViewId'] = $scenicViewId;
        $images = $this->db->where($condition)->get(self::TABLE_SCENIC_VIEW_IMAGE)->result_array();

        return $images;
    }
}
