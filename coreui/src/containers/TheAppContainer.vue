<template>
  <div class="animsition">
    <!-- Header -->
    <div>
      <!-- Header desktop -->
      <div class="container-menu-desktop">
        <div class="topbar">
          <div class="content-topbar container h-100">
            <div class="left-topbar">
              <span class="left-topbar-item flex-wr-s-c">
                {{ timeZone }}
              </span>

              <a href="#" class="left-topbar-item">
                Về chúng tôi
              </a>

              <a href="#" class="left-topbar-item">
                Liên hệ
              </a>

              <a href="#" class="left-topbar-item">
                Đăng nhập
              </a>
            </div>

            <div class="right-topbar">
              <a href="#">
                <CIcon :content="$options.brands.cibFacebook" :height="32"/>
              </a>

              <a href="#">
                <span class="fab fa-twitter"></span>
              </a>

              <a href="#">
                <CIcon :content="$options.brands.cibYoutube" :height="32"/>
              </a>
            </div>
          </div>
        </div>

        <!-- Header Mobile -->
        <div class="wrap-header-mobile">
          <!-- Logo moblie -->
          <div class="logo-mobile">
            <a href="index.html"><img src="images/icons/logo-01.png" alt="IMG-LOGO"></a>
          </div>

          <!-- Button show menu -->
          <div class="btn-show-menu-mobile hamburger hamburger--squeeze m-r--8">
            <span class="hamburger-box">
              <span class="hamburger-inner"></span>
            </span>
          </div>
        </div>

        <!-- Menu Mobile -->
        <div class="menu-mobile">
          <ul class="topbar-mobile">
            <li class="left-topbar">
              <span class="left-topbar-item flex-wr-s-c">
                <span>
                  New York, NY
                </span>

                <img class="m-b-1 m-rl-8" src="images/icons/icon-night.png" alt="IMG">

                <span>
                  HI 58° LO 56°
                </span>
              </span>
            </li>

            <li class="left-topbar">
              <a href="#" class="left-topbar-item">
                About
              </a>

              <a href="#" class="left-topbar-item">
                Contact
              </a>

              <a href="#" class="left-topbar-item">
                Sing up
              </a>

              <a href="#" class="left-topbar-item">
                Log in
              </a>
            </li>

            <li class="right-topbar">
              <a href="#">
                <span class="fab fa-facebook-f"></span>
              </a>

              <a href="#">
                <span class="fab fa-twitter"></span>
              </a>

              <a href="#">
                <span class="fab fa-pinterest-p"></span>
              </a>

              <a href="#">
                <span class="fab fa-vimeo-v"></span>
              </a>

              <a href="#">
                <span class="fab fa-youtube"></span>
              </a>
            </li>
          </ul>

          <ul class="main-menu-m">
            <li>
              <a href="index.html">Home</a>
              <ul class="sub-menu-m">
                <li><a href="index.html">Homepage v1</a></li>
                <li><a href="home-02.html">Homepage v2</a></li>
                <li><a href="home-03.html">Homepage v3</a></li>
              </ul>

              <span class="arrow-main-menu-m">
                <i class="fa fa-angle-right" aria-hidden="true"></i>
              </span>
            </li>

            <li>
              <a href="category-01.html">News</a>
            </li>

            <li>
              <a href="category-02.html">Entertainment </a>
            </li>

            <li>
              <a href="category-01.html">Business</a>
            </li>

            <li>
              <a href="category-02.html">Travel</a>
            </li>

            <li>
              <a href="category-01.html">Life Style</a>
            </li>

            <li>
              <a href="category-02.html">Video</a>
            </li>

            <li>
              <a href="#">Features</a>
              <ul class="sub-menu-m">
                <li><a href="category-01.html">Category Page v1</a></li>
                <li><a href="category-02.html">Category Page v2</a></li>
                <li><a href="blog-grid.html">Blog Grid Sidebar</a></li>
                <li><a href="blog-list-01.html">Blog List Sidebar v1</a></li>
                <li><a href="blog-list-02.html">Blog List Sidebar v2</a></li>
                <li><a href="blog-detail-01.html">Blog Detail Sidebar</a></li>
                <li><a href="blog-detail-02.html">Blog Detail No Sidebar</a></li>
                <li><a href="about.html">About Us</a></li>
                <li><a href="contact.html">Contact Us</a></li>
              </ul>

              <span class="arrow-main-menu-m">
                <i class="fa fa-angle-right" aria-hidden="true"></i>
              </span>
            </li>
          </ul>
        </div>

        <!--  -->
        <div class="wrap-logo container">
          <!-- Logo desktop -->
          <div class="logo">
            <a href="index.html"><img src="images/icons/logo-01.png" alt="LOGO"></a>
          </div>

          <!-- Banner -->
          <!-- <div class="banner-header">
            <a href="#"><img src="images/banner-01.jpg" alt="IMG"></a>
          </div> -->
        </div>

        <!--  -->
        <div class="wrap-main-nav">
          <div class="main-nav">
            <!-- Menu desktop -->
            <nav class="menu-desktop">
              <a class="logo-stick" href="index.html">
                <img src="images/icons/logo-01.png" alt="LOGO">
              </a>

              <ul class="main-menu">
                <li class="main-menu-active">
                  <a href="#">Trang chủ</a>
                </li>

                <li class="main-menu-item">
                  <a href="#">Dịch vụ</a>
                </li>

                <li class="mega-menu-item">
                  <a class="sub" href="#">Tin tức</a>

                  <div class="sub-mega-menu">
                    <div class="nav flex-column nav-pills" role="tablist">
                      <a class="nav-link" v-b-toggle.news-1 role="tab">Bảng tin hàng ngày</a>
                      <a class="nav-link" v-b-toggle.news-1 role="tab">Thông Báo</a>
                      <a class="nav-link" v-b-toggle.news-2 role="tab">Đấu Thầu</a>
                    </div>

                    <div class="tab-content">
                      <b-collapse class="tab-pane" id="news-1" role="tabpanel" accordion="my-accordion" is-nav="true">
                        <div class="row">
                          <div class="col-3">
                            <!-- Item post -->
                            <div>
                              <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                <img src="images/post-25.jpg" alt="IMG">
                              </a>

                              <div class="p-t-10">
                                <h5 class="p-b-5">
                                  <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                    Donec metus orci, malesuada et lectus vitae 1
                                  </a>
                                </h5>

                                <span class="cl8">
                                  <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                    Music
                                  </a>

                                  <span class="f1-s-3 m-rl-3">
                                    -
                                  </span>

                                  <span class="f1-s-3">
                                    Feb 18
                                  </span>
                                </span>
                              </div>
                            </div>
                          </div>

                          <div class="col-3">
                            <!-- Item post -->
                            <div>
                              <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                <img src="images/post-27.jpg" alt="IMG">
                              </a>

                              <div class="p-t-10">
                                <h5 class="p-b-5">
                                  <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                    Donec metus orci, malesuada et lectus vitae
                                  </a>
                                </h5>

                                <span class="cl8">
                                  <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                    Music
                                  </a>

                                  <span class="f1-s-3 m-rl-3">
                                    -
                                  </span>

                                  <span class="f1-s-3">
                                    Jan 20
                                  </span>
                                </span>
                              </div>
                            </div>
                          </div>

                          <div class="col-3">
                            <!-- Item post -->
                            <div>
                              <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                <img src="images/post-26.jpg" alt="IMG">
                              </a>

                              <div class="p-t-10">
                                <h5 class="p-b-5">
                                  <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                    Donec metus orci, malesuada et lectus vitae
                                  </a>
                                </h5>

                                <span class="cl8">
                                  <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                    Music
                                  </a>

                                  <span class="f1-s-3 m-rl-3">
                                    -
                                  </span>

                                  <span class="f1-s-3">
                                    Feb 12
                                  </span>
                                </span>
                              </div>
                            </div>
                          </div>

                          <div class="col-3">
                            <!-- Item post -->
                            <div>
                              <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                <img src="images/post-34.jpg" alt="IMG">
                              </a>

                              <div class="p-t-10">
                                <h5 class="p-b-5">
                                  <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                    Donec metus orci, malesuada et lectus vitae
                                  </a>
                                </h5>

                                <span class="cl8">
                                  <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                    Music
                                  </a>

                                  <span class="f1-s-3 m-rl-3">
                                    -
                                  </span>

                                  <span class="f1-s-3">
                                    Jan 15
                                  </span>
                                </span>
                              </div>
                            </div>
                          </div>
                        </div>
                      </b-collapse>

                      <b-collapse class="tab-pane" id="news-2" role="tabpanel" accordion="my-accordion" is-nav="true">
                        <div class="row">
                          <div class="col-3">
                            <!-- Item post -->
                            <div>
                              <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                <img src="images/post-25.jpg" alt="IMG">
                              </a>

                              <div class="p-t-10">
                                <h5 class="p-b-5">
                                  <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                    Donec metus orci, malesuada et lectus vitae 2
                                  </a>
                                </h5>

                                <span class="cl8">
                                  <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                    Music
                                  </a>

                                  <span class="f1-s-3 m-rl-3">
                                    -
                                  </span>

                                  <span class="f1-s-3">
                                    Feb 18
                                  </span>
                                </span>
                              </div>
                            </div>
                          </div>

                          <div class="col-3">
                            <!-- Item post -->
                            <div>
                              <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                <img src="images/post-27.jpg" alt="IMG">
                              </a>

                              <div class="p-t-10">
                                <h5 class="p-b-5">
                                  <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                    Donec metus orci, malesuada et lectus vitae
                                  </a>
                                </h5>

                                <span class="cl8">
                                  <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                    Music
                                  </a>

                                  <span class="f1-s-3 m-rl-3">
                                    -
                                  </span>

                                  <span class="f1-s-3">
                                    Jan 20
                                  </span>
                                </span>
                              </div>
                            </div>
                          </div>

                          <div class="col-3">
                            <!-- Item post -->
                            <div>
                              <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                <img src="images/post-26.jpg" alt="IMG">
                              </a>

                              <div class="p-t-10">
                                <h5 class="p-b-5">
                                  <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                    Donec metus orci, malesuada et lectus vitae
                                  </a>
                                </h5>

                                <span class="cl8">
                                  <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                    Music
                                  </a>

                                  <span class="f1-s-3 m-rl-3">
                                    -
                                  </span>

                                  <span class="f1-s-3">
                                    Feb 12
                                  </span>
                                </span>
                              </div>
                            </div>
                          </div>

                          <div class="col-3">
                            <!-- Item post -->
                            <div>
                              <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                <img src="images/post-34.jpg" alt="IMG">
                              </a>

                              <div class="p-t-10">
                                <h5 class="p-b-5">
                                  <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                    Donec metus orci, malesuada et lectus vitae
                                  </a>
                                </h5>

                                <span class="cl8">
                                  <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                    Music
                                  </a>

                                  <span class="f1-s-3 m-rl-3">
                                    -
                                  </span>

                                  <span class="f1-s-3">
                                    Jan 15
                                  </span>
                                </span>
                              </div>
                            </div>
                          </div>
                        </div>
                      </b-collapse>
                    </div>
                  </div>
                </li>

                <li class="mega-menu-item">
                  <a class="sub" href="#">Tài liệu </a>

                  <div class="sub-mega-menu">
                    <div class="nav flex-column nav-pills" role="tablist">
                      <a class="nav-link active" role="tab" href="#">Phối cảnh dự án</a>
                      <a class="nav-link" role="tab" href="#">Thông tin căn hộ</a>
                    </div>

                    <div class="tab-content">
                      <div class="tab-pane" ref="news-3" role="tabpanel">
                        <div class="row">
                          <div class="col-3">
                            <!-- Item post -->
                            <div>
                              <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                <img src="images/post-25.jpg" alt="IMG">
                              </a>

                              <div class="p-t-10">
                                <h5 class="p-b-5">
                                  <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                    Donec metus orci, malesuada et lectus vitae
                                  </a>
                                </h5>

                                <span class="cl8">
                                  <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                    Music
                                  </a>

                                  <span class="f1-s-3 m-rl-3">
                                    -
                                  </span>

                                  <span class="f1-s-3">
                                    Feb 18
                                  </span>
                                </span>
                              </div>
                            </div>
                          </div>

                          <div class="col-3">
                            <!-- Item post -->
                            <div>
                              <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                <img src="images/post-27.jpg" alt="IMG">
                              </a>

                              <div class="p-t-10">
                                <h5 class="p-b-5">
                                  <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                    Donec metus orci, malesuada et lectus vitae
                                  </a>
                                </h5>

                                <span class="cl8">
                                  <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                    Music
                                  </a>

                                  <span class="f1-s-3 m-rl-3">
                                    -
                                  </span>

                                  <span class="f1-s-3">
                                    Jan 20
                                  </span>
                                </span>
                              </div>
                            </div>
                          </div>

                          <div class="col-3">
                            <!-- Item post -->
                            <div>
                              <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                <img src="images/post-26.jpg" alt="IMG">
                              </a>

                              <div class="p-t-10">
                                <h5 class="p-b-5">
                                  <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                    Donec metus orci, malesuada et lectus vitae
                                  </a>
                                </h5>

                                <span class="cl8">
                                  <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                    Music
                                  </a>

                                  <span class="f1-s-3 m-rl-3">
                                    -
                                  </span>

                                  <span class="f1-s-3">
                                    Feb 12
                                  </span>
                                </span>
                              </div>
                            </div>
                          </div>

                          <div class="col-3">
                            <!-- Item post -->
                            <div>
                              <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                <img src="images/post-34.jpg" alt="IMG">
                              </a>

                              <div class="p-t-10">
                                <h5 class="p-b-5">
                                  <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                    Donec metus orci, malesuada et lectus vitae
                                  </a>
                                </h5>

                                <span class="cl8">
                                  <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                    Music
                                  </a>

                                  <span class="f1-s-3 m-rl-3">
                                    -
                                  </span>

                                  <span class="f1-s-3">
                                    Jan 15
                                  </span>
                                </span>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="tab-pane" ref="news-4" role="tabpanel">
                        <div class="row">
                          <div class="col-3">
                            <!-- Item post -->
                            <div>
                              <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                <img src="images/post-25.jpg" alt="IMG">
                              </a>

                              <div class="p-t-10">
                                <h5 class="p-b-5">
                                  <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                    Donec metus orci, malesuada et lectus vitae
                                  </a>
                                </h5>

                                <span class="cl8">
                                  <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                    Music
                                  </a>

                                  <span class="f1-s-3 m-rl-3">
                                    -
                                  </span>

                                  <span class="f1-s-3">
                                    Feb 18
                                  </span>
                                </span>
                              </div>
                            </div>
                          </div>

                          <div class="col-3">
                            <!-- Item post -->
                            <div>
                              <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                <img src="images/post-27.jpg" alt="IMG">
                              </a>

                              <div class="p-t-10">
                                <h5 class="p-b-5">
                                  <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                    Donec metus orci, malesuada et lectus vitae
                                  </a>
                                </h5>

                                <span class="cl8">
                                  <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                    Music
                                  </a>

                                  <span class="f1-s-3 m-rl-3">
                                    -
                                  </span>

                                  <span class="f1-s-3">
                                    Jan 20
                                  </span>
                                </span>
                              </div>
                            </div>
                          </div>

                          <div class="col-3">
                            <!-- Item post -->
                            <div>
                              <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                <img src="images/post-26.jpg" alt="IMG">
                              </a>

                              <div class="p-t-10">
                                <h5 class="p-b-5">
                                  <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                    Donec metus orci, malesuada et lectus vitae
                                  </a>
                                </h5>

                                <span class="cl8">
                                  <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                    Music
                                  </a>

                                  <span class="f1-s-3 m-rl-3">
                                    -
                                  </span>

                                  <span class="f1-s-3">
                                    Feb 12
                                  </span>
                                </span>
                              </div>
                            </div>
                          </div>

                          <div class="col-3">
                            <!-- Item post -->
                            <div>
                              <a href="blog-detail-01.html" class="wrap-pic-w hov1 trans-03">
                                <img src="images/post-34.jpg" alt="IMG">
                              </a>

                              <div class="p-t-10">
                                <h5 class="p-b-5">
                                  <a href="blog-detail-01.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                    Donec metus orci, malesuada et lectus vitae
                                  </a>
                                </h5>

                                <span class="cl8">
                                  <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                    Music
                                  </a>

                                  <span class="f1-s-3 m-rl-3">
                                    -
                                  </span>

                                  <span class="f1-s-3">
                                    Jan 15
                                  </span>
                                </span>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>

                <li>
                  <a href="#">Liên Hệ</a>
                  <ul class="sub-menu">
                    <li><a href="about.html">Giới thiệu</a></li>
                    <li><a href="contact.html">Liên hệ</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
    <div>
      <router-view></router-view>
    </div>
    <div>
      <div class="bg2 p-t-40 p-b-25">
        <div class="container">
          <div class="row">
            <div class="col-lg-4 p-b-20">
              <div class="text-center mb-3">
                <a href="index.html">
                  <img src="images/icons/logo-01.png" alt="LOGO">
                </a>
              </div>

              <div>
                <p class="f1-s-1 cl11 p-b-16">
                  Được bao bọc bởi công viên trung tâm diện tích bằng ¾ công viên Gia Định và tọa lạc tại vị trí giao
                  nhau của hai trục đường chính Cát Lái – KĐT mới năng động, quy hoạch bài bản đầy đủ các chức năng về tài chính,
                  thương mại, dịch vụ, văn hóa, giáo dục, khoa học kỹ thuật cao… Citisoho – dự án khu căn hộ đương đại –
                  là lựa chọn lý tưởng dành cho người trẻ năng động, sáng tạo, đang tìm kiếm một phong cách sống mới tại một miền đất xanh mát,
                  yên bình nhưng không tách rời tiện nghi hiện đại và không quá xa trung tâm thành phố.
                </p>

                <p class="f1-s-1 cl11 p-b-16">
                  Gọi cho chúng tôi (+84) xxx xxx xxx
                </p>

                <div class="p-t-15">
                  <a href="#" class="fs-18 cl11 hov-cl10 trans-03 m-r-8">
                    <CIcon :content="$options.brands.cibFacebook" :height="32"/>
                  </a>

                  <a href="#" class="fs-18 cl11 hov-cl10 trans-03 m-r-8">
                    <CIcon :content="$options.brands.cibTwitter" :height="32"/>
                  </a>

                  <a href="#" class="fs-18 cl11 hov-cl10 trans-03 m-r-8">
                    <CIcon :content="$options.brands.cibYoutube" :height="32"/>
                  </a>
                </div>
              </div>
            </div>

            <div class="col-sm-6 col-lg-4 p-b-20">
              <div class="size-h-3 flex-s-c">
                <h5 class="f1-m-7 cl0">
                  Xem nhiều nhất
                </h5>
              </div>

              <ul>
                <li class="flex-wr-sb-s p-b-20">
                  <a href="#" class="size-w-4 wrap-pic-w hov1 trans-03">
                    <img src="images/popular-post-01.jpg" alt="IMG">
                  </a>

                  <div class="size-w-5">
                    <h6 class="p-b-5">
                      <a href="#" class="f1-s-5 cl11 hov-cl10 trans-03">
                        Donec metus orci, malesuada et lectus vitae
                      </a>
                    </h6>

                    <span class="f1-s-3 cl6">
                      Feb 17
                    </span>
                  </div>
                </li>

                <li class="flex-wr-sb-s p-b-20">
                  <a href="#" class="size-w-4 wrap-pic-w hov1 trans-03">
                    <img src="images/popular-post-02.jpg" alt="IMG">
                  </a>

                  <div class="size-w-5">
                    <h6 class="p-b-5">
                      <a href="#" class="f1-s-5 cl11 hov-cl10 trans-03">
                        Lorem ipsum dolor sit amet, consectetur
                      </a>
                    </h6>

                    <span class="f1-s-3 cl6">
                      Feb 16
                    </span>
                  </div>
                </li>

                <li class="flex-wr-sb-s p-b-20">
                  <a href="#" class="size-w-4 wrap-pic-w hov1 trans-03">
                    <img src="images/popular-post-03.jpg" alt="IMG">
                  </a>

                  <div class="size-w-5">
                    <h6 class="p-b-5">
                      <a href="#" class="f1-s-5 cl11 hov-cl10 trans-03">
                        Suspendisse dictum enim quis imperdiet auctor
                      </a>
                    </h6>

                    <span class="f1-s-3 cl6">
                      Feb 15
                    </span>
                  </div>
                </li>
              </ul>
            </div>

            <div class="col-sm-6 col-lg-4 p-b-20">
              <div class="size-h-3 flex-s-c">
                <h5 class="f1-m-7 cl0">
                  Danh mục
                </h5>
              </div>

              <ul class="m-t--12">
                <li class="how-bor1 p-rl-5 p-tb-10">
                  <a href="#" class="f1-s-5 cl11 hov-cl10 trans-03 p-tb-8">
                    Tin tức
                  </a>
                </li>

                <li class="how-bor1 p-rl-5 p-tb-10">
                  <a href="#" class="f1-s-5 cl11 hov-cl10 trans-03 p-tb-8">
                    Văn bản
                  </a>
                </li>

                <li class="how-bor1 p-rl-5 p-tb-10">
                  <a href="#" class="f1-s-5 cl11 hov-cl10 trans-03 p-tb-8">
                    Đấu Thầu
                  </a>
                </li>

                <li class="how-bor1 p-rl-5 p-tb-10">
                  <a href="#" class="f1-s-5 cl11 hov-cl10 trans-03 p-tb-8">
                    Bản đồ
                  </a>
                </li>

                <li class="how-bor1 p-rl-5 p-tb-10">
                  <a href="#" class="f1-s-5 cl11 hov-cl10 trans-03 p-tb-8">
                    Liên hệ
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <div class="bg11">
        <div class="container size-h-4 flex-c-c p-tb-15">
          <span class="f1-s-1 cl0 txt-center">
            Copyright © 2021

            <a href="#" class="f1-s-1 cl10 hov-link1">Huy Le.</a>

            All rights reserved.
          </span>
        </div>
      </div>
    </div>

    <!-- Back to top -->
    <div class="btn-back-to-top" id="myBtn">
      <span class="symbol-btn-back-to-top">
        <span class="fas fa-angle-up"></span>
      </span>
    </div>
  </div>
</template>

<style scoped>
  @import '~@/assets/fonts/iconic/css/material-design-iconic-font.min.css';
  @import '~@/assets/vendor/animate/animate.css';
  @import '~@/assets/vendor/css-hamburgers/hamburgers.min.css';
  @import '~@/assets/css/util.css';
  @import '~@/assets/css/main.css';
</style>

<script>
  import $ from 'jquery'
  import animsition from '../assets/vendor/animsition/js/animsition.min.js';
  // import main from '../assets/js/main_c.js';
  import { brandSet as brands } from '@coreui/icons'

  export default {
    name: 'TheAppContainer',
    brands,
    data: () => {
      return {
        timeZone : '',
      }
    },
    methods: {

    },
    mounted: function(){

      const lang = navigator.language || navigator.languages[0];
      var options = { hour12: false , timeZone: 'Asia/Jakarta'};

      var date = new Date();
      this.timeZone = date.toLocaleString(lang, options);

      /*==================================================================
      [ Load page ]*/
      try {
          $(".animsition").animsition({
              inClass: 'fade-in',
              outClass: 'fade-out',
              inDuration: 1500,
              outDuration: 800,
              linkElement: '.animsition-link',
              loading: true,
              loadingParentElement: 'html',
              loadingClass: 'animsition-loading-1',
              loadingInner: '<div class="loader05"></div>',
              timeout: false,
              timeoutCountdown: 5000,
              onLoadEvent: true,
              browser: ['animation-duration', '-webkit-animation-duration'],
              overlay: false,
              overlayClass: 'animsition-overlay-slide',
              overlayParentElement: 'html',
              transition: function(url) {
                  window.location.href = url;
              }
          });
      } catch (er) {
          console.log(er);
      }


      /*==================================================================
      [ Back to top ]*/
      try {
          var windowH = $(window).height() / 2;

          $(window).on('scroll', function() {
              if ($(this).scrollTop() > windowH) {
                  $("#myBtn").addClass('show-btn-back-to-top');
              } else {
                  $("#myBtn").removeClass('show-btn-back-to-top');
              }
          });

          $('#myBtn').on("click", function() {
              $('html, body').animate({
                  scrollTop: 0
              }, 300);
          });
      } catch (er) {
          console.log(er);
      }


      /*==================================================================
      [ Fixed menu ]*/
      try {
          var posNav = $('.wrap-main-nav').offset().top;
          var menuDesktop = $('.container-menu-desktop');
          var mainNav = $('.main-nav');
          var lastScrollTop = 0;
          var st = 0;

          $(window).on('scroll', function() {
              fixedHeader();
          });

          $(window).on('resize', function() {
              fixedHeader();
          });

          $(window).on('load', function() {
              fixedHeader();
          });

          var fixedHeader = function() {
              st = $(window).scrollTop();

              if (st > posNav + mainNav.outerHeight()) {
                  $(menuDesktop).addClass('fix-menu-desktop');
              } else if (st <= posNav) {
                  $(menuDesktop).removeClass('fix-menu-desktop');
              }

              if (st > lastScrollTop) {
                  $(mainNav).removeClass('show-main-nav');
              } else {
                  $(mainNav).addClass('show-main-nav');
              }

              lastScrollTop = st;
          };

      } catch (er) {
          console.log(er);
      }

      /*==================================================================
      [ Menu mobile ]*/
      try {
          $('.btn-show-menu-mobile').on('click', function() {
              $(this).toggleClass('is-active');
              $('.menu-mobile').slideToggle();
          });

          var arrowMainMenu = $('.arrow-main-menu-m');

          for (var i = 0; i < arrowMainMenu.length; i++) {
              $(arrowMainMenu[i]).on('click', function() {
                  $(this).parent().find('.sub-menu-m').slideToggle();
                  $(this).toggleClass('turn-arrow-main-menu-m');
              })
          }

          $(window).on('resize', function() {
              if ($(window).width() >= 992) {
                  if ($('.menu-mobile').css('display') === 'block') {
                      $('.menu-mobile').css('display', 'none');
                      $('.btn-show-menu-mobile').toggleClass('is-active');
                  }

                  $('.sub-menu-m').each(function() {
                      if ($(this).css('display') === 'block') {
                          $(this).css('display', 'none');
                          $(arrowMainMenu).removeClass('turn-arrow-main-menu-m');
                      }
                  });

              }
          });
      } catch (er) {
          console.log(er);
      }


      /*==================================================================
      [ Respon tab01 ]*/
      try {
          $('.tab01').each(function() {
              var tab01 = $(this);
              var navTabs = $(this).find('.nav-tabs');
              var dropdownMenu = $(tab01).find('.nav-tabs>.nav-item-more .dropdown-menu');
              var navItem = $(tab01).find('.nav-tabs>.nav-item');

              var navItemSize = [];
              var size = 0;
              var wNavItemMore = 0;

              $(window).on('load', function() {
                  navItem.each(function() {
                      size += $(this).width();
                      navItemSize.push(size);
                  });

                  responTab01();
              });

              $(window).on('resize', function() {
                  responTab01();
              })

              var responTab01 = function() {
                  if (navTabs.width() <= navItemSize[navItemSize.length - 1] + 1) {
                      $(tab01).find('.nav-tabs>.nav-item-more').removeClass('dis-none');
                  } else {
                      $(tab01).find('.nav-tabs>.nav-item-more').addClass('dis-none');
                  }

                  wNavItemMore = $(tab01).find('.nav-tabs>.nav-item-more').hasClass('dis-none') ? 0 : $(tab01).find('.nav-tabs>.nav-item-more').width();

                  for (var i = 0; i < navItemSize.length; i++) {

                      if (navTabs.width() - wNavItemMore <= navItemSize[i] + 1) {
                          $(tab01).find('.nav-tabs .nav-item').remove();

                          for (var j = i - 1; j >= 0; j--) {
                              $(navTabs).prepend($(navItem[j]).clone());
                          }

                          for (var j = i; j < navItemSize.length; j++) {
                              $(dropdownMenu).append($(navItem[j]).clone());
                          }

                          break;
                      } else {
                          $(tab01).find('.nav-tabs .nav-item').remove();

                          for (var j = i; j >= 0; j--) {
                              $(navTabs).prepend($(navItem[j]).clone());
                          }
                      }
                  }
              };
          });
      } catch (er) {
          console.log(er);
      }


      /*==================================================================
      [ Play video 01 ]*/
      try {
          var srcOld = $('.video-mo-01').children('iframe').attr('src');

          $('[data-target="#modal-video-01"]').on('click', function() {
              $('.video-mo-01').children('iframe')[0].src += "&autoplay=1";

              setTimeout(function() {
                  $('.video-mo-01').css('opacity', '1');
              }, 300);
          });

          $('[data-dismiss="modal"]').on('click', function() {
              $('.video-mo-01').children('iframe')[0].src = srcOld;
              $('.video-mo-01').css('opacity', '0');
          });
      } catch (er) {
          console.log(er);
      }


      /*==================================================================
      [ Tab mega menu ]*/
      try {
          $(window).on('load', function() {
              $('.sub-mega-menu .nav-pills > a').hover(function() {
                  // $('.sub-mega-menu .nav-pills > a').removeClass('active');
                  // $(this).addClass('active');
              });
          });
      } catch (er) {
          console.log(er);
      }

      /*==================================================================
      [ Slide100 txt ]*/

      try {
          $('.slide100-txt').each(function() {
              var slideTxt = $(this);
              var itemSlideTxt = $(this).find('.slide100-txt-item');
              var data = [];
              var count = 0;
              var animIn = $(this).data('in');
              var animOut = $(this).data('out');

              for (var i = 0; i < itemSlideTxt.length; i++) {
                  data[i] = $(itemSlideTxt[i]).clone();
                  $(data[i]).addClass('clone');
              }

              $(window).on('load', function() {
                  $(slideTxt).find('.slide100-txt-item').remove();
                  $(slideTxt).append($(data[0]).clone());
                  $(slideTxt).find('.slide100-txt-item.clone').addClass(animIn + ' visible-true');
                  count = 0;
              });

              setInterval(function() {
                  $(slideTxt).find('.slide100-txt-item.ab-t-l.' + animOut).remove();
                  $(slideTxt).find('.slide100-txt-item').addClass('ab-t-l ' + animOut);


                  if (count >= data.length - 1) {
                      count = 0;
                  } else {
                      count++;
                  }

                  // console.log($(data[count]).text());

                  $(slideTxt).append($(data[count]).clone());
                  $(slideTxt).find('.slide100-txt-item.clone').addClass(animIn + ' visible-true');
              }, 5000);
          });
      } catch (er) {
          console.log(er);
      }

    }
  }
</script>

