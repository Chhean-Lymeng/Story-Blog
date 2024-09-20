<?php
namespace App\Helpers;
    class ImageUtil {
        public static $PLACEHOLDER_BRANCH_IMAGE = "assets/images/others/no_image.jpg";
        public static $LAWS_BRANCH_IMAGE = "assets/images/others/laws.jpg";
        public static $MINISTRY_BRANCH_IMAGE = "assets/images/others/ministry.jpg";
        public static function getImageUrl($url, $placeholder=""): string
        {
            if($url)
                return asset('storage/'.$url);
            return asset('storage/'.$placeholder);
        }
    }
?>