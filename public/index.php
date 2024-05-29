<?php
session_start();
require_once(__DIR__. '/../src/db_connect.php');
if(isset($_POST['action_type'])&&$_POST['action_type']){
    if($_POST['action_type']==='insert'){
        require(__DIR__. '/../src/insert_message.php');
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible"content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots"content="noindex"/>
    <title>ひとこと掲示板</title>
    <link rel="stylesheet"href="./assets/main.css"/>
</head>
<body>
    <div class="page-cover">
        <p class="page-title">ひとこと掲示板</p>
        <hr class="page-divider"/>
         <div class="form-cover">
            <form action="/" method="post">
                <div class="form-input-title">投稿者ニックネーム</div>
                <input
                type="text"
                name="author_name"
                maxlength="40"
                value=""
                class="input-author-name"/>
                <div class="form-input-error">
                </div>
                <div class="form-input-title">投稿内容<small>(必須)</small></div>
                <textarea name="message" class="input-message"></textarea>
                <div class="form-input-error">
                </div>
                <input type="hidden"name="action_type"value="insert"/>
                <button type="submit"class="input-submit-button">投稿する</button>
            </form>
         </div>
    <hr class="page-divider"/>
    <div class="message-list-cover"> </div>
    </div>
</body>
</html>