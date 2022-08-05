<!DOCTYPE html>
<html lang="en">

<head>
    <title><?=$title?></title>
    <meta name="author" content="https://e-web.id/">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container" align="center">
        <br>
        <?php
        $server = "localhost";
        $user = "ewebid_admin_perpus";
        $pass = "@dm!n_perpus";
        $database = "ewebid_perpus";
        $koneksi = mysqli_connect("localhost", "ewebid_admin_perpus", "@dm!n_perpus", "ewebid_perpus");
        mysqli_select_db($koneksi, "ewebid_perpus");
        
        $token = $_GET['t'];
        $sql_cek = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE user_token='" . $token . "' and user_status='0'");
        $jml_data = mysqli_num_rows($sql_cek);
        if ($jml_data > 0) {
            //update data users aktif
            mysqli_query($koneksi, "UPDATE tb_user SET user_status='1' WHERE user_token='" . $token . "' and user_status='0'");
            echo '<div class="alert alert-success">
                        Akun anda sudah aktif, silahkan <a href="https://e-web.id/login">Login</a>
                        </div>';
        } else {
            //data tidak di temukan
            echo '<div class="alert alert-warning">
                        Invalid Token!
                        </div>';

        }
        ?>
    </div>
</body>

</html>