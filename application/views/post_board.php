<style>
    .wrap {
        padding: 50px;
    }
    .img{
        width: 120px;
        height: auto;
    }
    .img>img{
        width: 100%;
        height: auto;
    }
</style>

<body>
    <div class="wrap">
        <h2>Title : <?=$post[0]['title']?></h2>
        <h3>내용 : <?=$post[0]['des']?></h3>
        <p>날짜 : <?=$post[0]['created']?></p>
        <p>작성자 :<?=$post[0]['nikname']?> </p>
        <div class="img">
            <img alt="이미지 등록이 없습니다." src="/CodeIgniter/uploads/demo/<?=$post[0]['path']?>">
        </div>
        <ul class="pagination">
            <li class="page-item"><a class="page-link" href="/CodeIgniter/index.php/Index/index_list/1">목록으로 가기</a></li>
            <li class="page-item"><a class="page-link" href="/CodeIgniter/index.php/Index/update/<?=$post[0]['number']?>/">수정하기</a></li>
            <li class="page-item"><a id="delete" class="page-link" href="">삭제하기</a></li>
            <li class="page-item"><a class="page-link" href="/CodeIgniter/index.php/Index/coment/<?=$post[0]['number']?>/">댓글달기</a></li>
            <li class="page-item"><a id="imgDelete" class="page-link" href="/CodeIgniter/index.php/Index/pathDe/<?=$post[0]['number']?>/">이미지삭제</a></li>
        </ul>
    </div>
    <script>
        $("#imgDelete").click(function(e){
            e.preventDefault();
            $.ajax({
                type: "post",
                url: "<?=base_url()?>Index/pathDe/<?=$post[0]['number']?>",
                dataType: "html",
                processData: false,
                contentType: false,
                success: function(data) {
                    alert('삭제완료했습니다.');
                    location.href = `http://localhost/CodeIgniter/Index/show_data/<?=$post[0]['number']?>`
                },
                error: function(request, status, error) {
                    console.log("code:" + request.status + "\n" + "message:" + request.responseText + "\n" + "error:" + error);
                }
            })
        })
        $('#delete').click(function() {
            $.ajax({
                type: "post",
                url: "<?=base_url()?>index.php/Index/delete/<?=$post[0]['number']?>",
                dataType: "html",
                processData: false,
                contentType: false,
                success: function(data) {
                    alert('삭제완료했습니다.');
                    location.href = `http://localhost/CodeIgniter/Index/index_list/${data}`
                },
                error: function(request, status, error) {
                    console.log("code:" + request.status + "\n" + "message:" + request.responseText + "\n" + "error:" + error);
                }
            })

        })

    </script>
</body>

</html>
