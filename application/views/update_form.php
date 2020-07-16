<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="http://malsup.github.com/jquery.form.js"></script>
</head>

<body>
    <form method="post" id="form" enctype="multipart/form-data">
        <div class="form-group">
            <input type="hidden" name="number" value="<?=$post[0]['number']?>">
            <label for="exampleInputEmail1">제목</label>
            <input type="text" value="<?=$post[0]['title']?>" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">내용</label>
            <input type="text" value="<?=$post[0]['des']?>" name="des" class="form-control" id="des">
        </div>
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        첨부파일 <input type="file" id="file" name="userfile" size="33" />
        <button type="submit" class="btn btn-danger">수정하기</button>
        <button type="button" id="cancel" class="btn btn-primary">취소하기</button>
    </form>
    <script>
        $('#cancel').click(function() {
            location.href="<?=base_url()?>index.php/Index/";
        })
        $(document).ready(function() {
            $('#form').on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData($('form')[0]);
                $.ajax({
                    type: "post",
                    url: '<?=base_url()?>index.php/Index/update_process',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        console.log(data);
                        if (data) {
                            alert("게시글 수정 완료");
                            location.href = `http://localhost/CodeIgniter/Index/show_data/${data}`;
                        }
                    },
                    error: function(request, status, error) {
                        console.log("code:" + request.status + "\n" + "message:" + request.responseText + "\n" + "error:" + error);
                    }
                })


            })
        })

    </script>
