<!DOCTYPE html>
<html lang="en">

<?php
// Menghubungkan file ini dengan file koneksi database
include("../connection/connect.php");
// Menyembunyikan laporan error
error_reporting(0);
// Memulai sesi
session_start();

// Mengecek apakah form login telah disubmit
if(isset($_POST['submit']))
{
    // Mengambil nilai username dan password dari form
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Mengecek apakah tombol submit ditekan
    if(!empty($_POST["submit"])) 
    {
        // Membuat query untuk mengecek username dan password di database
        $loginquery = "SELECT * FROM admin WHERE username='$username' && password='".md5($password)."'";
        $result = mysqli_query($db, $loginquery);
        $row = mysqli_fetch_array($result);
        
        // Jika data ditemukan, set session dan arahkan ke dashboard
        if(is_array($row))
        {
            $_SESSION["adm_id"] = $row['adm_id'];
            header("refresh:1;url=dashboard.php");
        } 
        // Jika data tidak ditemukan, tampilkan pesan error
        else
        {
            echo "<script>alert('Invalid Username or Password!');</script>"; 
        }
    }
}
?>

<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>

    <!-- Menggunakan reset CSS untuk menyamakan styling dasar pada semua browser -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    
    <!-- Menggunakan font dari Google Fonts -->
    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900'>
    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Montserrat:400,700'>
    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
    
    <!-- Menggunakan stylesheet untuk login -->
    <link rel="stylesheet" href="css/login.css">
</head>

<body>

    <div class="container">
        <div class="info">
            <h1>Admin Panel</h1>
        </div>
    </div>

    <div class="form">
        <!-- Thumbnail gambar untuk login -->
        <div class="thumbnail"><img src="images/manager.png" /></div>
        
        <!-- Menampilkan pesan error atau sukses -->
        <span style="color:red;"><?php echo $message; ?></span>
        <span style="color:green;"><?php echo $success; ?></span>
        
        <!-- Form login dengan metode POST ke index.php -->
        <form class="login-form" action="index.php" method="post">
            <input type="text" placeholder="Username" name="username" />
            <input type="password" placeholder="Password" name="password" />
            <input type="submit" name="submit" value="Login" />
        </form>
    </div>
    
    <!-- Memuat jQuery dari CDN -->
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    
    <!-- Memuat script tambahan untuk login -->
    <script src='js/index.js'></script>
</body>

</html>
