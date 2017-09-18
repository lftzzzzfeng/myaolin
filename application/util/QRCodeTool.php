<?php
/**
 * Created by PhpStorm.
 * User: LiuFeng
 * Date: 2017/8/10
 * Time: 14:52
 */
namespace util;

class QRCodeTool
{
    /**
     * 生成含有logo的二维码
     * @param string $qrCodeContent 二维码内容
     * @param string $qrCodeSaveName 二维码存储名称
     * @param string $logoName 商标名称
     *
     * @return boolean
     */
    public static function generateQRCode($qrCodeContent, $qrCodeSaveName, $logoName)
    {
        require_once(dirname(__FILE__) .  "/../libraries/qrcode/qrlib.php");

        $distributorQRCodePublicPath = dirname(__FILE__) . '/../../ui/img/distributorqrcode/';
        $distributorLogoPublicPath = dirname(__FILE__) . '/../../ui/img/distributorlogo/';

        // Path where the images will be saved
//        $filepath = dirname(__FILE__) . '/../../ui/img/qrcode/abc.png';
        $filePath = $distributorQRCodePublicPath . $qrCodeSaveName;

        // Image (logo) to be drawn
//        $logopath = dirname(__FILE__) . '/../../ui/img/tiger.jpg';
        $logoPath = $distributorLogoPublicPath . $logoName;
        // qr code content
//        $codeContents = 'http://www.qq.com';
        // Create the file in the providen path
        // Customize how you want

        \QRcode::png($qrCodeContent, $filePath, QR_ECLEVEL_H, 10, 0);

        // Start DRAWING LOGO IN QRCODE
        $QR = imagecreatefrompng($filePath);

        // START TO DRAW THE IMAGE ON THE QR CODE
        $logo = imagecreatefromstring(file_get_contents($logoPath));
        $QR_width = imagesx($QR);
        $QR_height = imagesy($QR);

        $logo_width = imagesx($logo);
        $logo_height = imagesy($logo);

        // Scale logo to fit in the QR Code
        $logo_qr_width = $QR_width/3;
        $scale = $logo_width/$logo_qr_width;
        $logo_qr_height = $logo_height/$scale;

        imagecopyresampled($QR, $logo, $QR_width/3, $QR_height/3, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);

        // Save QR code again, but with logo on it
        return imagepng($QR, $filePath);

        // End DRAWING LOGO IN QR CODE

        // Ouput image in the browser
//        $src = base_url() . 'ui/img/qrcode/abc.png';
//        echo '<img style="width: 300px; height: 300px" src="'.$src.'" />';
    }
}
