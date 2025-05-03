<?php
    session_start();
    include("config/connection.php");
    if (!isset($_SESSION['admin'])) {
        header('location: login.php');
    }
?>

<!DOCTYPE html>
<html lang="vi">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.css" />
        <link rel="stylesheet" href="../assets/bootstrap/js/bootstrap.bundle.js" />
        <link rel="stylesheet" href="../assets/bootstrap/js/bootstrap.bundle.min.js" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
        <link rel="stylesheet" href="css/style.css" />
        <title>ShopDev Admin</title>
    </head>
    <body>
        <div id="warpper" class="nav-fixed">
            <nav class="topnav shadow navbar-light bg-white d-flex">
                <div class="navbar-brand"></div>
                <div class="nav-right">
                    <div class="btn-group mr-auto">
                        <button
                            type="button"
                            class="btn dropdown"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                        >
                            <i class="plus-icon fas fa-plus-circle"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="?product=add_product">Thêm sản phẩm</a >
                        </div>
                    </div>
                </div>
            <div>
                <a class="btn btn-danger mr-2" href="logout.php">Đăng xuất</a>
            </div>
            </nav>
            <div id="page-body" class="d-flex">
                <div id="sidebar" class="bg-white">
                    <ul id="sidebar-menu">
                        <li class="nav-link">
                            <a href="index.php">
                                <div class="nav-link-icon d-inline-flex"><i class="fas fa-chart-bar"></i></div>
                                Bảng thống kê
                            </a>
                        </li>

                        <li class="nav-link">
                            <a href="?product=product_list">
                                <div class="nav-link-icon d-inline-flex"><i class="far fa-folder"></i></div>
                                Sản phẩm
                            </a>
                            <i class="arrow fas fa-angle-right"></i>
                            <ul class="sub-menu">
                                <li>
                                    <a href="?product=add_product">Thêm sản phẩm</a>
                                </li>
                                <li>
                                    <a href="?product=product_list">Danh sách sản phẩm</a>
                                </li>
                                <li><a href="?cat=cat_list">Danh mục</a></li>
                            </ul>
                        </li>
                        <li class="nav-link">
                            <a href="index.php?order=order_dashboard">
                                <div class="nav-link-icon d-inline-flex"><i class="far fa-folder"></i></div>
                                Đơn hàng
                            </a>
                            <i class="arrow fas fa-angle-right"></i>
                            <ul class="sub-menu">
                                <li><a href="?order=order_list">Đã duyệt</a></li>
                                <li><a href="?order=order_list&process=cancel">Đã hủy</a></li>
                            </ul>
                        </li>
                        <li class="nav-link">
                            <a href="?user=user_list">
                                <div class="nav-link-icon d-inline-flex"><i class="far fa-folder"></i></div>
                                Người dùng
                            </a>
                            <i class="arrow fas fa-angle-right"></i>
                            <ul class="sub-menu">
                                <li>
                                    <a href="?user=user_list"
                                        >Danh sách người dùng</a
                                    >
                                </li>
                                <li>
                                    <a href="?user=comments"
                                        >Danh sách bình luận</a
                                    >
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div id="wp-content">
                    <?php
                    $routes = [
                        'user'    => 'modules/manage_users',
                        'product' => 'modules/manage_products',
                        'cat'     => 'modules/manage_categories',
                        'order'   => 'modules/manage_orders',
                    ];
                    
                    $included = false;
                    
                    foreach ($routes as $param => $directory) {
                        if (isset($_GET[$param])) {
                            $page = basename($_GET[$param]);
                            $file = "{$directory}/{$page}.php";
                    
                            if (file_exists($file)) {
                                require $file;
                                $included = true;
                            }
                            break;
                        }
                    }
                    
                    if (!$included) {
                        require "modules/dashboard.php";
                    }
                    ?>
                </div>
            </div>
        </div>
    </body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"
    ></script>
    <script
        src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"
    ></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script src="js/app.js"></script>
    <script src="js/statistics.js"></script>
</html>
