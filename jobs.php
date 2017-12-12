<!doctype html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Jobs</title>
</head>
<body>
<?php require 'databaseConnect.php'; ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['job']) && isset($_GET['id'])) {
        if ($_GET['job'] == 'remove') {
            try {
                $connection->query("DELETE FROM kullanicilar WHERE id=" . $_GET['id']);
                if ($connection->affected_rows > 0) {
                    echo '<script>alert("Success.");</script>';
                    echo '<script>window.location="liste.php";</script>';
                }
            } catch (Exception $exception) {
                echo $exception->getMessage();
            }
        } else if ($_GET['job'] == 'edit') {
            try {
                $result = $connection->query('SELECT * FROM kullanicilar WHERE id=' . $_GET['id']);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <!--    Form    -->
                        <div class="container">
						<nav class="navbar navbar-inverse">
							<div class="container-fluid">
								<div class="navbar-header">
									<a class="navbar-brand" href="index.php">Odev-2</a>
								</div>
								<ul class="nav navbar-nav">
									<li><a href="liste.php" class="active">List</a></li>
									<li><a href="form.php">Form</a></li>
								</ul>
							</div>
						</nav>
						<h2>Kullanıcı düzenleyin</h2>
                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                <div class="form-group">
                                    <label>ID:</label>
                                    <input type="text" class="form-control" value="<?php echo $row['id']; ?>"
                                           name="id" readonly="readonly">
                                </div>
                                <div class="form-group">
                                    <label>İsim:</label>
                                    <input type="text" class="form-control" placeholder="<?php echo $row['isim']; ?>"
                                           name="isim">
                                </div>
                                <div class="form-group">
                                    <label>Email:</label>
                                    <input type="email" class="form-control" placeholder="<?php echo $row['email']; ?>"
                                           name="email">
                                </div>
                                <div class="form-group">
                                    <label>Kullanıcı Adı:</label>
                                    <input type="text" class="form-control"
                                           placeholder="<?php echo $row['kullaniciadi']; ?>" name="kullaniciadi">
                                </div>
                                <div class="form-group">
                                    <label>Şifre:</label>
                                    <input type="password" class="form-control" placeholder="Yeni veya eski şifre"
                                           id="pass1"
                                           name="sifre">
                                </div>
                                <div class="form-group">
                                    <label>Şifre Tekrar:</label>
                                    <input type="password" class="form-control" placeholder="Şifrenizi Tekrar Girin"
                                           id="pass2">
                                </div>
                                <button type="submit" class="btn btn-default" id="btnSubmit" disabled="disabled">
                                    Submit
                                </button>
                            </form>
                        </div>
                        <?php
                    }
                } else {
                    echo "Record not found.";
                }
            } catch (Exception $exception) {

            }
        } else {
            echo 'Undefined request parameter.';
        }
    }
} else if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (!$_POST['isim'] == "" && !$_POST['email'] == "" && !$_POST['kullaniciadi'] == "" && !$_POST['sifre'] == "") {
        try {
            $sql = "UPDATE kullanicilar SET `isim`=?, `email`=?, `sifre`=?, `kullaniciadi`=? WHERE id=?";
            $statement = $connection->prepare($sql);
            $statement->bind_param("ssssi", $_POST['isim'], $_POST['email'], $_POST['sifre'], $_POST['kullaniciadi'], $_POST['id']);
            $statement->execute();
            $statement->close();
            echo '<script> alert("Success"); window.location="liste.php"; </script>';
        } catch (Exception $exception) {
            echo $exception->getMessage();
        }
    }
} else {
    echo "Undefined request";
}
?>

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