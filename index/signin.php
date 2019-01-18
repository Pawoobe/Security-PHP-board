<?php
// #1 MySQL 접속
$conn = mysqli_connect('localhost', 'root', '1234');
if( !$conn ){
    die('MySQL connect ERROR : ' . mysqli_errno());
}
// #2 DB 접속
$ret = mysqli_select_db($conn, 'bbs');
if (!$ret) {
    die('MySQL select ERROR : '. mysqli_errno());
    }
// 세션 사용 선언
// referrer 검사
session_start();

if ($_SESSION['referer'] = $_SERVER['HTTP_REFERER']) {
} else {
  echo "<script> alert('잘못된 접근입니다.');</script>";
  echo "<meta http-equiv='refresh' content=\"0;url='/index/main.php'\">";
}

// 보안 토큰 검증
 if (!$_SESSION['token'])
 {
   echo "<script> alert('토큰이 올바르지 않습니다.')</script>";
   echo "<meta http-equiv='refresh' content=\"0;url='/index/main.php'\">";
 } else {
 }

$id = $_POST[user_id];
$pw = $_POST[user_pw];

// user테이블에서 입력받은 아이디와 비밀번호가 일치하는 데이터 검색
$sql = "SELECT * FROM user WHERE user_id = '$id' and user_pw = md5('$pw')"; //md5 : 128비트 암호화 해시 함수 해당 비밀번호를 받아 암호화 시켜서 저장
  $count = mysqli_query( $conn, $sql );
  $num = mysqli_num_rows( $count ); //결과로 터 행의 개수를 반환받음
  $assoc = mysqli_fetch_assoc( $count ); // 인출된 행을 연관배열로 반환하고 내부 데이터 포인터 바로 앞에 이동
// -> $assoc : Array=( [no]=>사용자 식별번호, [user_id]=>아이디, [user_pw]=>비밀번호, [email]=>이메일 )

    if ( $num ) {
        $sess_id = session_id();
      $sql = "INSERT INTO user VALUE( $row[no], '$id','$sess_id')";  //비밀번호 넣기
        // 사용자 식별번호, 아이디, 세션아이디 값을 세션테이블에 저장시킨다
        // 다음 로그인 시 해당 테이블에 데이터 존재유무를 통해 로그인중인지 아닌지 판단한다
        mysqli_query ($conn, $sql);
        // # 세션변수에 데이터 추가
        $_SESSION[user_id] = $id;
        $_SESSION[is_login] = 1;
        echo "<script> alert('로그인 되었습니다.');</script>";
    }else{
    echo "<script> alert('아이디 또는 패스워드가 올바르지 않습니다.');</script>";
}

?>

 <meta http-equiv='refresh'content="0;url='/index/main.php'">
