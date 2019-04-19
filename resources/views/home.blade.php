@extends('layouts.app')

@section('content')

<div class="logo"><a href="#top"></a></div>
<ul id="nav">
  <li data-menuanchor="top" class="btn-nav1"><a href="#top">官方首頁</a></li>
  <li data-menuanchor="sec1" class="btn-nav2"><a href="#sec1">新聞資訊</a></li>
  <li data-menuanchor="sec2" class="btn-nav3"><a href="#sec2">粉絲專頁</a></li>
  <li data-menuanchor="sec3" class="btn-nav4"><a href="#sec3">遊戲特色</a></li>
</ul>
<div class="floatr">
    <div class="icon"></div>
    <div class="qr"></div>
    <div class="btn-float3"><a href="https://forum.gamer.com.tw/A.php?bsn=35984" target="_blank"></a></div>
    <div class="btn-float4"><a href="https://ob.gamebase.com.tw/game.html?category=859e996e" target="_blank"></a></div>
</div>
<div class="mouse"></div>

<div id="secGroup">
    <div class="section" id="section0">
      <div class="dlbtn">
          <div class="dl1"><a href="#" target="_blank"></a></div>
          <div class="dl2"><a href="https://play.google.com/store/apps/details?id=com.oasisgames.xhtw.gp&hl=zh-TW&ah=JuPQFW_x5iexqpF9tctTBNzlE6s" target="_blank"></a></div>
          <div class="dl3"><a href="http://smarturl.it/hzfdr1" target="_blank"></a></div>
      </div>
    </div>
    <div class="section" id="section1">
        <div class="bigpic">
            <img src="images/bigpic.png" alt="">
        </div>
        <div class="sec1">
            <div class="sec1_l">
            <div class="banner-swiper">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                      <div class="swiper-slide">
                          <img src="images/banner01.jpg" alt="">
                      </div>
                      <div class="swiper-slide">
                          <img src="images/banner02.jpg" alt="">
                      </div>
                      <div class="swiper-slide">
                          <img src="images/banner03.jpg" alt="">
                      </div>
                    </div>
              </div>
              <div class="swiper-pagination banner-nav"></div>
              </div>
        </div>
            <div class="sec1_r">
            <div class="media-news">
                <div class="news-wrap">
                    <div class="news-nav clearfix">
                        <ul>
                            <li class="btn-news1 active">最新</li>
                            <li class="btn-news2">新聞</li>
                            <li class="btn-news3">活動</li>
                            <li class="btn-news4">公告</li>
                        </ul>
                        <a href="/bulletin/list/5" class="news-more" >更多+</a>
                    </div>

                    @foreach($list as $k => $val)
                    @php
                        $active = ($k == 0) ? 'active' : '';
                    @endphp
                    <ul class="news-item-wrap {{ $active }}">
                        @foreach($val as $i => $v)
                        <li class="clearfix">
                            <div class="news-link">
                                <a href="/bulletin/info/{{ $v->id }}" title="【{{ $type_list[ $v->type_id ] }}】{{ $v->title }}">【{{ $type_list[ $v->type_id ] }}】{{ $v->title }}</a>
                            </div>
                            <span>{{ substr($v->date, 5, 10) }}</span>
                        </li>
                        @endforeach
                    </ul>
                    @endforeach

                </div>
            </div>
        </div>
        </div>
    </div>
    <div class="section" id="section2">
    <div class="fbbtn"><a href="https://www.facebook.com/ArcadiaChronicle/" target="_blank"></a></div>
    </div>
    <div class="section" id="section3">
        <div class="feture-swiper">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img src="images/md01.png" alt="">
                    </div>
                    <div class="swiper-slide">
                        <img src="images/md02.png" alt="">
                    </div>
                    <div class="swiper-slide">
                        <img src="images/md03.png" alt="">
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-prev febtn-prev"></div>
            <div class="swiper-button-next febtn-next"></div>
        </div>
    </div>

	@section('js')
    <script>
        //banner
        var swiper1 = new Swiper('.banner-swiper .swiper-container', {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            autoplay: 3000,
            pagination: '.banner-nav',
            paginationClickable: true,
        });

        //feature
        var swiper2 = new Swiper('.feture-swiper .swiper-container', {
            watchSlidesProgress: true,
            slidesPerView: 'auto',
            centeredSlides: true,
            loop: true,
            loopedSlides: 3,
            // autoplay: 3000,
            prevButton: '.febtn-prev',
            nextButton: '.febtn-next',
            onProgress: function (swiper, progress) {
                for (i = 0; i < swiper.slides.length; i++) {
                    var slide = swiper.slides.eq(i);
                    var slideProgress = swiper.slides[i].progress;
                    modify = 1;
                    if (Math.abs(slideProgress) > 1) {
                        modify = (Math.abs(slideProgress) - 1) * 0.3 + 1;
                    }
                    translate = slideProgress * modify * 180 + 'px';
                    //translate = slideProgress * modify * 745 + 'px';
                    scale = 1 - Math.abs(slideProgress) / 8;
                    //scale = 1 - Math.abs(slideProgress) / 3;
                    zIndex = 999 - Math.abs(Math.round(10 * slideProgress));
                    slide.transform('translateX(' + translate + ') scale(' + scale + ')');
                    //slide.transform('translateX(' + translate + ')');
                    slide.css('zIndex', zIndex);
                    slide.css('opacity', 1);
                    if (Math.abs(slideProgress) > 3) {
                        slide.css('opacity', 0);
                    }
                }
            },
            onSetTransition: function (swiper, transition) {
                for (var i = 0; i < swiper.slides.length; i++) {
                    var slide = swiper.slides.eq(i)
                    slide.transition(transition);
                }

            },
        });
    </script>
    @stop

@endsection
