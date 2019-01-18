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

 if ($_SESSION['token'] != $token)
 {
   echo "<script> alert('토큰이 올바르지 않습니다.')</script>";
 } else {
 }
$number = $_GET['number'];
$result = mysqli_query($conn, "SELECT * FROM board WHERE number=$number");
$row = mysqli_fetch_array ($result);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>게시판</title>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  </head>
  <body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="/../main.php">메인</a>
          <a class="navbar-brand" href="/board/list.php">게시판</a>
        </div>
      </div>
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <a href="../index/logout.php">
        <button type="button" class="btn btn-success">로그아웃</button>
      </a>
    </div>
  </div>
  </nav>
</nav>
    <div class="jumbotron">
      <div class="container">

    <form method=POST action=modify_ok.php?number=<?php echo $row['number']; ?> enctype="multipart/form-data" >
        <label for="title">제목</label>
        <div>
          <textarea cols="60" name="title" id="title" placeholder="제목"> <?php echo $row['title']; ?></textarea>
        </div>
        <div>
          <label for="content">게시글</label>
          <div>
            <textarea cols="60" rows="20" name="text" placeholder="글 내용"><?php echo $row['text']; ?></textarea>
          </div>
        </div>
        <div>
            <button type="submit" class="btn btn-default">작성완료</button>
          </div>
        </div>
    </div>
  </form>
</body>
</html>
