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
          <a class="navbar-brand" href="../index/main.php">메인</a>
        </div>
      </div>
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
      <a href="../index/logout.php">
        <button type="button" class="btn btn-success">로그아웃</button>
      </a>
    </div>
  </div>
  </nav>
</nav>
  <div class="jumbotron"> <!--배경색 -->
  <div class="container">
      <table class="table table-boarded table-striped"> <!--표 처럼 만들어줌-->
        <thead>
          <tr>
            <th> 번호 </th>
            <th> 게시글 제목 </th>
            <th> 작성자 </th>
            <th> 작성시간 </th>
          </tr>
        </thead>
      <tbody>
<?php

$resource = mysqli_query ( $conn, "SELECT * FROM board" );
//board테이블의 데이터 개수를 저장
$total_len = mysqli_num_rows ( $resource );

if ( isset($_GET[idx])) { //GET메서드로 출력할 시작번호가 넘어옴
    $start = $_GET[idx] * 10; //10개씩 화면에 출력
                              //$start = board 테이블 x번째 데이터를 지정
    $sql = "SELECT * FROM board ORDER BY number DESC LIMIT $start, 10"; //'$start'번째 데이터에서 부터 10개의 데이터를 가져온다 'no'를 기준으로 해서 내림차순으로 데이터들을 가져온다
} else{
    $sql = "SELECT * FROM board ORDER BY number DESC LIMIT 10";
}
// resource변수에 10개의 데이터드를 저장한다
$resource = mysqli_query( $conn, $sql );

$num=1; //게시글 번호
while( $row = mysqli_fetch_assoc( $resource )){
    print "<tr>";
    echo "<th> $num </th>";
?>
    <td class="title">
    <a href="read.php?number=<?php echo $row['number']?>"><?php echo $row['title']?></a>
    </td>
<?php
    print "<td> $row[user_id] </td>";
    print "<td> $row[write_time] </td>";
    print "</tr>";

    $num++;
}

//게시글 목록 페이지 개수(count) = 총 게시글수 / 10
$count = (int)( $total_len / 10 );
//마지막 게시글 목록의 게시글 개수가 1개이상, 10개 이하인 경우 게시글목록개수+1
if ( $total_len % 10){ $count++; }

    print "<tr>";
    print "<td colspan=4 align=center>";
    for ( $i = 0; $i < $count; $i++ ){ //변수i와 게시글 목록개수 비교
        //게시글 목록 번호를 idx변수에 넣고 GET메서드로 전송한다
      print "<a href=/board/list.php?idx={$i}>";
      $j = $i + 1;
      print "[{$j}]";   //게시글 목록 번호 : "[1][2]"
      print "</a>";
    }
    print "</td>";
    print "</tr>";
?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
  <!--
    <form method=get action="/board/search.php">
      <select name="catgo">
        <option value="title">제목</option>
        <option value="text">내용</option>
        <option value="name">글쓴이</option>
      </select><input type=type name=search_word size=20><input type=submit value="검색">
    </form>
  -->
      <div class="navbar-header">
        <a href="/board/write.php">
          <button type="button" class="btn btn-success btn-lg">글쓰기</button>
        </a>
      </div>
      <div class="navbar-header">
        <a href="/board/vulnerable_read.php">
          <button type="button" class="btn btn-danger btn-sm">취약게시판</button>
        </a>
      </div>
      <div class="navbar-header">
        <a href="../index/PreTEST_login.php">
          <button type="button" class="btn btn-danger btn-sm">prepared 페이지</button>
        </a>
      </div>
</body>
</html>
