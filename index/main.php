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
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Main Page</title>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  </head>
  <body>
<?php
    if( !isset($_SESSION[is_login]) ){ // 세션값이 없을 때 = "로그인 전 상태"
?>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="main.php">메인</a>
          <a class="navbar-brand" href="login.php">로그인</a>
          <a class="navbar-brand" href="../board/list.php">게시판</a>
          <a class="navbar-brand" href="signup.php">회원가입</a>
<?php

}else{    // 세션값이 존재 = "로그인 된 상태" => 아이디 비밀번호 입력 폼 화면에 출력x

?>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="main.php">메인</a>
          <a class="navbar-brand" href="logout.php">로그아웃</a>
          <a class="navbar-brand" href="../board/list.php">게시판</a>
          <a class="navbar-brand" href="member.php">회원정보수정</a>
<?php
} ?>
  </body>
</html>
