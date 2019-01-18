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
$id = $_POST[user_id];
$pw = $_POST[user_pw];

  if (!empty ($_POST['user_id'] && $_POST['user_pw'])) {
    $check = trim ($_POST['user_id'] && $_POST['user_pw']);
    if ($check){
      $stmt = $conn -> prepare ($query = "INSERT INTO user VALUES (?)");
      $stmt -> bind_param('ss', $check);
      $stmt -> execute();
      echo "<script> alert('완료 되었습니다.');</script>";
      mysqli_query($conn, $query);
    } else {
      echo "<script> alert('아이디 또는 패스워드가 올바르지 않습니다.');</script>";
    }
  }
?>
 <meta http-equiv='refresh'content="0;url='/index/PreTEST_login.php'">
