 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
 <div class="container">
     <table class="table table-striped">
         <thead>
             <tr>
                 <th>번호</th>
                 <th>title</th>
                 <th>des</th>
                 <th>date</th>
                 <th>hit</th>
             </tr>
         </thead>
         <tbody>
             <?php
if  (empty($post)){// $post값이 비어있는지 검사, 참이라면 if문 실행
	echo  '<tr><td>'.'이 카테고리에 작성된 글이 없습니다'.'</td></tr>';
}else
{	$cnt=1;
	// $post값이 비어있지 않다면 foreach문 실행, 
	foreach($post  as  $list){
		$space="";
		for($i =0; $i<$list->level;$i++){
			$space=$space."-";
		}
		echo '<tr>
		<td>'.$cnt++.'</td>
	<td><span>'.$space.'</span>'.$list->title.'</td>
	<td><a href="'.base_url().'index.php/Index/show_data/'.$list->number.'">'.$list->des.'</a></td>
	<td>'.$list->created.'</td>
	<td>'.$list->hit.'</td>
  </tr>
		';
	}
}
?>
         </tbody>
     </table>
     <nav aria-label="Page navigation example">
         <ul class="pagination">
             <?php
$len  =  '';
foreach($post_all  as  $list):
$len  =  $len.$list->number;
// 모든 게시물의 갯수를 받아와서 $len에 저장
endforeach;

$count=strlen($len)  /  6;
// 게시물의 갯수를 5로 나눈다
$page_count  =  ceil($count);
// 반올림해서 page_count에 저장
$strTok  =  explode('/'  , uri_string());
// 현재 페이지의 url을 /를 기준으로 나눈다
if(empty( $strTok[2])){
	$page_now=1;
}else{
	$page_now  =  $strTok[2];
}
// 페이지 번호(2페이지라면 값은 2)를 $page_now에 저장
if  ($page_now  ==  1) 
{
	echo  '';
}
else 
{
	$page_move  =  $page_now  -  1;
	echo  '<li class="page-item"><a class="page-link" href="/CodeIgniter/Index/index_list/'.$page_move.'/"><span class="glyphicon glyphicon-fast-backward">pre</span></a></li>';
}
// 페이지가 1번일때는 pass, 그 외의 경우에는 뒤로가기 버튼 생성
for  ($i=1;  $i  <=  $page_count;  $i++) 
{
	echo  '<li class="page-item"><a class="page-link" href="/CodeIgniter/Index/index_list/'.$i.'?'.$_SERVER['QUERY_STRING'].'" class="paging-num">'.$i.'</a></li>';
}
// 페이지 갯수만큼 바로가기 버튼 생성

if($page_count  ==  $page_now) 
{
	echo  '';
}
else  if  ($page_count  >  1) 
{
	$page_move  =  $page_now  +  1;
	echo  '<li class="page-item"><a class="page-link" id="btn-next" href="/CodeIgniter/Index/index_list/'.$page_move.'"><span class="glyphicon glyphicon-fast-forward">next</span></a></li>';
}
// 마지막 페이지 번호인 page_count와 현재 페이지 번호인 page_now를 대조해서 참이 pass, 참이 아니라면 앞으로가기 버튼 생성

?>
             <li class="page-item"><a href="/CodeIgniter/Index/write" class="paging-num page-link">글쓰기</a></li>
         </ul>
     </nav>
     <div class="search-container">
        <form method="get" id="search" action="<?=base_url()?>Index/index_list">
            <select name="category">
                <option value="">검색창</option>
                <option value="title">제목</option>
                <option value="nikname">작성자</option>
            </select>
             <input type="text" placeholder="Search.." name="search">
             <button type="submit"><i class="fa fa-search"></i></button>
         </form>
     </div>
     <script>
//         $('#search').on('submit', function(e) {
//             e.preventDefault();
//             var formData = new FormData($('form')[0]);
//             $.ajax({
//                 type: "post",
//                 url: ,
//                 data: formData,
//                 processData: false,
//                 contentType: false,
//                 success: function(data) {
//                     console.log(data);
//                     if (data) {
//                         console.log(data);
//                     }
//                 },
//                 error: function(request, status, error) {
//                     console.log("code:" + request.status + "\n" + "message:" + request.responseText + "\n" + "error:" + error);
//                 }
//
//             })
//         })

     </script>

 </div>
 </body>
