<?php
$level=((int)$level[0]['level'])+1;
if(!isset($_SESSION['login'])){ //없으면 공백
  echo "<script>alert('로그인하세요'); location.href='/CodeIgniter/Register/index/';</script>";
}
?>
<form action="/CodeIgniter/index.php/Index/comment" method="post">
  <div class="form-group">
    <input type="hidden" value=<?=$level?> name="level">
    <input type="hidden" value=<?=$number?> name="keynum">
    <label for="exampleInputEmail1">제목</label>
    <input type="text" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="답글의 제목">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">내용</label>
    <input type="text" name="description" class="form-control" id="exampleInputPassword1" placeholder="내용">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>