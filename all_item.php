<!DOCTYPE html>
<html lang="en">
<?php
// Menghubungkan ke database dan memulai sesi PHP
include("../connection/connect.php");
error_reporting(0);
session_start();
?>
<head>
    <!-- Mengatur karakter encoding, pengaturan kompatibilitas, viewport, dan meta informasi lainnya -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <!-- Judul halaman -->
    <title>All Menu</title>
    <!-- Menghubungkan CSS untuk Bootstrap, helper, dan style khusus -->
    <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="css/helper.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body class="fix-header fix-sidebar">
    <!-- Preloader -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>

    <div id="main-wrapper">
        <!-- Bagian Header -->
        <div class="header">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-header">
                    <!-- Logo atau ikon homepage -->
                    <a class="navbar-brand" href="dashboard.php">
                        <span><img src="images/icn.png" alt="homepage" class="dark-logo" /></span>
                    </a>
                </div>
                <div class="navbar-collapse">
                    <!-- Navigasi kosong untuk menempatkan item lain di sebelah kanan -->
                    <ul class="navbar-nav mr-auto mt-md-0"></ul>
                    <ul class="navbar-nav my-lg-0">
                        <!-- Item dropdown untuk profil pengguna dan logout -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/bookingSystem/user-icn.png" alt="user" class="profile-pic" /></a>
                            <div class="dropdown-menu dropdown-menu-right animated zoomIn">
                                <ul class="dropdown-user">
                                    <li><a href="logout.php"><i class="fa fa-power-off"></i> Logout</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>

        <!-- Bagian Sidebar Kiri -->
        <div class="left-sidebar">
            <div class="scroll-sidebar">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-devider"></li>
                        <li class="nav-label">Home</li>
                        <li><a href="dashboard.php"><i class="fa fa-tachometer"></i><span>Dashboard</span></a></li>
                        <li class="nav-label">Log</li>
                        <li><a href="all_users.php"><span><i class="fa fa-user f-s-20 "></i></span><span>Users</span></a></li>
                        <!-- Dropdown menu untuk TechHub -->
                        <li><a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-archive f-s-20 color-warning"></i><span class="hide-menu">TechHub</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="all_Tech Hub.php">All TechHub</a></li>
                                <li><a href="add_category.php">Add Category</a></li>
                                <li><a href="add_Tech Hub.php">Add TechHub</a></li>
                            </ul>
                        </li>
                        <!-- Dropdown menu untuk Menu -->
                        <li><a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-cutlery" aria-hidden="true"></i><span class="hide-menu">Item</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="all_item.php">All Items</a></li>
                                <li><a href="add_item.php">Add Item</a></li>
                            </ul>
                        </li>
                        <li><a href="all_orders.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span>Orders</span></a></li>
                    </ul>
                </nav>
            </div>
        </div>

        


        <!-- Bagian konten utama halaman -->
        <div class="page-wrapper">
            <div style="padding-top: 10px;"></div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="col-lg-12">
                            <div class="card card-outline-primary">
                                <div class="card-header">
                                    <h4 class="m-b-0 text-white">All Menu</h4>
                                </div>
                                <!-- Tabel responsif untuk menampilkan menu -->
                                <div class="table-responsive m-t-40">
                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>TechHub</th>
                                                <th>Dish</th>
                                                <th>Description</th>
                                                <th>Price</th>
                                                <th>Image</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // Mengambil data dari tabel 'tech' dan menampilkannya
                                            $sql="SELECT * FROM tech order by d_id desc";
                                            $query=mysqli_query($db,$sql);
                                            
                                            if(!mysqli_num_rows($query) > 0)
                                            {
                                                echo '<td colspan="11"><center>No Menu</center></td>';
                                            }
                                            else
                                            {                
                                                while($rows=mysqli_fetch_array($query))
                                                {
                                                    $mql="select * from tech_hub where rs_id='".$rows['rs_id']."'";
                                                    $newquery=mysqli_query($db,$mql);
                                                    $fetch=mysqli_fetch_array($newquery);
                                                    
                                                    echo '<tr><td>'.$fetch['title'].'</td>
                                                            <td>'.$rows['title'].'</td>
                                                            <td>'.$rows['slogan'].'</td>
                                                            <td>$'.$rows['price'].'</td>
                                                            <td><div class="col-md-3 col-lg-8 m-b-10">
                                                            <center><img src="Res_img/tech/'.$rows['img'].'" class="img-responsive  radius" style="max-height:100px;max-width:150px;" /></center>
                                                            </div></td>
                                                            <td><a href="delete_menu.php?menu_del='.$rows['d_id'].'" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10"><i class="fa fa-trash-o" style="font-size:16px"></i></a> 
                                                            <a href="update_menu.php?menu_upd='.$rows['d_id'].'" class="btn btn-info btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="fa fa-edit"></i></a>
                                                        </td></tr>';
                                                }    
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Menghubungkan footer -->
    <?php include "include/footer.php"?>
    </div>

    <!-- Menghubungkan file JavaScript yang dibutuhkan -->
    <script src="js/lib/jquery/jquery.min.js"></script>
    <script src="js/lib/bootstrap/js/popper.min.js"></script>
    <script src="js/lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/jquery.slimscroll.js"></script>
    <script src="js/sidebarmenu.js"></script>
    <script src="js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/lib/datatables/datatables.min.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="js/lib/datatables/cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="js/lib/datatables/datatables-init.js"></script>
</body>
</html>
