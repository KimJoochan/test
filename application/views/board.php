<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
            margin:0;
            padding:0;
        }
        table,form{
            width:500px;
            margin:0 auto;
        }
        form{
            margin-top:50px;
        }
        table,tr,td{
            border:1px solid black;
            text-align:center;
            
        }
    </style>
</head>
<body>
    
    <table>
    <tr>
        <td>번호</td>
        <td>제목</td>
        <td>내용</td>
        <td>날짜</td>
    </tr>
    <?php
    $cnt=1;
    foreach($data as $key){
        echo "<tr><td>$cnt</td><td>$key->title</td><td>$key->description</td><td>$key->created</td></tr>";
        $cnt++;
    }
    ?>
    </table>
    <form action="http://localhost/CodeIgniter/index.php/Welcome/insert" method="post">
        제목:<input type="text" name="title"><br>
        내용:<input type="text" name="des"><br>
        <input type="submit">
    </form>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        

<?php
$conn = mysqli_connect(
    'localhost',
    'root',
    '',
    'open');
$data = mysqli_query($conn,"SELECT * FROM topic ");
$num = mysqli_num_rows($data);
$page = ($_GET['page'])?$_GET['page']:1;
$list = 2;
$block = 3;

$pageNum = ceil($num/$list); // 총 페이지
$blockNum = ceil($pageNum/$block); // 총 블록
$nowBlock = ceil($page/$block);

$s_page = ($nowBlock * $block) - 2;
if ($s_page <= 1) {
    $s_page = 1;
}
$e_page = $nowBlock*$block;
if ($pageNum <= $e_page) {
    $e_page = $pageNum;
}


echo "현재 페이지는".$page."<br/>";
echo "현재 블록은".$nowBlock."<br/>";

echo "현재 블록의 시작 페이지는".$s_page."<br/>";
echo "현재 블록의 끝 페이지는".$e_page."<br/>";

echo "총 페이지는".$pageNum."<br/>";
echo "총 블록은".$blockNum."<br/>";

for ($p=$s_page; $p<=$e_page; $p++) {
?>

    <a href="<?=$_SERVER['PHP_SELF']?>?page=<?=$p?>"><?=$p?></a>

<?php
}
?>
<div>
    <a href="<?=$_SERVER['PHP_SELF']?>?page=<?=$s_page-1?>">이전</a>
    <a href="<?=$_SERVER['PHP_SELF']?>?page=<?=$e_page+1?>">다음</a>
</div>

<table>
    <tr>
        <td>번호</td>
        <td>제목</td>
        <td>내용</td>
        <td>날짜</td>
    </tr>
<?php
$s_point = ($page-1) * $list;


$real_data = mysqli_query($conn,"SELECT * FROM topic LIMIT $s_point,$list");
$fetch = mysqli_fetch_array($real_data);
for ($i=$fetch['id']-2; $i<$fetch['id']; $i++) {
    echo $fetch['title'];

    }
    ?>
    </table>
        <?=$fetch['title']  ?>

<?php
    if ($fetch == false) {
        exit;
    }
?>

<!--         echo "<tr><td>$i</td><td>$fetch['title']</td><td>$fetch['description']</td><td>$fetch['created']</td></tr>"; -->
</body>
</html>