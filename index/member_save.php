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
    if( !isset($_SESSION[is_login]) ){ // 세션값이 없을 때 = "로그인 전 상태"
      echo "<script> alert('로그인 정보가 없습니다.');</script>";
      echo "<script>window.history.back();</script>";
      exit(0);
 }

 if ($_SESSION['referer'] = $_SERVER['HTTP_REFERER']) {
 } else {
   echo "<script> alert('잘못된 접근입니다.');</script>";
   echo "<meta http-equiv='refresh' content=\"0;url='/index/main.php'\">";
 }
$id = $_POST['user_id'];
$name = $_POST['user_name'];
$pw = $_POST['user_pw'];
$pwc = $_POST['user_pw_check'];

 if($pw == ""){
   echo "<script> alert('비밀번호를 입력해주세요.');</script>";
   echo "<script>window.history.back();</script>";
  exit(0);
 }

 if($pw != $pwc){
   echo "<script> alert('비밀번호가 일치하지않습니다.');</script>";
   echo "<script>window.history.back();</script>";
  exit(0);
 }

$sql = "UPDATE user SET user_pw=".md5('$pw').", user_name='".$name."' WHERE user_id='".$_SESSION[user_id]."'";
$result = mysqli_query( $conn, $sql );

echo "<script> alert('회원정보가 수정되었습니다.');</script>";
?>

 <meta http-equiv='refresh'content="0;url='../index/main.php'">
