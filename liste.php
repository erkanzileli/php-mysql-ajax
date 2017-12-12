<!doctype html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>List</title>
</head>
<body>
<?php require 'databaseConnect.php'; ?>

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
    <h2>Table</h2>
    <table class="table table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>İsim</th>
            <th>Email</th>
            <th>Kullanıcı Adı</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php
        $result = $connection->query("SELECT * FROM kullanicilar");
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row["id"] . '</td>';
                echo '<td>' . $row["isim"] . '</td>';
                echo '<td>' . $row["email"] . '</td>';
                echo '<td>' . $row["kullaniciadi"] . '</td>';
                //UpdateButton
                echo '<td><a href="jobs.php?job=edit&id=' . $row['id'] . '"><img src="img/duzelt.png" style="width: 30px;height: 30px; " class="img-thumbnail"></a>';
                //RemoveButton
                ?>
                <td>
                    <img src="img/sil.png" onclick="f(<?php echo $row['id']; ?>)"
                         style="width:30px;cursor:pointer;height: 30px; "
                         class="img - thumbnail"
                </td>
                <?php
                echo '</tr>';
            }
        }
        ?>
        </tbody>
    </table>
</div>


<!--    CSS and JS    -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
    //delete function
    function f(id) {
        if (confirm('Are you sure?')) {
            var http = new XMLHttpRequest();
            http.open("GET", "jobs.php?job=remove&id=" + id, true);
            http.send();
            alert("Success");
            window.location = "liste.php";
        } else {
            //nothing..
        }
    }
</script>
</body>
</html>