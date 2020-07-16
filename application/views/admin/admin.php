<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    caption {
        caption-side: top;
    }

    .user {
        width: 40%;
    }
    .admin{
        width: 50%;
    }
    .flex{
        display: flex;
        flex-direction: row;
        justify-content: space-around;
    }
</style>
<div class="flex">
    <table class="table table-bordered user">
        <caption>
            <h3>User Info</h3>
        </caption>
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">email</th>
                <th scope="col">name</th>
                <th scope="col">nikname</th>
                <th scope="col">grad</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($info as $item => $value){?>
            <tr>
                <th scope="row"><?=$item+1?></th>
                <td><?=$value['email']?></td>
                <td><?=$value['name']?></td>
                <td><?=$value['nikname']?></td>
                <td><?=$value['grad']?></td>
                <td><a class="btn" href="delete?id=<?=$value['id']?>"><i class="fa fa-close"></i>삭제하기</a></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <table class="table table-bordered admin">
        <caption>
            <h3>User Info</h3>
        </caption>
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">title</th>
                <th scope="col">작성자</th>
                <th scope="col">날짜</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($board as $item => $value){?>
            <tr>
                <th scope="row"><?=$item+1?></th>
                <td><?=$value['title']?></td>
                <td><?=$value['nikname']?></td>
                <td><?=$value['created']?></td>
                <td><a class="btn" href="delete?id=<?=$value['number']?>"><i class="fa fa-close"></i>삭제하기</a></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
