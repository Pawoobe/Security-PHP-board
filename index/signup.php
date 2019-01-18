<?php
// 회원가입시 입력하는 아이디,비밀번호,이메일값 등을 변수에 저장한다
$user_id = $_POST[user_id];
$user_pw = $_POST[user_pw];
$user_pw_check = $_POST[user_pw_check];
$user_name = $_POST[user_name];
$email = $_POST[email];
// referrer 검사
session_start();

if ($_SESSION['referer'] = $_SERVER['HTTP_REFERER']) {
} else {
  echo "<script> alert('잘못된 접근입니다.');</script>";
  echo "<meta http-equiv='refresh' content=\"0;url='/index/main.php'\">";
}
if( $user_id != '' && $user_pw != '' && $user_pw_check != '' && $user_name != '' && $email != ''){

    // mysqli_connect( IP Address , 사용자계정, 비밀번호 ); => 식별자 or False 반환
    $conn = mysqli_connect( 'localhost', 'root', '1234' );
    // MySQL 접속에 실패한다면,
    if( !$conn ){
        // die와 mysqli_errno()메서드 사용,
        // mysqli_errno() => 최신의 에러내용 출력 *ver PHP7
        die('MySQL connect ERROR : '.mysqli_errno( $conn ));
    }
    // #2 DB를 선택한다
    // mysqli_select_db(mysql식별자, db명);
    // mysql식별자 미입력시 최근 연결한 mysql이 자동으로 입력된다
    $ret = mysqli_select_db($conn, 'bbs');
    // True or False 반환
    if ( !$ret ){
        die('MySQL select ERROR : '.mysqli_errno( $conn ));
    }

    // #3 Query 실행
    // 중북되는 값 확인하기
    // $user_id : 사용자가 가입하려고 하는 아이디
    // 해당 아이디가 DB에 있는지 확인한다
    $sql = "SELECT * FROM user WHERE user_id='{$user_id}'";

    // mysqli_query( 변수 ); => 변수에 저장된 쿼리문을 실행한다
    // SELECT 구문은 resource or False 반환
    // 나머지 구문들은 True or False 반환
    $count = mysqli_query( $conn, $sql );

    // mysqli_num_rows( resource ); => 행의 개수 반환
    $num = mysqli_num_rows( $count );

    if ( $num > 0 ){  // 아이디가 이미 존재한다면 이전 페이지로 돌아가기
        echo "<script> alert('이미 존재하는 아이디입니다.');</script>";
        echo "<script>window.history.back();</script>";
        exit(0);
    }
    if ( $user_pw != $user_pw_check ){
        echo "<script> alert('비밀번호가 서로 일치하지 않습니다.');</script>";
        echo "<script>window.history.back();</script>";
        exit(0);
    }
    // 아이디가 존재 하지 않다면 회원가입
    $sql = "INSERT INTO user(user_id, user_pw, user_pw_check, user_name, email) VALUE( '$user_id', md5('$user_pw'), md5('$user_pw_check'), '$user_name', '$email')";
    $ret = mysqli_query( $conn, $sql );

    // True or False 반환
    if ( $ret ){
        echo "<script> alert('회원가입이 완료되었습니다');</script>";
        echo "<meta http-equiv='refresh' content=\"0;url='/index/main.php'\">";
        exit(0);
    }else{
        die('MySQL Query ERROR : '.mysqli_errno( $conn ));
    }

}else
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>회원가입 페이지</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  </head>

  <body>

    <div class="container"> <!--가운데로 보여짐 -->
      <form class="form-signin" method=POST>
        <h2 class="form-signin-heading">Please Sign Up</h2>
        <!--아이디-->
      <div>
        <input type="text" name="user_id" class="form-control" placeholder="User ID" required autofocus>
      </div>
        <!--비밀번호-->
      <div>
        <input type="password" name="user_pw" class="form-control" placeholder="Password" required>
      </div>
      <div>
        <input type="password" name="user_pw_check" class="form-control" placeholder="Password CHECK" required>
      </div>
        <!--이름-->
      <div>
        <input type="text" name="user_name" class="form-control" placeholder="Name" required>
      </div>
        <!--이메일-->
      <div>
        <input type="email" name="email" class="form-control" placeholder="Email Address" required>
      </div>
      <div>
        <button class = "btn btn-lg btn-primary btn-block" type="submit">Sign UP</button> <!--btn-primary 버튼을 파란색으로 설정 -->
      </div>
      </form>
      <div>
        <a href="/index/main.php">돌아가기</a>
      </div>
  </div>
</body>
</html>
