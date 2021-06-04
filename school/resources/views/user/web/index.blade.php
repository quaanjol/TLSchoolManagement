@extends('user.layouts.master')

@section('title')
Trang chủ
@endsection

@section('content')
<!--Tin tuc-->
<div class="section-new">
    <div class="container">
        <p class="title">Tin Tức</p>
        <div class="swiper-container swiper-container-js box-new">
            <div class="swiper-wrapper">
                @foreach($newss as $news)
                <div class="item-columns swiper-slide">
                    <div>
                        <div class="views-field views-field-nothing">
                            <div class="field-content">
                                <div class="post-block hover01">
                                    <div class="post-image ">
                                        <figure>
                                            <a href="#" hreflang="vi">
                                                <img src="{{ URL::asset($news->img) }}" alt="" typeof="Image">
                                            </a>
                                        </figure>
                                    </div>
                                    <div class="post-content">
                                        <div class="post-title">
                                            <a href="#" hreflang="vi">{{ $news->title }}
                                        </div>
                                        <div class="post-meta">
                                            <span class="post-categories">
                                                <a href="/index.php/tin-tuc/doan-the" hreflang="vi">
                                                    {{ $news->PostCategory->name }}
                                                </a>
                                            </span>&nbsp;|&nbsp;
                                            <span class="post-created">
                                                {{date('d/m/Y', strtotime($news->created_at))}}
                                            </span>
                                        </div>
                                        <!-- <div class="post-sum">{!!Str::words($news->description, 15)!!}</div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="more">
            <a href="#" class="read-more">Trang Tin Tức >> </a>
        </div>
    </div>
</div>
<!-- Event -->
<div class="section-event">
    <div class="container event">
        <p class="title">Sự Kiện</p>
        @foreach($events as $event)
        <div class="item-columns">
            <div>
                <!-- Start Display article for teaser page -->
                    <article class="node node-detail node--type-event node--promoted node--view-mode-teaser clearfix">
                        <div class="event-block">
                            <div class="event-image">
                                <div class="field field--name-field-event-image field--type-image field--label-hidden field__item">  
                                    <a href="#">
                                        <img src="{{ URl::asset($event->img) }}" alt="">
                                    </a>
                                </div>
                            
                                <div class="date"> 
                                    <span class="icon"><i class="gv-icon-1103"></i></span>
                                    <span class="day">
                                        @if($event->event_date != null)
                                        {{date('d/m/Y', strtotime($news->event_date))}}
                                        @else
                                        n/a
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <div class="event-content">  
                                <div class="event-info">
                                    <div class="title-event">
                                        <a href="#">
                                            <span>{{ $event->title }}</span>
                                        </a>
                                    </div>
                                    <!-- <div class="body">
                                        <div class="field field--name-body field--type-text-with-summary field--label-hidden field__item">Có 50 doanh nghiệp và khoảng hơn 5.000 sinh viên mới tốt nghiệp và sinh viên năm cuối của TDTU tham dự chương trình.</div>
                                    </div> -->
                                </div>
                            </div>  
                        </div>   
                    </article>  
                
                <!-- End Display article for teaser page -->
            </div>
        </div>
        @endforeach
        
        <div class="item-columns">
            <div>
                <!-- Start Display article for teaser page -->
                
                <div class="item-list">

                    <ul>
                        @foreach($events as $event)
                        <li class="view-list-item">
                            <div class="views-field views-field-nothing">
                                <div class="field-content">
                                    <div class="event-block-list">
                                        <div class="event-date">
                                            <span class="day">
                                                {{date('d', strtotime($event->event_date))}}
                                            </span>
                                            <span class="month">Tháng 
                                                {{date('m', strtotime($event->event_date))}}
                                            </span>
                                        </div>
                                        <div class="event-content">
                                            <div class="event-title">
                                                <a href="#" hreflang="vi">{{ $event->title }}</a>
                                            </div>
                                        </div>  
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach                            
                    </ul>
                    
                    </div>
                
                <!-- End Display article for teaser page -->
                </div>
        </div>


        <div class="more">
            <a href="#" class="read-more">Trang Tin Tức >> </a>
        </div>
    </div>
</div>

<!-- Why chosse -->
<div class="section-new">
    <div class="container">
        <p class="title">CHỌN TLU ĐỂ XÂY DỰNG TƯƠNG LAI, TẠI SAO?</p>
        <section class="timeline">
            <ul>
                <li>
                    <div>
                    <time>1</time>
                    <div class="discovery">
                        <p>
                        TLU là đại học số 1 Việt Nam và Top 800 đại học tốt nhất thế giới về mọi mặt
                        </p>
                    </div>
                    </div>
                </li>
                <li>
                    <div>
                    <time>2</time>
                    <div class="discovery">
                        <p>
                        Điều kiện, phương pháp dạy và học chuyên dụng, hiện đại
                        </p>
                    </div>
                    </div>
                </li>
                <li>
                    <div>
                    <time>3</time>
                    <div class="discovery">
                        <p>
                        Lực lượng chuyên môn hùng mạnh và chuyên nghiệp
                        </p>
                    </div>
                    </div>
                </li>
                <li>
                    <div>
                    <time>4</time>
                    <div class="discovery">
                        <p>
                        Chương trình giáo dục đại học và sau đại học tiên tiến
                        </p>
                    </div>
                    </div>
                </li>
                <li>
                    <div>
                    <time>5</time>
                    <div class="discovery">
                        <p>
                        Môi trường rèn luyện tốt nhất
                        </p>
                    </div>
                    </div>
                </li>
            </ul>     
        </section>
    </div>
</div>


<!-- All KHoa -->
<div class="section-khoa">
    <div class="container">
        <p class="title">CÁC KHOA</p>

        <div class="swiper-container swiper-container-khoa clearfix">
        <div class="gsc-column swiper-wrapper col-lg-12 col-md-12 col-sm-12 col-xs-12">
            @foreach($departments as $department)
            <div class="swiper-slide">
                <img src="https://vssmge.org/wp-content/uploads/2016/06/DHTL.jpg" alt="">
                <p class="ten-khoa">{{ $department->name }}</p>
            </div>
            @endforeach
        </div>
        <div class="swiper-pagination"></div>
    </div>
    </div>
</div>
@endsection