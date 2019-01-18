<?php

session_start();

$conn = mysqli_connect('localhost', 'root', '1234');
if( !$conn ){
    die('MySQL connect ERROR : ' . mysqli_errno());
}

$ret = mysqli_select_db($conn, 'blind');
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
// if ($_SESSION['referer'] = $_SERVER['HTTP_REFERER']) {
// } else {
//   echo "<script> alert('잘못된 접근입니다.');</script>";
//   echo "<meta http-equiv='refresh' content=\"0;url='../index/main.php'\">";
// }
// // 보안 토큰 검증
// $token = bin2hex (openssl_random_pseudo_bytes(16));
// $_SESSION['token'] = $token;
//
//  if (!$_SESSION['token'] or !$token)
//  {
//    echo "<script> alert('토큰이 올바르지 않습니다.')</script>";
//    echo "<meta http-equiv='refresh' content=\"0;url='/index/main.php'\">";
//  } else {
//  }
?>

<html>
<title>vulnerable page</title>
<head>
  <h2>Let's PLAY</h2>
</head>
</html>

<?php
$sql = "SELECT * FROM anews WHERE no={$_GET['number']}";
$ret = mysqli_query($conn, $sql);
if($ret){
  print "Welcome Vulnerable Page<br>";
  while ($row = mysqli_fetch_row($ret)){
    print "TITLE : $row[1]<br>";
    print "TEXT : $row[2]<br>";
  }
}
?>
