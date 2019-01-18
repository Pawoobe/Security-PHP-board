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
// referrer 검사
session_start();

if ($_SESSION['referer'] = $_SERVER['HTTP_REFERER']) {
} else {
  echo "<script> alert('잘못된 접근입니다.');</script>";
  echo "<meta http-equiv='refresh' content=\"0;url='../index/main.php'\">";
}

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
          <a class="navbar-brand" href="../index/main.php">메인</a>
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
<?php
  $number = $_GET['number'];
  $result = mysqli_query ($conn, "SELECT * FROM board WHERE number='".$number."'");
  $row = mysqli_fetch_array ($result);
?>
<div id="board_read">
    <h2><?php echo ("$row[title]"); ?></h2>
      <div id="user_id">
          <?php echo $row['name']; ?> <?php echo $row['write_time']; ?>
          <div id="board_line"></div>
      </div>
      <div id="board_text">
        <?php
              // echo strip_tags ("$row[text]", "<p><br>");
              echo $row["text"];
        ?>
      </div>
      <div>
          <img src="uploads/<?php echo $row['file'];?>" width="200" height="300">
      </div>
      <div>
        파일 : <a href="uploads/<?php echo $row['file'];?>" download><?php echo $row['file']; ?></a>
      </div>
<!--목록, 수정, 삭제 -->
<div id="board_ser">
    <ul>
      <li><a href="list.php">목록으로</a></li>
      <li><a href="modify.php?number=<?php echo $row['number']; ?>">수정</a></li>
      <li><a href="delete.php?number=<?php echo $row['number']; ?>">삭제</a></li>
    </ul>
</div>
</body>
</html>
