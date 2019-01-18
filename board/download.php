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

$sess_id = $_SESSION[user_id];
//세션 아이디 값이 없다 = 로그인 상태가 아님
//게시글 작성페이지로 이동시키지 않는다.
if ($sess_id === null){
  echo "<script> alert('로그인이 필요합니다. 로그인을 해주세요');</script>";
  echo "<meta http-equiv='refresh' content=\"0;url='../index/login.php'\">";
  exit(0);
}

$file = $_GET['file'];
$path = $_GET['path'];
$local_path = "./uploads/" . $path.'/';
$downFile = $local_path.$file;

if (strstr($downFile, "../")||strstr($downFile, "..\\"))
{
  echo "<script> alert('잘못된 접근입니다.');</script>";
  echo "<meta http-equiv='refresh' content=\"0;url='../board/list.php'\">";
}
if (file_exists($downFile)) {
  header('Content-Description: File Transfer');
  header('Content-Type: application/octet-stream');
  header('Content-Disposition: attachment; filename="'.basename($downFile).'"');
  header('Expires: 0');
  header('Cache-Control: must-revalidate');
  header('Pragma: public');
  header('Content-Length:'.filesize( $downFile ));
  readfile($downFile);
  exit;
} else {
  // die ('ERROR: the file '.$file.' dose not exists!');
}

?>
