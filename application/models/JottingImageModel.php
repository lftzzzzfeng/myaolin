<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/8/23
 * Time: 14:36
 */
class JottingImageModel extends CI_Model
{
    const TABLE_JOTTING_IMAGE = 'jottingimage';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * 存储随记照片
     *
     * @param int $jottingId
     * @param array $images
     *
     * @return boolean
     */
    public function saveJottingImages($jottingId, $images)
    {
        if ((!empty($images['name'][0])) && count($images['name']) > 0) {
            $this->db->where('jottingId', $jottingId);
            $this->db->delete(self::TABLE_JOTTING_IMAGE);

            $count = count($images['name']);

            for ($m = 0; $m < $count; $m++) {
                $data['jottingId'] = $jottingId;
                $data['image'] = $images['name'][$m];

                $this->db->insert(self::TABLE_JOTTING_IMAGE, $data);
                $savedId = $this->db->insert_id();

                $info = pathinfo($images['name'][$m]);
                $ext = $info['extension'];
                $jottingImagesPublicPath = dirname(__FILE__) . '/../../ui/img/jotting/images/';
                $newName = $jottingId . '_' . $savedId . '.' . $ext;
                $target = $jottingImagesPublicPath . $newName;
                move_uploaded_file($images['tmp_name'][$m], $target);
            }
        }

        return true;
    }

    /**
     * 获取随记照片通过景点id
     *
     * @param int $jottingId
     *
     * @return array
     */
    public function getJottingImages($jottingId)
    {
        $condition = [];
        $condition['jottingId'] = $jottingId;
        $images = $this->db->where($condition)->get(self::TABLE_JOTTING_IMAGE)->result_array();

        return $images;
    }
}
