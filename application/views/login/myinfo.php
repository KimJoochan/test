
<div class="row justify-content-center" style="margin-top:100px;">
    <div class="col-sm-6" role="complementary">
        <div class="panel panel-default">
            <div class="panel-body table-responsive">
                <table class="table table-bordered table-condensed f11">
                    <tr>
                        <td colspan="2" align="center" class="info"><b>Info</b></td>
                    </tr>
                    <tr>
                        <td><b>Email</b></td>
                        <td><?=$data[0]['email']?></td>
                    </tr>
                    <tr>
                        <td><b>Name</b></td>
                        <td><?=$data[0]['name']?></td>
                    </tr>
                    <tr>
                        <td><b>NickName</b></td>
                        <td><?=$data[0]['nikname']?></td>
                    </tr>
                </table>
                <button class="btn" id="btn">개인정보 수정</button>
                <button class="btn" id="list">목록으로</button>
            </div>
        </div>
    </div>
    <script>
        $('#btn').click(function(){
            location.href="/CodeIgniter/Register/myinfoShow/";
        })
        $('#list').click(function(){
            location.href="/CodeIgniter/index/index_list";
        })
    </script>
