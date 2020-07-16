  <style>
        *{
            margin: 0;
            padding: 0;
        }
        button{
            margin-right: 20px;
        }
        #grad{
            width: 40px;
            height: auto;
        }
        #grad>img{
            width: 100%;
            height: auto;
            float: left;
        }
    </style>
</head>
<script>
    $(document).ready(function() {
        console.log(123);
        $("#login").click(function() {
            window.open('/CodeIgniter/index.php/Register/index/', "Login", "width=570, height=350, resizable = no, scrollbars = no");
        });
        $("#logout").click(function() {
            location.href = ("/CodeIgniter/Register/loginout/");
        });
        $("#mypage").click(function() {
            location.href = "/CodeIgniter/Register/myinfo/";
        })
        $("#join").click(function(){
            location.href="/CodeIgniter/Register/join/";
        });
        $("#admin").click(function(){
            location.href="/CodeIgniter/Register/admin/";
        })
    })

</script>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/CodeIgniter/index/index_list">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/CodeIgniter/index.php/">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>

            <li class="nav-item">
                <a class="nav-link disabled" href="#">Disabled</a>
            </li>
        </ul>
        <?php
    if(!empty($_SESSION["login"])){
    ?>
        <p id="grad"><?php if($_SESSION['grad']=="user"){?>
        <img src="<?=htmlspecialchars(base_url())?>/uploads/user1.png">
        <?php } else if($_SESSION['grad']=="admin"){?>
        <img src="<?=htmlspecialchars(base_url())?>/uploads/admin.png">
        </p>
        <button type="button" class="btn btn-danger" id="admin" >페이지관리</button>
        <?php }?>
        <p><?=$_SESSION['nikname']?>님 반갑습니다.</p>
        <button type="button" class="btn btn-primary" id="logout" >Logout</button>
        <button type="button" class="btn btn-primary" id="mypage">마이페이지</button>
        <?php }else{ ?>
        <button type="button" class="btn btn-secondary" id="login">Login</button>
        <button type="button" class="btn btn-secondary" id="join">Join</button>
        <?php } ?>
    </div>
</nav>
