<?php

/**
 * 両端の空白を除去する関数です。マルチバイトを含みます。
 * 参考 https://qiita.com/fallout/items/a13cebb07015d421fde3
 */
function mbTrim($pString)
{
    return preg_replace('/\A[\p{Cc}\p{Cf}\p{Z}]++|[\p{Cc}\p{Cf}\p{Z}]++\z/u','',$pString);
}

//入力値を確認する(投稿者)
$is_valid_author_name=true;
$input_author_name='';
if(isset($_POST['author_name'])){
    $input_author_name=mbTrim(str_replace("\r\n","\n",$_POST['author_name']));
}else{
    $is_valid_author_name=false;
}

if($is_valid_author_name&&mb_strlen($input_author_name)>30){
    $is_valid_author_name=false;
}

// 入力値を確認する（投稿内容）
$is_valid_message=true;
$input_message='';
if(isset($_POST['message'])){
    $input_message=mbTrim(str_replace("\r\n","\n",$_POST['message']));
}else{
    $is_valid_message=false;
}
if($is_valid_message&&$input_message===''){
    $is_valid_message=false;

if($is_valid_message&&mb_strlen($input_message)>1000){
    $is_valid_message=false;
}
// 投稿をデータベースへ保存する処理
if($is_valid_author_name&&$is_valid_message){
    if($input_author_name===''){
        $input_author_name='匿名さん';
    }
}
 // INSERT クエリを作成する
 // :author_name、:message はプレースホルダという。
 //後で $stmt->bindValue を使用して値をセットするときのニックネームのようなもの。
 //自分で決められる。

$query='INSERT INTO posts(author_name,message)VALUES(:author_name,:message)';

// SQL 実行の準備 (実行はされない)
$stmt=$dbh->prepare($query);

// プレースホルダに値をセットする
$stmt->bindValue(':author_name',$input_author_name,PDO::PARAM_STR);
$stmt->bindValue(':message',$input_message,PDO::PARAM_STR);

 // クエリを実行する
 $stmt->execute();
}

header('Location: /');
exit();
?>
