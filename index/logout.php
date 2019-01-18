<?php
session_start();
//#1 MySQL접속
$conn = mysqli_connect('localhost', 'root', '1234');
if(!$conn){
  die('MySQL connect ERROR: ' . mysqli_errno());
}

//#2 bbs연결
$ret = mysqli_select_db($conn, 'bbs');
if(!$ret){
  die('MySQL select ERROR:' . mysqli_errno());
}

session_start();

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
//로그인한 사용자의 아이디는 세션의 user_id로 저장되어 있다
$user_id = $_SESSION[user_id];


$past = time()-3600;
foreach ($_COOKIE as $key => $value) { setcookie($key,$value,$past, '/');
}

//세션 파괴
session_destroy();

if ($ret){
  echo "<script> alert('로그아웃이 성공적으로 되었습니다.');</script>";
}else{
  echo "<script> alert('로그아웃을 실패 했습니다.');</script>";
}
?>
<meta http-equiv="refresh" content="0;url='/index/main.php'">
