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
//苗字
if (isset($_POST['l_name'])){
    $l_name = $_POST['l_name'];
} else {
    //未設定エラー
    $l_name = "";
}
//名前
if (isset($_POST['name'])){
    $name = $_POST['name'];
} else {
    //未設定エラー
    $name = "";
}
//性別
if (isset($_POST["gender"])){
    $genderValues = ["男", "女"];
    //正しい値か確認
    $isGender = in_array($_POST["gender"], $genderValues);
    if ($isGender) {
        $gender = $_POST["gender"];
    } else {
        $gender = "";
    }
}
//生年月日
if (isset($_POST['year'])){
    $year = $_POST['year'];
} else {
    //未設定エラー
    $year = "";
}
if (isset($_POST['month'])){
    $month = $_POST['month'];
} else {
    //未設定エラー
    $month = "";
}
if (isset($_POST['day'])){
    $day = $_POST['day'];
} else {
    //未設定エラー
    $day = "";
}
//電話の種類
if (isset($_POST["tel"])){
    $telValues = ["携帯", "自宅"];
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

//エラーメッセージを入れる配列
$errors = array();
$errors = [];

//苗字
if (empty($l_name)) {
    $errors[] = "名前を入力してください";
}
//名前
if (empty($name)) {
    $errors[] = "名前を入力してください";
}
//性別
if (empty($gender)) {
    $errors[] = "性別を選択してください";
}
//日付の妥当性チェック
$isDate = checkdate($month, $day, $year);
if ($isDate) {
    $date = $year . "年" . $month . "月" . $day . "日";
} else {
    $errors[] = "生年月日を選択してください";
}
//電話の種類
if (empty($tel)) {
    $errors[] = "電話の種類を選択してください";
}
//電話番号
$pattern_h = "/[0-9]{10}/u";
$pattern_m = "/[0-9]{11}/u";
if (!empty($tel_number) && $tel == "自宅") {
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
			<h1 class="name"><a href="index.html"><img src="img/logo.png" alt="ロゴ">株式会社LINK</a></h1>
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
    <p>入力内容をご確認いただき、再度送信をお願いいたします</p>
    <p class="error"><?php echo implode('<br>', $errors); ?></p>
    <a href="register.html"><p class="button">登録画面に戻る</p></a>
</div>
<?php } else { ?>
<!-------エラーがなかったとき------->
<div id="thank">
	<div class="mas">
		<p>送信ありがとうございます</p>
		<p>登録内容確認後、ご連絡させていただきます</p>
	</div>
    <p>登録内容</p>
    <div class="flex">
        <dt>名前</dt>
        <dd><?php echo $l_name . $name;?></dd>
    </div>
    <div class="flex">
        <dt>性別</dt>
        <dd><?php echo $gender;?></dd>
    </div>
    <div class="flex">
        <dt>生年月日</dt>
        <dd><?php echo $date;?></dd>
    </div>
    <div class="flex">
        <dt>お電話番号</dt>
        <dd><?php echo $tel;?><br><?php echo $tel_number;?></dd>
    </div>
    <div>
        <dt>メールアドレス</dt>
        <dd><?php echo $email;?></dd>
    </div>
</dl>
<a href="index.html"><p class="button">ホームに戻る</p></a>
</div>
<?php }?>