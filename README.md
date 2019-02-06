# Security-PHP-board


각각의 성능에 따라 메인 페이지의 기능을 가지고 있는 디렉토리와 "index"

게시판 기능을 하는 디렉토리로 나누었습니다. "board"


#index

login.php - 로그인 기능

logout.php - 로그아웃 기능

member.php - 회원정보 저장소

member_find.php - 회원정보 찾기 기능 (미완성)

member_save.php - 회원정보를 수정시에 저장하는 기능

signin.php - 로그인 처리

signup.php - 회원가입 기능

PreTEST_login.php - prepared statement 로그인 기능 (미완성)

PreTEST_login_ok.php - prepared statement 로그인 처리 (미완성)

#board

upload - 파일 업로드시 저장되는 저장소

delete.php - 게시물 삭제 기능

download.php - 다운로드 페이지 (url로 직접 입력해서 접속)

list.php - 게시판 목록 페이지

modify.php - 글 수정 기능

modify_ok.php - 글 수정 처리

read.php - 게시글 클릭시 게시글 세부내용

vulnerable_read.php - 취약 게시판 (information_schema 실험)

write.php - 글쓰기 기능

write_ok.php - 글쓰기 처리
