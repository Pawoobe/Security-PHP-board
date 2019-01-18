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

if ($_SESSION['referer'] = $_SERVER['HTTP_REFERER']) {
} else {
  echo "<script> alert('잘못된 접근입니다.');</script>";
  echo "<meta http-equiv='refresh' content=\"0;url='../index/main.php'\">";
}
// 보안 토큰 검증
$token = bin2hex (openssl_random_pseudo_bytes(16));
$_SESSION['token'] = $token;

 if (!$_SESSION['token'] or !$token)
 {
   echo "<script> alert('토큰이 올바르지 않습니다.')</script>";
   echo "<meta http-equiv='refresh' content=\"0;url='/index/main.php'\">";
 } else {
 }
$sql = "SELECT user_id FROM board WHERE number='$_GET[number]'";
$result = mysqli_query ($conn, $sql);
$row = mysqli_fetch_array ($result);

if ($sess_id != $row[user_id]){
  echo "<script> alert('작성자만 삭제 할 수 있습니다.'); </script>";
  echo "<meta http-equiv='refresh' content=\"0;url='/board/list.php'\">";
  exit();
}
$sql2 = "DELETE FROM board WHERE number= '$_GET[number]'";
$ret = mysqli_query ($conn, $sql2);
if ( $ret ){
            echo "<script> alert ('삭제가 완료되었습니다.'); </script>";
    }else {
            echo "<script> alert ('삭제가 완료되지못하였습니다'); </script>";
    }
?>
<meta http-equiv='refresh' content="0;url='/board/list.php'">
