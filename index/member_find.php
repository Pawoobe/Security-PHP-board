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

if( isset($_SESSION['user_id']) ){ //로그인 후 상태
  echo "<script> alert('잘못된 접근입니다.');</script>";
  echo "<script>window.history.back();</script>";
  exit(0);
}
if($_POST['user_name'] == '' || $_POST['email'] == ''){
  echo "<script> alert('잘못된 접근입니다.');</script>";
  echo "<script>window.history.back();</script>";
  exit(0);
}else{

  $user_name = $_POST['user_name'];
  $email = $_POST['email']

$sql = "SELECT * FROM user WHERE user_name = '{$user_name}' AND email = '{$email}'";
//$sql = "SELECT * FROM user WHERE user_id = '{$id}' and user_pw = md5('{$pw}')";
$result = $sql->fetch_array();

if($result["user_name"] == $user_name){
  echo "<script> alert('회원님의 ID는 ".$result['id']."입니다.');</script>";
  echo "<script>window.history.back();</script>";
}else{
  echo "<script> alert('존재하지 않는 계정입니다.');</script>";
  echo "<script>window.history.back();</script>";
}
}


?>
<!DOCTYPE html>
<head>
  <meta charset="utf-8" />
  <title>계정 찾기</title>
</head>
<body>
  <div class="find">
    <form method="post" action="member_find_id.php">
      <h1>회원 계정 찾기</h1>
      <fieldset>
        <legend>아이디 찾기</legend>
        <table>
          <tr>
            <td>이름</td>
            <td><input type="text" size="35" name="name" placeholder="Name"></td>
          </tr>
          <tr>
            <td>이메일</td>
            <td><input type="email" name="email" class="form-control" placeholder="Email Address"></td>
          </tr>
        </table>
        <input type="submit" value="아이디 찾기" />
      </fieldset>
    </form>
  </div>
  <div class="find">
    <form method="post" action="member_find_pw.php">
      <fieldset>
        <legend>비밀번호 찾기</legend>
        <table>
        <tr>
          <td>아이디</td>
          <td><input type="text" size="35" name="user_id" placeholder="User ID"></td>
        </tr>
        </table>
          <input type="submit" value="비밀번호 찾기" />
        </fieldset>
        <p><a href="http://localhost/index/main.php">메인으로</a></p>
      </form>
  </div>
</body>
</html>

<?php
}
?>
