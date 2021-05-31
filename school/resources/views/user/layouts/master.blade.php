<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ URL::asset('user/css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('user/css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('user//css/main.css') }}">
    <link href="{{ URL::asset('admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ URL::asset('user/scripts/swiper-bundle.min.js') }}"></script>
    <script src="{{ URL::asset('user/scripts/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ URL::asset('user/scripts/js-dev/rules.js') }}"></script>
    <link href="{{ URL::asset('/logo-12.png') }}" rel="icon">
    <title>@yield('title')</title>
    @yield('style')
</head>

<body>
    <header id="header" class="header-v3">
        <div class="topbar-v3">
            <div class="topbar-inner">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 topbar-row">
                            <div class="topbar-content">
                                <div>
                                    <div id="block-topbarv3vi" class="block block-block-content block-block-contentcca57a7c-15b8-463f-a483-23011c933a2c no-title">


                                        <div class="content block-content">

                                            <div class="field field--name-body field--type-text-with-summary field--label-hidden field__item">
                                                <div class="row">
                                                    <div class="col-md-6 topbar-tdtuleft">
                                                        <div class="dropdown">
                                                            <a class="university" href="/en">
                                                                <img src="{{ URl::asset('user/image/university.png') }}">
                                                            </a>
                                                            <span class="dropbtn">Trường</span> 
                                                            <span class="topbar-separator">|</span>
                                                            <div class="dropdown-content">
                                                                <a target="_blank" href="https://college.tdtu.edu.vn">Trường TCCN Tôn Đức Thắng</a>
                                                                <a target="_blank" href="https://vfis.tdtu.edu.vn/vi">Trường quốc tế Việt Nam-Phần Lan</a>
                                                            </div>
                                                        </div>

                                                        <div class="dropdown">
                                                            <span class="dropbtn">Khoa</span> 
                                                            <span class="topbar-separator">|</span>
                                                            <div class="dropdown-content">
                                                                <a target="_blank" href="http://it.tdtu.edu.vn">Khoa
                                                                    công nghệ thông tin</a>
                                                                <a target="_blank"
                                                                    href="http://pharmacy.tdtu.edu.vn">Khoa dược</a>
                                                                <a target="_blank" href="http://feee.tdtu.edu.vn">Khoa
                                                                    điện-điện tử</a>
                                                                <a target="_blank" href="http://cis.tdtu.edu.vn">Khoa
                                                                    giáo dục quốc tế</a>
                                                                <a target="_blank" href="http://aaf.tdtu.edu.vn">Khoa kế
                                                                    toán</a>
                                                                <a target="_blank" href="http://fss.tdtu.edu.vn">Khoa
                                                                    khoa học thể thao</a>
                                                                <a target="_blank" href="http://fas.tdtu.edu.vn">Khoa
                                                                    khoa học ứng dụng</a>
                                                                <a target="_blank" href="http://ssh.tdtu.edu.vn">Khoa
                                                                    khoa học xã hội và nhân văn </a>
                                                                <a target="_blank" href="http://civil.tdtu.edu.vn">Khoa
                                                                    kỹ thuật công trình</a>
                                                                <a target="_blank"
                                                                    href="http://laborrelations.tdtu.edu.vn">Khoa lao
                                                                    động và công đoàn </a>
                                                                <a target="_blank" href="http://law.tdtu.edu.vn">Khoa
                                                                    luật</a>
                                                                <a target="_blank"
                                                                    href="http://enlabsafe.tdtu.edu.vn">Khoa môi trường
                                                                    và bảo hộ lao động</a>
                                                                <a target="_blank" href="http://ifa.tdtu.edu.vn">Khoa mỹ
                                                                    thuật công nghiệp</a>
                                                                <a target="_blank" href="http://ffl.tdtu.edu.vn">Khoa
                                                                    ngoại ngữ</a>
                                                                <a target="_blank" href="http://fba.tdtu.edu.vn">Khoa
                                                                    quản trị kinh doanh</a>
                                                                <a target="_blank"
                                                                    href="http://finance.tdtu.edu.vn">Khoa tài
                                                                    chính-ngân hàng</a>
                                                                <a target="_blank" href="http://fms.tdtu.edu.vn">Khoa
                                                                    toán-thống kê</a>
                                                            </div>
                                                        </div>

                                                        <div class="dropdown">
                                                            <span class="dropbtn">Viện</span> 
                                                            <span class="topbar-separator">|</span>
                                                            <div class="dropdown-content">
                                                                <a target="_blank"
                                                                    href="http://international.tdtu.edu.vn">Viện hợp tác
                                                                    quốc tế và nghiên cứu phát triển</a>
                                                                <a target="_blank" href="http://incos.tdtu.edu.vn">Viện
                                                                    khoa học tính toán</a>
                                                                <a target="_blank" href="#">Viện nghiên cứu di truyền và
                                                                    giống</a>
                                                                <a target="_blank" href="http://aimas.tdtu.edu.vn">Viện
                                                                    tiên tiến khoa học vật liệu</a>
                                                                <a target="_blank" href="http://ibep.tdtu.edu.vn">Viện
                                                                    chính sách kinh tế và kinh doanh</a>
                                                            </div>
                                                        </div>

                                                        <div class="dropdown">
                                                            <span class="dropbtn">Trung tâm</span> 
                                                            <span class="topbar-separator">|</span>
                                                            <div class="dropdown-content">
                                                                <a target="_blank" href="http://cosent.tdtu.edu.vn">TT
                                                                    an toàn lao động và công nghệ môi trường</a>
                                                                <a target="_blank" href="http://kec.tdtu.edu.vn">TT
                                                                    chuyên gia Hàn Quốc</a>
                                                                <a target="_blank" href="http://cait.tdtu.edu.vn">TT
                                                                    công nghệ thông tin ứng dụng</a>
                                                                <a target="_blank" href="http://sdtc.tdtu.edu.vn">TT đào
                                                                    tạo phát triển xã hội</a>
                                                                <a target="_blank" href="#">TT đào tạo và phát triển các
                                                                    giải pháp kinh tế </a>
                                                                <a target="_blank" href="http://dsec.tdtu.edu.vn">TT
                                                                    giáo dục quốc phòng an ninh </a>
                                                                <a target="_blank" href="http://ecc.tdtu.edu.vn">TT hợp
                                                                    tác Châu Âu </a>
                                                                <a target="_blank" href="http://ceca.tdtu.edu.vn">TT hợp
                                                                    tác doanh nghiệp và cựu sinh viên</a>
                                                                <a target="_blank" href="#">TT nghiên cứu và đào tạo
                                                                    kinh tế ứng dụng</a>
                                                                <!--a target="_blank" href="http://cifleet.tdtu.edu.vn">TT ngoại ngữ - tin học - bồi dưỡng văn hóa</a-->
                                                                <a target="_blank" href="http://clc.tdtu.edu.vn">TT ngôn
                                                                    ngữ sáng tạo</a>
                                                                <!-- <a target="_blank" href="http://ibep.tdtu.edu.vn">TT phát triển khoa học quản lý và công nghệ ứng dụng</a> -->
                                                                <a target="_blank" href="#">TT tư vấn và kiểm định xây
                                                                    dựng</a>
                                                                <a target="_blank" href="#">TT ứng dụng và phát triển mỹ
                                                                    thuật công nghiệp</a>
                                                                <a target="_blank"
                                                                    href="http://vietnamesestudies.tdtu.edu.vn">TT Việt
                                                                    Nam học và tiếng Việt cho người nước ngoài</a>
                                                                <a target="_blank" href="http://raic.tdtu.edu.vn">TT
                                                                    thông tin học thuật và nghiên cứu</a>
                                                                <a target="_blank" href="http://emas.tdtu.edu.vn">TT
                                                                    quan trắc môi trường</a>
                                                            </div>
                                                        </div>
                                                        <span class="dropbtn">
                                                            <a target="_blank" href="http://lib.tdtu.edu.vn">Thư viện</a>
                                                        </span>
                                                        <!--span class="dropbtn"><a target="_blank" href="http://vfis.tdtu.edu.vn/vi">VFIS</a></span -->
                                                        <span class="responsive-language" style="display: none;">
                                                            <a href="/en"> 
                                                                <img src="{{ URl::asset('user/image/england.png') }}">
                                                            </a>
                                                        </span>
                                                    </div>
                                                    <div class="col-md-6 topbar-tdturight">
                                                        <div class="pull-right">
                                                            <a class="user" href="{{ route('login') }}">
                                                                <img src="{{ URl::asset('user/image/user.png') }}"> | Đăng nhập
                                                            </a> 
                                                            <!-- <a href="/vien-chuc"> Giảng viên/Viên chức </a>
                                                            <span class="topbar-separator">&nbsp;|&nbsp;</span>
                                                            <a href="/sinh-vien"> Sinh viên </a>
                                                            <span class="topbar-separator">&nbsp;|&nbsp;</span>
                                                            <a href="http://ceca.tdtu.edu.vn/"> Cựu sinh viên</a>
                                                            <span class="topbar-separator">&nbsp;</span>
                                                            <span class="topbar-separator">&nbsp;</span> 
                                                            <a href="/en">
                                                                <img src="{{ URl::asset('user/image/england.png') }}">
                                                            </a> -->

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="brand">
            <div class="brand-inner">
                <div class="container">
                    <div class="row test">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="brand-left">
                                <div>
                                    <div id="block-brandleftvi" class="block block-block-content block-block-content8c96fbdd-5efb-403c-a1ca-9bb548b5959c no-title">


                                        <div class="content block-content">

                                            <div class="field field--name-body field--type-text-with-summary field--label-hidden field__item">
                                                <div class="branding-left">
                                                    <div class="row">
                                                        <div class="site-logo">
                                                            <a href="/">
                                                                <img alt="Logo-name-vi.png" data-entity-type="" data-entity-uuid="" src="{{ URl::asset('user/image/logo.png') }}"
                                                                    class="align-left">
                                                                </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="brand-right">
                                <div>
                                    <div id="block-brandrightvi"
                                        class="block block-block-content block-block-content3a223331-786c-4044-97df-16576d973473 no-title">


                                        <div class="content block-content">

                                            <div
                                                class="field field--name-body field--type-text-with-summary field--label-hidden field__item">
                                                <div id="accredit-block-vi"><img alt="tdtu" data-entity-type=""
                                                        data-entity-uuid=""
                                                        src="https://tdtu.edu.vn/sites/www/files/Brand-10-vi.png"
                                                        width="auto"></div>
                                                <coccocgrammar></coccocgrammar>
                                                <coccocgrammar></coccocgrammar>
                                                <coccocgrammar></coccocgrammar>
                                                <coccocgrammar></coccocgrammar>
                                                <coccocgrammar></coccocgrammar>
                                                <coccocgrammar></coccocgrammar>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="sticky-wrapper" style="">
            <div class="header-main gv-sticky-menu">
                <div class="container header-content-layout">
                    <div class="header-main-inner p-relative">
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-xs-8 branding">
                                <div>
                                    <div id="block-tdtunamenavbarvi"
                                        class="block block-block-content block-block-content42b676a4-2e53-4783-90f1-470798f0024a no-title">


                                        <div class="content block-content">

                                            <div
                                                class="field field--name-body field--type-text-with-summary field--label-hidden field__item">
                                                <p><a href="/"><span style="display: none;" id="navbar-name">Đại học Thuỷ Lợi</span></a>
                                                </p>
                                            </div>

                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="col-md-8 col-sm-8 col-xs-4 p-static">
                                <div class="header-inner clearfix">
                                    <div class="main-menu">
                                        <div class="area-main-menu">
                                            <div class="area-inner">
                                                <div class="gva-offcanvas-mobile">
                                                    <div class="close-offcanvas hidden"><i class="fa fa-times"></i>
                                                    </div>
                                                    <div>
                                                        <nav role="navigation"
                                                            aria-labelledby="block-gavias-edubiz-main-menu-menu"
                                                            id="block-gavias-edubiz-main-menu"
                                                            class="block block-menu navigation menu--main">


                                                            <h2 class="visually-hidden block-title"
                                                                id="block-gavias-edubiz-main-menu-menu"><span>Main
                                                                    navigation vi</span></h2>

                                                            <div class="block-content">

                                                                <div class="gva-navigation">

                                                                    <ul class="clearfix gva_menu gva_menu_main">
                                                                        <li class="menu-item">
                                                                            <a href="">
                                                                                Thông báo
                                                                            </a>
                                                                        </li>

                                                                        <li class="menu-item">
                                                                            <a href="">
                                                                                Giáo dục
                                                                            </a>
                                                                        </li>

                                                                        <li class="menu-item">
                                                                            <a href="">
                                                                                Khoa học - Cộng nghệ
                                                                            </a>
                                                                        </li>

                                                                        <li class="menu-item">
                                                                            <a href="">
                                                                                Quốc tế hoá
                                                                            </a>
                                                                        </li>

                                                                        <li class="menu-item">
                                                                            <a href="">
                                                                                Tuyển sinh
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>


                                                            </div>
                                                        </nav>

                                                    </div>




                                                </div>

                                                <div id="menu-bar" class="menu-bar hidden-lg hidden-md">
                                                    <span class="one"></span>
                                                    <span class="two"></span>
                                                    <span class="three"></span>
                                                </div>

                                                <div class="gva-search-region search-region">
                                                    <span class="icon">
                                                        <img src="{{ URl::asset('user/image/search.png') }}">
                                                    </span>
                                                    <div class="search-content">
                                                        <div>
                                                            <div class="search-block-form testing-css block block-search container-inline"
                                                                data-drupal-selector="search-block-form"
                                                                id="block-gavias-edubiz-search" role="search">


                                                                <form action="/search/node" method="get"
                                                                    id="search-block-form" accept-charset="UTF-8"
                                                                    class="search-form search-block-form">
                                                                    <div
                                                                        class="js-form-item form-item js-form-type-search form-item-keys js-form-item-keys form-no-label">
                                                                        <label for="edit-keys"
                                                                            class="visually-hidden">Tìm</label>
                                                                        <input
                                                                            title="Enter the terms you wish to search for."
                                                                            placeholder="Nhập từ khóa..."
                                                                            data-drupal-selector="edit-keys"
                                                                            type="search" id="edit-keys" name="keys"
                                                                            value="" size="15" maxlength="128"
                                                                            class="form-search">

                                                                    </div>
                                                                    <div data-drupal-selector="edit-actions"
                                                                        class="form-actions js-form-wrapper form-wrapper"
                                                                        id="edit-actions"><input
                                                                            class="search-form__submit button js-form-submit form-submit"
                                                                            data-drupal-selector="edit-submit"
                                                                            type="submit" id="edit-submit" value="Tìm">
                                                                    </div>

                                                                </form>

                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

<!--all section-->

    <div class="main main-page">
        <div class="container-full">
            <div class="content-main-inner">
                <div id="page-main-content" class="main-content">
                    <div class="main-content-inner">
                        <div class="content-main">
                            <div class="swiper-container mySwiper row-wrapper clearfix">
                                <div class="gsc-column swiper-wrapper col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="swiper-slide">
                                        <img src="{{ URl::asset('user/image/banner1.jpg') }}" alt="">
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="{{ URl::asset('user/image/banner1.jpg') }}" alt="">
                                    </div>
                                </div>
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                            </div>

                            <div class="detail">
                                <a class="btn btn-button" href="http://dkxt.tlu.edu.vn/DotDangKy" target="blank" type="button">
                                    Chi Tiết
                                </a>
                            </div>

                            <div class="info-covid" style="background: #cd2122;">
                                <h3 style="text-align: center; ">
                                    <a href="/covid-19" style="color: white; text-decoration: none;  ">Thông tin phòng chống COVID-19</a>
                                </h3>
                            </div>
                        </div>

                    @yield('content')

                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer id="footer" class="footer">
        <div class="footer-inner"> 
            <div class="footer-center">
                <div class="container">      
                   <div class="row">
                        <div class="footer-first col-lg-4 col-md-4 col-sm-12 col-xs-12 column">
                            <div>
                                <div id="block-linkfooter1" class="block block-block-content block-block-contentf68ff84d-6af0-4c49-8b85-ae338addc541 no-title">
                                    <div class="content block-content">
                                        <div class="field field--name-body field--type-text-with-summary field--label-hidden field__item">
                                            <div class="row">
                                                <div class="col-sm-5 foot-link">
                                                    <h4>Giáo dục </h4>
                                                    <ul class="list-unstyled">
                                                       <li><a href="#">Danh mục ngành</a></li>
                                                       <li><a href="#">Hướng dẫn học vụ</a></li>
                                                       <li><a href="#">Sinh viên</a></li>
                                                       <li><a href="#">Công khai thông tin</a></li>
                                                       <li><a target="_blank" href="#">Tra cứu văn bằng</a></li>
                                                    </ul>      
                                                </div>      
                                                <div class="col-sm-7 foot-link">
                                                    <h4>Khoa học-Công nghệ </h4>
                                                    <ul class="list-unstyled">
                                                        <li>
                                                            <a target="_blank" href="#">Công bố mới</a>
                                                        </li>
                                                        <li>
                                                            <a target="_blank" href="#">Đã công bố</a>
                                                        </li>
                                                        <li>
                                                            <a target="_blank" href="#">Bằng sáng chế</a>
                                                        </li>
                                                          <li>
                                                            <a target="_blank" href="#">Tạp chí khoa học </a>
                                                        </li>
                                                        <li>
                                                            <a target="_blank" href="#">Quỹ khoa học-công nghệ</a>
                                                        </li>
                                                    </ul>      
                                                </div>
                                            </div>   
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
              
                        <div class="footer-second col-lg-4 col-md-4 col-sm-12 col-xs-12 column">
                            <div>
                                <div id="block-linkfooter2" class="block block-block-content block-block-content380a7886-fec9-495f-b46b-69ec2cc21968 no-title">
                                    <div class="content block-content">
                                        <div class="field field--name-body field--type-text-with-summary field--label-hidden field__item">
                                            <div class="row">
                                                <div class="col-sm-6 foot-link">
                                                    <h4>Đơn vị trực thuộc</h4>
                                                    <ul class="list-unstyled">
                                                        <li><a href="#">Khoa-Trường</a></li>
                                                        <li><a href="#">Viện-Trung tâm</a></li>
                                                        <li><a href="#">Phòng-Ban</a></li>
                                                        <li><a href="#">Trường quốc tế Việt Nam-Phần Lan</a></li>
                                                    </ul>      
                                                </div>
                                                <div class="col-sm-6 foot-link">
                                                    <h4>Thông tin</h4>
                                                    <ul class="list-unstyled">
                                                        <li><a href="/gioi-thieu/lien-he">Liên hệ</a></li>
                                                        <li><a href="/tuyen-dung">Tuyển dụng</a></li>
                                                        <li><a target="_blank" href="https://student.tdtu.edu.vn/sv-tap-su"> Trải nghiệm</a></li>
                                                        <li><a href="/sitemap"> Sơ đồ trang</a></li>
                                                    </ul>      
                                                </div>
                                            </div>   
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
              
                        <div class="footer-four col-lg-4 col-md-4 col-sm-12 col-xs-12 column">
                            <div>
                                <div id="block-truongdaihoctonducthang" class="block block-block-content block-block-contentf1ba2619-fe59-459a-85a3-922d47d5cf96">
                                    <h2 class="block-title"><span>Đại học Thủy Lợi</span></h2>
                                    <div class="content block-content">
                                        <div class="field field--name-body field--type-text-with-summary field--label-hidden field__item">
                                            <div class="contact-info">
                                                <div>Số  Tây Sơn, Đống Đa, Hà Nội.</div>

                                                <div class="description">Kết nối với TDTU 
                                                    <a href="#" target="_blank">
                                                        <img src="" width="25px">
                                                    </a> 
                                                    <a href="#" target="_blank">
                                                        <img src="" width="25px">
                                                    </a> 
                                                    <a href="#" target="_blank">
                                                        <img src="" width="25px"> 
                                                    </a>
                                                    <a href="#" target="_blank">
                                                        <img src="" width="25px">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>   
                </div>
            </div>  
        </div>   

        <div class="copyright">
            <div class="container">
                <div class="copyright-inner">
                    <div>
                        <div id="block-gavias-edubiz-copyright" class="block block-block-content block-block-content61f17841-749f-436d-9799-1dfeefd7ad43 no-title">
                            <div class="content block-content">
                                <div class="field field--name-body field--type-text-with-summary field--label-hidden field__item">
                                    <div class="text-center text-white">Copyright © <script>new Date().getFullYear()>document.write(new Date().getFullYear());</script> Đại học Thủy Lợi
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>   
            </div>   
        </div>
        <div id="gva-popup-ajax" class="clearfix">
            <div class="pajax-content">
                <a href="javascript:void(0);" class="btn-close">
                    <i class="fa fa-times"></i>
                </a>
                <div class="gva-popup-ajax-content clearfix"></div>
            </div>
        </div>
    </footer>
</body>

</html>
