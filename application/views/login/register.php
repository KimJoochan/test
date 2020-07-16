<body>
    <div class="container">
        <div class="card bg-light">
            <article class="card-body mx-auto" style="max-width: 400px;">
                <form method="post">
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                        </div>
                        <input name="name" class="form-control" placeholder="Full name" type="text" value="<?php if(!empty($name)){echo $name;}?> ">
                    </div> <!-- form-group// -->
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-address-book" aria-hidden="true"></i> </span>
                        </div>
                        <input name="nickname" class="form-control" placeholder="nick name" type="text" value="<?php if(!empty($nickname)){echo $nickname;}?>">
                    </div> <!-- form-group// -->
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                        </div>
                        <input name="email" value="<?php if(!empty($email)){echo $email;}?>" class="form-control" placeholder="Email address">
                    </div> <!-- form-group// -->
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                        </div>
                        <input type="text" name="password" class="form-control" placeholder="Create password">
                    </div> <!-- form-group// -->
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                        </div>
                        <input name="re_password" class="form-control" placeholder="Repeat password" type="text">
                    </div> <!-- form-group// -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block"> Create Account </button>
                    </div> <!-- form-group// -->
                </form>
                <script>
                    $('form').on('submit', function(e) {
                        e.preventDefault();
                        var formData = new FormData($('form')[0]);
                        $.ajax({
                            url: "<?=base_url()?>index.php/Register/register",
                            type: 'post',
                            dataType: "html",
                            processData: false,
                            data: formData,
                            contentType: false,
                            success: function(data) {
                                alert(data);
                                if (data == "회원가입완료") {
                                    location.href = "<?=base_url()?>index/index_list";
                                }
                            },
                            error: function(request, status, error) {
                                console.log("code:" + request.status + "\n" + "message:" + request.responseText + "\n" + "error:" + error);
                            }
                        })
                    })

                </script>
                <?php if(!empty($er)){echo "<div class='alert alert-danger'>$er</div>";}?>
            </article>
        </div> <!-- card.// -->

    </div>
    <!--container end.//-->



</body>
