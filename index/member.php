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
 // 보안 토큰 검증
 $token = bin2hex (openssl_random_pseudo_bytes(16));
 $_SESSION['token'] = $token;

  if (!$_SESSION['token'] or !$token)
  {
    echo "<script> alert('토큰이 올바르지 않습니다.')</script>";
    echo "<meta http-equiv='refresh' content=\"0;url='/index/main.php'\">";
  } else {
  }
$sql = "SELECT * FROM user WHERE user_id = '" .$_SESSION[user_id]."'";
  $result = mysqli_query( $conn, $sql );
  $row = mysqli_fetch_assoc( $result );

?>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTP-8">
    <title>회원정보수정</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

  </head>

  <body>

    <div class="container"> <!--가운데로 보여짐 -->
      <form name="memberForm" method="post" action="./member_save.php">
        <h2 class="form-member-heading">회원 정보 수정</h2>
        <div>
            <input type="text" name="user_name" class="form-control" value="<?php echo $row['user_name']; ?>" required>
        </div>
        <div>
            <input type="password" name="user_pw" class="form-control" placeholder="변경할 비밀번호" required>
        </div>
        <div>
            <input type="password" name="user_pw_check" class="form-control" placeholder="비밀번호 확인" required>
        </div>
        <!-- 5. 정보수정 버튼 클릭시 입력필드 검사 함수 member_save 실행 -->
        <div>
            <input type="button" value=" 정보수정 " onClick="member_save();">
        </div>
        <div>
            <td align="left" valign="middle"><a href="main.php">메인</a></td>
        </div>
    </table>
    </form>
<script>
function member_save()  //입력필드 검사함수
{
  var f = document.memberForm; // form을 f에 저장
if(f.user_pw.value == ""){ //입력폼 검사
  alert("비밀번호를 입력해주세요."); // 값이 없으면 경고창으로 메세시 출력후 함수 종료
  return false;
}
if(f.user_pw.value != f.user_pw_check.value){ // 비밀번호 확인이 서로 다르면 경고창으로 메세지 출력후 함수 종료
  alert("비밀번호가 서로 일치하지 않습니다.");
  return false;
}
f.submit(); // 검사가 성공이면 form을 submit 시킴
}
</script>
</html>
