
<?php

session_start();

$conn = mysqli_connect('localhost', 'root', '1234');
if( !$conn ){
    die('MySQL connect ERROR : ' . mysqli_errno());
}

$ret = mysqli_select_db($conn, 'bbs');
if( !$ret ){
    die('MySQL select ERROR : '. mysqli_errno());
}
//write.php 에서 게시글 게목, 게시글 내용을 입력받아서 옴
$title = $_POST[title];

session_start();

$conn = mysqli_connect('localhost', 'root', '1234');
if( !$conn ){
    die('MySQL connect ERROR : ' . mysqli_errno());
}

$ret = mysqli_select_db($conn, 'bbs');
if( !$ret ){
    die('MySQL select ERROR : '. mysqli_errno());
}

if ($_SESSION['referer'] = $_SERVER['HTTP_REFERER']) {
} else {
  echo "<script> alert('잘못된 접근입니다.');</script>";
  echo "<meta http-equiv='refresh' content=\"0;url='../index/main.php'\">";
}
//write.php 에서 게시글 게목, 게시글 내용을 입력받아서 옴
$title = $_POST[title];
$text = $_POST[text];
//세션에 저장되있는 로그인 한 사용자의 아이디
$user_id = $_SESSION[user_id];
//date() 함수를 이용해 게시글 작성시간을 구한다
$write_time = date("Y:M:D");
//파일 업로드
$tmpfile = $_FILES['file']['tmp_name'];
$o_name = $_FILES['file']['name'];
$filename = iconv("UTF-8", "EUC-KR",$_FILES['file']['name']);
$folder = "./uploads/" .$filename;
$allowed_ext = array ('jpg', 'jpeg', 'png', 'gif');

// 오류 변수
$error = $_FILES['file']['error'];
$ext = array_pop (explode ('.', $o_name));
// 오류확인
if ($error != UPLOAD_ERR_OK){
    switch ($error) {
      case UPLOAD_ERR_INI_SIZE:
      case UPLOAD_ERR_FORM_SIZE:
        echo "<script> alert('파일의 용량이 너무 큽니다.') </script>($error)";
        break;
    }
    echo "<meta http-equiv='refresh' content=\"0;url='/board/list.php'\">";
}
// 확장자 확인
if (!in_array($ext, $allowed_ext)){
  echo "<script> alert('허용되지 않는 확장자입니다.') </script>";
  echo "<meta http-equiv='refresh' content=\"0;url='/board/write.php'\">";
  exit;
}
$new_file_name = date("_YmdHis_").str_replace("", "", basename($o_name));
move_uploaded_file( $tmpfile, $folder . $new_file_name );
$pw = $_POST[pw];
//게시글 번호는 자동으로 입력
//게시글 제목, 게시글 내용, 작성자 아이디, 작성시간을 DB에 추가
$sql = "INSERT INTO board(title, text, user_id, write_time, file) VALUE('{$title}','{$text}','{$user_id}','{$write_time}','{$o_name}')";
$ret = mysqli_query( $conn, $sql );
if ($ret){
  echo "<script> alert('게시글 등록 성공');</script>";
}else{
  echo "<script> alert('게시글 등록 실패');</script>";
}

?>
<meta http-equiv='refresh' content="0;url='/board/list.php'">
