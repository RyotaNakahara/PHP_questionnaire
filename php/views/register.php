<h1>registerページ</h1>
    <form action="<?php echo CURRENT_URI ?>" method="post">
        <div>
            id: <input type="text" name="id">
        </div>
        <div>
            pw: <input type="password" name="pwd">
        </div>
        <div>
            nickname: <input type="text" name="nickname">
        </div>
        <div>
            <input type="submit" value="ログイン">
        </div>
    </form>