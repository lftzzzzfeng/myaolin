<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/8/17
 * Time: 17:50
 */
class ScenicAreaImageModel extends CI_Model
{
    const TABLE_SCENIC_AREA_IMAGE = 'scenicareaimage';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * 存储景区介绍照片
     *
     * @param int $scenicAreaId
     * @param array $images
     *
     * @return boolean
     */
    public function saveScenicAreaImages($scenicAreaId, $images)
    {
        if ((!empty($images['name'][0])) && count($images['name']) > 0) {
            $this->db->where('scenicAreaId', $scenicAreaId);
            $this->db->delete(self::TABLE_SCENIC_AREA_IMAGE);

            $count = count($images['name']);

            for ($m = 0; $m < $count; $m++) {
                $data['scenicAreaId'] = $scenicAreaId;
                $data['image'] = $images['name'][$m];

                $this->db->insert(self::TABLE_SCENIC_AREA_IMAGE, $data);
                $savedId = $this->db->insert_id();

                $info = pathinfo($images['name'][$m]);
                $ext = $info['extension'];
                $scenicAreaImagesPublicPath = dirname(__FILE__) . '/../../ui/img/scenicarea/images/';
                $newName = $scenicAreaId . '_' . $savedId . '.' . $ext;
                $target = $scenicAreaImagesPublicPath . $newName;
                move_uploaded_file($images['tmp_name'][$m], $target);
            }
        }

        return true;
    }

    /**
     * 获取景区介绍照片通过景区id
     *
     * @param int $scenicAreaId
     *
     * @return array
     */
    public function getScenicAreaImages($scenicAreaId)
    {
        $condition = [];
        $condition['scenicAreaId'] = $scenicAreaId;
        $images = $this->db->where($condition)->get(self::TABLE_SCENIC_AREA_IMAGE)->result_array();

        return $images;
    }
    
     /**
     * 移动端
     * 获取景区介绍照片通过景区id
     *
     * @param int $scenicAreaId
     *
     * @return array
     */
    public function getScenicAreaImagesM($scenicAreaId)
    {
        $condition = [];
        $condition['scenicAreaId'] = $scenicAreaId;
        $images['area'] = $this->db->where($condition)->get(self::TABLE_SCENIC_AREA_IMAGE)->result_array();
        foreach ($images['area'] as $k => &$item) {
            $item['image'] = $this->baseUrl . 'ui/img/scenicArea/images/'.$scenicAreaId.'_'.$item['id']
                . '.' . explode('.', $item['image'])[1] .'?' . time();
        }
        $area = $this->db->where("id=$scenicAreaId")->get('scenicarea')->row_array();
        $images['name'] = $area['title'];
        $images['coverimage'] = $this->baseUrl . 'ui/img/scenicarea/coverimage/' . $area['id'] . '.' . explode('.', $area['coverImage'])[1] .'?' . time();
        return $images;
    }
}
