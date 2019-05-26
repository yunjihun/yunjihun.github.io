<!DOCTYPE HTML>
<html lang="ko">
<head>
<title> Google Image Search </title>
<meta charset="utf-8">
<script>
window.omload = function() {
    document.forms['googleImageSearch'].submit();
}
</script>
</head>

<body>
<?php
// 파일 정보 출력
//echo '<pre>', print_r($_FILES) ,"</pre>";

// 설정
$uploads_dir = './_uploads';//저장할 공간
$allowed_ext = array('jpg','jpeg','png','gif','bmp');

// 변수 정리
$error = $_FILES['pic']['error'];
$name = $_FILES['pic']['name'];
$ext = array_pop(explode('.', $name));
$url = $uploads_dir."/".$name;

// 오류 확인
if( $error != UPLOAD_ERR_OK ) {
    switch( $error ) {
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            echo "파일이 너무 큽니다. ($error)";
            break;
        case UPLOAD_ERR_NO_FILE:
            echo "파일이 첨부되지 않았습니다. ($error)";
            break;
        default:
            echo "파일이 제대로 업로드되지 않았습니다. ($error)";
    }
    exit;
}
else {
    // 확장자 확인
    if( !in_array($ext, $allowed_ext) ) {
        echo "허용되지 않는 확장자입니다.";
        exit;
    }

    // 파일 이동
    if (move_uploaded_file( $_FILES['pic']['tmp_name'], $url)) {
?>
<form name="googleImageSearch" method="get" action="https://www.google.com/searchbyimage">
    <input name="image_url" value="<?=$url;?>" spellcheck="false">
</form>
<?php
    }
}
?>
</body>
</html>
