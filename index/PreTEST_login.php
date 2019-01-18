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
    <title>testing..</title>
  </head>
  <h2> Prepared Statment TESTING </h2>
  <body>
    <form method="POST" action="PreTEST_login_ok.php">
      <div>
        <input type="text" name="user_id" placeholder="USER ID" class="form-control">
      </div>
      <div>
        <input type="password" name="user_pw" placeholder="Password" class="form-control">
     </div>
     <button type="submit" class="btn btn-success">로그인</button>
  </body>
</html>
