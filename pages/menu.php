<div class="menu sticky-top">
    <nav class="navbar navbar-expand-lg primary-background">
        <div class="container-fluid font-weight-bold">
            <a class="navbar-branch" href="./index.php">
                <i class="fas fa-book-reader fa-2x mx-3"></i>
            </a>
            <button
                class="navbar-toggler text-light"
                type="button"
                data-toggle="collapse"
                data-target="#collapsibleNavbar"
            >
                <i class="fas fa-align-right"></i>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="collapsibleNavbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a
                            class="nav-link"
                            href="./index.php"
                            >Trang chủ</a
                        >
                    </li>
                    <li class="nav-item">
                        <a
                            class="nav-link"
                            href="./index.php?navigate=show_products"
                            >Sản phẩm</a
                        >
                    </li>
                    <?php if(isset($_SESSION['user_id'])) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="./index.php?navigate=cart">Giỏ hàng</a>
                    </li>
                    <li class="nav-item">
                        <div class="dropdown show">
                            <a
                                class="nav-link dropdown-toggle"
                                role="button"
                                id="dropdownMenuLink"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                                style="cursor: pointer; color: whitesmoke;"
                            >
                                Tài khoản
                            </a>

                            <div
                                class="dropdown-menu bg-dark"
                                aria-labelledby="dropdownMenuLink"
                            >
                                <a
                                    href="./index.php?navigate=profile"
                                    class="dropdown-item"
                                    >Tài khoản của tôi</a
                                >
                                <a
                                    class="dropdown-item"
                                    href="./index.php?navigate=order_history"
                                    >Lịch sử đặt hàng</a
                                >
                                <a
                                    class="dropdown-item"
                                    href="./pages/main/account/logout.php"
                                    >Đăng xuất</a
                                >
                            </div>
                        </div>
                    </li>

                    <?php } else { ?>
                    <li class="nav-item">
                        <a
                            class="nav-link"
                            href="./index.php?navigate=login"
                        >
                        Đăng nhập
                        </a>
                    </li>
                    <li class="nav-item">
                        <a
                            class="nav-link"
                            href="./index.php?navigate=signup"
                        >
                        Đăng ký
                        </a>
                    </li>
                    <?php } ?>
                </ul>
                <form
                    action="index.php?navigate=show_products"
                    class="d-flex"
                    role="search"
                    method="POST"
                >
                <input
                    type="search"
                    placeholder="Tên sản phẩm"
                    class="form-control border-0"
                    style="border-radius: 4px 0 0 4px"
                    name="keyword"
                    aria-label="Tìm kiếm"
                />
                <input
                    type="submit"
                    class="btn bg-transparent border-light text-light"
                    style="border-radius: 0 4px 4px 0"
                    name="search"
                    value="Tìm kiếm"
                />
                </form>
            </div>
        </div>
    </nav>
</div>