<script>
    $(document).ready(function() {
        $('#form').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData($('form')[0]);
            $.ajax({
                type: 'post',
                url: '<?=htmlspecialchars(base_url())?>Register/login',
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    alert(data);
                    if (data=="true") {
                        setTimeout(function() {
                            opener.location.reload(); //부모창 리프레쉬
                            self.close(); //현재창 닫기
                        }, 2000); // 2초후 실행 1000당 1초
                    }
                },
                error: function(request, status, error) {
                    console.log("code:" + request.status + "\n" + "message:" + request.responseText + "\n" + "error:" + error);
                }
            })
        })
    })
</script>
<!--Coded with love by Mutiullah Samim-->

<body>
    <div class="container h-100" style="margin-top:100px;">
        <div class="d-flex justify-content-center h-100">
            <div class="user_card">
                <div class="d-flex justify-content-center form_container">
                    <form onsubmit="return false;" id="form" method="post">
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" name="email" class="form-control input_user" placeholder="username">
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" name="pwd" class="form-control input_pass" value="" placeholder="password">
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customControlInline">
                                <label class="custom-control-label" for="customControlInline">Remember me</label>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mt-3 login_container">
                            <button type="submit" name="button" class="btn login_btn">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
