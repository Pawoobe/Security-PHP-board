<?php
// 세션사용을 하기위한 필수메서드, 세션사용선언
session_start();
// #1 MySQL 연결
$conn = mysqli_connect('localhost', 'root', '1234');
if( !$conn ){
    die('MySQL connect ERROR : ' . mysqli_errno());
}
// #2 DB접속
$ret = mysqli_select_db($conn, 'bbs');
if( !$ret ){
    die('MySQL select ERROR : '. mysqli_errno());
}

// 보안 토큰 생성
$token = bin2hex (openssl_random_pseudo_bytes(16));
$_SESSION['token'] = $token;

?>
<!-- 게시판 HTML소스코드 !-->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>login Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  </head>
  <nav class="navbar navbar-inverse navbar-fixed-top"> <!--부트 스트랩 이용 / 네이게이션바 : 맨위로 올리며, 검은색 배경이용 / 입력 창 크기를 조절해줌-->
  <body>
<?php
if(!isset($_SESSION[is_login])){
   ?>
  <form method=POST action=signin.php>
    <div class="form-group">
      <input name="token" type= "hidden" value= "<?php echo $_SESSION['token']; ?>" />
    </div>
   <div class="form-group">
     <input type="text" name="user_id" placeholder="USER ID" class="form-control">
   </div>
   <div class="form-group">
     <input type="password" name="user_pw" placeholder="Password" class="form-control">
  </div>
  <button type="submit" class="btn btn-success">로그인</button>
  </nav>
  </form>
<?php
}
?>
</body>
</html>
