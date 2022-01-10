<?php
require_once("../util.php");

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
//会社名
if (isset($_POST['company_name'])){
    $company_name = $_POST['company_name'];
} else {
    //未設定エラー
    $company_name = "";
}
//担当者名
if (isset($_POST['name'])){
    $name = $_POST['name'];
} else {
    //未設定エラー
    $name = "";
}
//電話の種類
if (isset($_POST["tel"])){
    $telValues = ["携帯", "固定電話"];
    //正しい値か確認
    $isTel = in_array($_POST["tel"], $telValues);
    if ($isTel) {
        $tel = $_POST["tel"];
    } else {
        $tel = "";
    }
}
//電話番号
if (isset($_POST['tel_number'])){
    $tel_number = $_POST['tel_number'];
} else {
    //未設定エラー
    $tel_number = "";
}
//メールアドレス
if (isset($_POST['email'])){
    $email = $_POST['email'];
} else {
    //未設定エラー
    $email = "";
}
//問い合わせ内容
if (isset($_POST['message'])){
    $message = $_POST['message'];
} else {
    //未設定エラー
    $message = "";
}

//エラーメッセージを入れる配列
$errors = array();
$errors = [];

//会社名
if (empty($company_name)) {
    $errors[] = "会社名を入力してください";
}
//名前
if (empty($name)) {
    $errors[] = "名前を入力してください";
}
//電話の種類
if (empty($tel)) {
    $errors[] = "電話の種類を選択してください";
}
//電話番号
$pattern_h = "/[0-9]{10}/u";
$pattern_m = "/[0-9]{11}/u";
if (!empty($tel_number) && $tel == "固定電話") {
    if (1 != preg_match($pattern_h, $tel_number)) {
        $errors[] = "電話番号を入力してください";
    }
} 
if (!empty($tel_number) && $tel == "携帯") {
    if (1 != preg_match($pattern_m, $tel_number)) {
        $errors[] = "電話番号を入力してください";
    }
} 
//メールアドレス
if (empty($email)) {
    $errors[] = "メールアドレスを入力してください";
}
//問い合わせ内容
if (empty($message)) {
    $errors[] = "問い合わせ内容を入力してください";
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>株式会社LINK</title>

	<link rel="stylesheet" type="text/css" href="https://unpkg.com/ress/dist/ress.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="js/slick-1.8.1/slick/slick.css">

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Zen+Antique+Soft&display=swap" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Shippori+Antique+B1&display=swap" rel="stylesheet">
	<link rel="icon" type="image/png" href="img/logo.png">


</head>
<body>
	<header id="thank">
		<div class="flex header">
        <a href="index.html">
				<div class="flex title">
					<div class="img_box">
						<img src="img/logo.png" alt="ロゴ">
						<img src="img/logo2.png" alt="ロゴ" class="active">
					</div>				
					<h1 class="name">株式会社LINK</h1>
				</div>
			</a>
			<nav>
				<ul class="flex main_nav">
					<a href="about.html"><li>会社概要</li></a>
					<a href="work.html"><li>仕事を探す</li></a>
					<a href="company.html"><li>人材を探す</li></a>
				</ul>
			</nav>
		</div>
	</header>
    <?php
if (count($errors) > 0){ ?>
<!------- エラーがあったとき ------->
<div id="thank">
    <p class="mas">入力内容をご確認いただき、再度送信をお願いいたします</p>
    <div class="items">
        <p class="error"><?php echo implode('<br>', $errors); ?></p>
        <a href="consult.html"><p class="button">登録画面に戻る</p></a>
    </div>
    </div>
<?php } else { ?>
<!-------エラーがなかったとき------->
<div id="receive">
	<div class="mas">
		<p>送信ありがとうございます</p>
		<p>内容確認後、担当よりご連絡させていただきます</p>
	</div>
    <div class="items">
        <p class="sub">お問い合わせ内容</p>
        <dl>
        <div class="flex">
            <dt>会社名</dt>
            <dd><?php echo $company_name;?></dd>
        </div>
        <div class="flex">
            <dt>ご担当者様の名前</dt>
            <dd><?php echo $name;?></dd>
        </div>
        <div class="flex">
            <dt>お電話番号</dt>
            <dd><?php echo $tel;?>:<?php echo $tel_number;?></dd>
        </div>
        <div class="flex">
            <dt>メールアドレス</dt>
            <dd><?php echo $email;?></dd>
        </div>
        <div class="flex">
            <dt>お問い合わせ内容</dt>
            <dd><?php echo $message;?></dd>
        </div>
        </dl>
    </div>
<a href="index.html"><p class="button">ホームに戻る</p></a>
</div>
<?php }?>
<footer>
    <h1>株式会社LINK</h1>
    <div class="flex">
        <p>&#9743;099-620-3456</p>
        <p>&#9993;お問い合わせ</p>
    </div>
    <nav>
        <ul>
            <li><a href="index.html">ホーム</a></li>
            <li><a href="about.html">会社概要</a></li>
            <li><a href="work.html">仕事を探す</a></li>
            <li><a href="company.html">人材を探す</a></li>
        </ul>
    </nav>
    <p class="c"><small>2022&copy;shojo</small></p>
</footer>
</body>
</html>