<?php
require_once("util.php");


//文字コードの検証
if (!cken($_POST)){
    $encoding = mb_internal_encoding();
    $err = "Encoding Error! The expected encoding is " . $encoding;
    //エラーメッセージを出して、以下のコードをすべてキャンセルする
    exit($err);
}
//HTMLエスケープ(XSS対策)
$_POST = es($_POST);
?>

<?php
//名前
if (isset($_POST['name'])){
    $name = $_POST['name'];
} else {
    //未設定エラー
    $name = "";
}
//メールアドレス
if (isset($_POST['email'])){
    $email = $_POST['email'];
} else {
    //未設定エラー
    $email = "";
}
//問い合わせ
if (isset($_POST['message'])){
    $message = $_POST['message'];
} else {
    //未設定エラー
    $message = "";
}

//エラーメッセージを入れる配列
$errors = [];

//名前
if (empty($name)) {
    $errors[] = "名前を入力してください";
}
//メールアドレス
if (empty($email)) {
    $errors[] = "メールアドレスを入力してください";
}
//問い合わせ
if (empty($message)) {
    $errors[] = "問い合わせ内容を入力してください";
}
?>
<?php
mb_language("Japanese");
mb_internal_encoding("UTF-8");

$to = "ayapoooh917@gmail.com";
$title = "【お問い合わせ】" . $name;
$message = $message;
$headers = "From:". $email;
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>送信完了|PORTFOLIO</title>

    <!-- CSS -->
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
    <link rel="stylesheet" href="css/style.css">

    <!-- google-font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bangers&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@500&display=swap" rel="stylesheet">

</head>
<body>
<div id="thank_page">
<header id="thank">
    <h1>THANK YOU</h1>
</header>
<main>
<?php
if (count($errors) > 0){ ?>
<!------- エラーがあったとき ------->
<div id="receive">
    <p>入力内容をご確認いただき、再度送信をお願いいたします</p>
    <p class="error"><?php echo implode('<br>', $errors); ?></p>
    <a href="index.html#contact"><p class="button">戻る</p></a>
</div>
<?php } else if (mb_send_mail($to, $title, $message, $headers)){ ?>
<!-------エラーがなかったとき------->
<div id="receive">
<p>
    下記内容でお問い合わせ内容を受け取りました
</p>
<dl>
    <div class="flex">
        <dt>名前</dt>
        <dd><?php echo $name;?></dd>
    </div>
    <div class="flex">
        <dt>メールアドレス</dt>
        <dd><?php echo $email;?></dd>
    </div>
    <div>
        <dt>お問い合わせ内容</dt>
        <dd><?php echo $message;?></dd>
    </div>
</dl>
<a href="index.html"><p class="button">戻る</p></a>
</div>
<?php }?>




<footer>

    <p><small>2022&copy;SHOJO PORTFOLIO</small></p>

</footer>
</div>
</div>
</body>
</html>