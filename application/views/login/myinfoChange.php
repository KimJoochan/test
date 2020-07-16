<div class="row justify-content-center" style="margin-top:100px;">
    <div class="col-sm-6" role="complementary">
        <div class="panel panel-default">
            <div class="panel-body table-responsive">
                <form method="post">
                    <table class="table table-bordered table-condensed f11">
                        <tr>
                            <td colspan="2" align="center" class="info"><b>Info</b></td>
                        </tr>
                        <tr>
                            <td><b>Email</b></td>
                            <td><input type="text" value="<?=$data[0]['email']?>" name="email"></td>
                        </tr>
                        <tr>
                            <td><b>Name</b></td>
                            <td><input type="text" value="<?=$data[0]['name']?>" name="name"></td>
                        </tr>
                        <tr>
                            <td><b>NickName</b></td>
                            <td><input type="text" value="<?=$data[0]['nikname']?>" name="nikname"></td>
                        </tr>
                    </table>
                    <button class="btn btn-success" id="change" type="submit">수정하기</button>
                    <button class="btn btn-secondary">취소하기</button>
                </form>
            </div>
        </div>
    </div>

</div>
<script>
    $("form").on('submit', function(e) {
        e.preventDefault();
        console.log('usb');
        var formData = new FormData($('form')[0]);
        $.ajax({
            type: "post",
            url: '<?=base_url()?>index.php/Register/myinfoChangeProcess',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                if (data==<?=$_SESSION['id']?>) {
                    location.href="/CodeIgniter/index.php/Register/myinfo/";
                } else {

                }
            },
            error: function(request, status, error) {
                console.log("code:" + request.status + "\n" + "message:" + request.responseText + "\n" + "error:" + error);
            }
        });
    })

</script>
