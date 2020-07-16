<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="http://malsup.github.com/jquery.form.js"></script>
</head>

<body>
    <?php
      if(!isset($_SESSION['login'])){ //없으면 공백
        echo "<script>alert('로그인하세요'); history.back(1);window.open('/CodeIgniter/Register/index/',500,500);</script>";
      }
     ?>
    <form method="post" id="form" enctype="multipart/form-data" style="padding:10px;">
        <div class="form-group">
            <label for="exampleInputEmail1">제목</label>
            <input type="text" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="제목">

        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">내용</label>
            <input type="text" name="des" class="form-control" id="exampleInputPassword1"><br>
            첨부파일 <input type="file" name="userfile" size="33" />
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <script>
        $(document).ready(function() {
            $('#form').on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData($('form')[0]);
                if ($("#exampleInputEmail1").val() != "" && $("#exampleInputPassword1") != "") {
                    $.ajax({
                        type: "post",
                        url: '<?=htmlspecialchars(base_url())?>/Index/ajWrite',
                        data: formData,
                        dataType: "html",
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            console.log(data);
                            if (data) {
                                alert("게시글 작성 완료");
                                location.href = `http://localhost/CodeIgniter/Index/show_data/${data}`;
                            }else{
                                
                            }
                        },
                        error: function(request, status, error) {
                            console.log("code:" + request.status + "\n" + "message:" + request.responseText + "\n" + "error:" + error);
                        }
                    })
                } else {
                    alert("빈공간이 있음")
                }
            })
        })
        /*<form action="/CodeIgniter/index.php/Index/write"  method="post"  enctype="multipart/form-data">*/

    </script>
