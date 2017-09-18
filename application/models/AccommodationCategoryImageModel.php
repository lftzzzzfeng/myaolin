<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/9/5
 * Time: 14:46
 */
class AccommodationCategoryImageModel extends CI_Model
{
    const TABLE_ACCOMMODATION_CATEGORY_IMAGE = 'accommodationcategoryimage';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * 存储住在瑶琳类别照片
     *
     * @param int $accommodationCategoryId
     * @param array $text
     * @param array $images
     *
     * @return boolean
     */
    public function saveAccommodationCategoryImages($accommodationCategoryId, $text, $images)
    {
        if (count($text) > 0) {
            $ids = [];

            foreach ($text as $key => $content) {
                if (stristr($key, 'new') == false) {
                    $ids[] = $key;
                }
            }

            if (count($ids) > 0) {
                $condition = '(`id` NOT IN (' . implode(',', $ids) . ')) AND (`accommodationCategoryId` = ' . $accommodationCategoryId . ')';
            } else {
                $condition = '(`id` NOT IN (0)) AND (`accommodationCategoryId` = ' . $accommodationCategoryId . ')';
            }

            $this->db->where($condition)->delete(self::TABLE_ACCOMMODATION_CATEGORY_IMAGE);

            foreach ($text as $key => $content) {
                if (stristr($key, 'new') !== false) {
                    $data['accommodationCategoryId'] = $accommodationCategoryId;
                    $data['text'] = $content[0];
                    $data['image'] = $images['name']["$key"][0];

                    $this->db->insert(self::TABLE_ACCOMMODATION_CATEGORY_IMAGE, $data);
                    $savedId = $this->db->insert_id();

                    $info = pathinfo($images['name']["$key"][0]);
                    $ext = $info['extension'];
                    $accommodationCategoryImagesPublicPath = dirname(__FILE__) . '/../../ui/img/accommodation/category/';
                    $newName = $accommodationCategoryId . '_' . $savedId . '.' . $ext;
                    $target = $accommodationCategoryImagesPublicPath . $newName;
                    move_uploaded_file($images['tmp_name']["$key"][0], $target);
                } else {
                    $data = [];
                    if ($content) {
                        $data['text'] = $content[0];
                    }

                    if ($images['name'][$key][0]) {
                        $data['image'] = $images['name'][$key][0];
                        $info = pathinfo($images['name'][$key][0]);
                        $ext = $info['extension'];
                        $accommodationCategoryImagesPublicPath = dirname(__FILE__) . '/../../ui/img/accommodation/category/';
                        $newName = $accommodationCategoryId . '_' . $key . '.' . $ext;
                        $target = $accommodationCategoryImagesPublicPath . $newName;
                        move_uploaded_file($images['tmp_name'][$key][0], $target);
                    }

                    if ($content[0] || $images['name'][$key][0]) {
                        $this->db->where('id', $key)->update(self::TABLE_ACCOMMODATION_CATEGORY_IMAGE, $data);
                    }
                }
            }
        } else {
            $condition = '`id` NOT IN (0)';
            $this->db->where($condition)->delete(self::TABLE_ACCOMMODATION_CATEGORY_IMAGE);
        }

        return true;
    }

    /**
     * 获取住在瑶琳类别照片通过住在瑶琳类别id
     *
     * @param int $accommodationCategoryId
     *
     * @return array
     */
    public function getAccommodationCategoryImages($accommodationCategoryId)
    {
        $condition = [];
        $condition['accommodationCategoryId'] = $accommodationCategoryId;
        $images = $this->db->where($condition)->get(self::TABLE_ACCOMMODATION_CATEGORY_IMAGE)->result_array();

        return $images;
    }
}
