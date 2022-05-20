<?php

/*
	Plugin Name:  媒體庫優化外掛
	Version:  1.0
	Description:  限制WordPress媒體庫限制圖片寬度小於2000px。上傳檔案大小小於2MB
	Author:  websec.one
	Author URI:  https://websec.one
	License: GPLv2 or later
*/
add_filter('wp_handle_upload_prefilter','mdu_validate_image_size');
function mdu_validate_image_size( $file ) {
    $image = getimagesize($file['tmp_name']);
    $maximum = array(
        'width' => '2000',
    );
    $image_width = $image[0];
	$too_large = "圖片寬度太大。 最大寬度是 {$maximum['width']} pixels. 上傳的圖片寬度是 $image_width pixels.";
	
    if ( $image_width > $maximum['width'] ) {
        $file['error'] = $too_large; 
        return $file;
    }
    else
        return $file;
}

function max_up_size() {
	return 2048*1024; 
}
add_filter('upload_size_limit', 'max_up_size');