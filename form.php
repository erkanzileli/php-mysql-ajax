<!doctype html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form</title>
</head>
<body>
<?php require 'databaseConnect.php'; ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (!$_POST['isim'] == "" && !$_POST['email'] == "" && !$_POST['kullaniciadi'] == "" && !$_POST['sifre'] == "") {
        try {
            $sql = "INSERT INTO kullanicilar(isim,email,kullaniciadi,sifre) VALUES(?,?,?,?)";
            $statement = $connection->prepare($sql);
            $statement->bind_param("ssss", $_POST['isim'], $_POST['email'], $_POST['kullaniciadi'], $_POST['sifre']);
            $statement->execute();
            $statement->close();
            echo '<br/>';
            echo 'Success.';
        } catch (Exception $exception) {
            echo $exception->getMessage();
        }
    }
}
?>
<!--    Form    -->
<div class="container">
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">Odev-2</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="liste.php">List</a></li>
                <li><a href="form.php" class="active">Form</a></li>
            </ul>
        </div>
    </nav>
    <h2>Kullanıcı ekleyin</h2>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <div class="form-group">
            <label>İsim:</label>
            <input type="text" class="form-control" placeholder="İsim" name="isim">
        </div>
        <div class="form-group">
            <label>Email:</label>
            <input type="email" class="form-control" placeholder="Email" name="email">
        </div>
        <div class="form-group">
            <label>Kullanıcı Adı:</label>
            <input type="text" class="form-control" placeholder="Kullanıcı Adı" name="kullaniciadi">
        </div>
        <div class="form-group">
            <label>Şifre:</label>
            <input type="password" class="form-control" placeholder="Şifre" id="pass1" name="sifre">
        </div>
        <div class="form-group">
            <label>Şifre Tekrar:</label>
            <input type="password" class="form-control" placeholder="Şifrenizi Tekrar Girin" id="pass2">
        </div>
        <button type="submit" class="btn btn-default" id="btnSubmit" disabled="disabled">Submit</button>
    </form>
</div>

<!--    CSS and JS    -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
    var pass1 = document.getElementById('pass1');
    var pass2 = document.getElementById('pass2');
    var btnSubmit = document.getElementById('btnSubmit');
    pass1.onkeyup = function () {
        if (pass1.value.trim() != "" || pass2.value.trim() != "") {
            if ((pass1.value.trim() == pass2.value.trim())) {
                btnSubmit.disabled = false;
            } else {
                btnSubmit.disabled = true;
            }
        }
    };
    pass2.onkeyup = function () {
        if (pass1.value.trim() != "" || pass2.value.trim() != "") {
            if ((pass1.value.trim() == pass2.value.trim())) {
                btnSubmit.disabled = false;
            } else {
                btnSubmit.disabled = true;
            }
        }
    };

</script>
</body>
</html>