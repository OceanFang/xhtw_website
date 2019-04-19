<!DOCTYPE html>
@php
$v = mt_rand(1, 99);
@endphp
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=1200, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>《邂逅在迷宮》同人插畫大賽</title>
    <meta name="keywords" content="邂逅在迷宮,動漫,動畫,漫畫,二次元,手機遊戲,卡牌,放置,同人,FF33,遊戲綠洲">
    <meta name="description" content="由遊戲綠洲代理，BEST KIRIN GLOBAL LIMITED所開發的《邂逅在迷宮》，投入大量心血並耗時三年完成的匠心巨作，將帶給玩家體驗正統二次元動漫風，特邀中日兩岸的知名畫師及豪華日本聲優陣容加入，打造最純的日系手遊！">
    <link rel="image_src" href="//xhtw.oasisgames.com.tw/fan-fiction/190227_s/images/fb.jpg">
    <link rel="stylesheet" href="{{ URL::asset('/fan-fiction/190227_s/css/screen.css?v'. $v) }}">
        <!-- Facebook Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '369162300520170');
  fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=369162300520170&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->

</head>


<script>

(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/zh_TW/sdk.js#xfbml=1&version=v2.3";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));


window.fbAsyncInit = function() {
                FB.init({
                    appId: '2265064540439599',
                    xfbml: true,
                    version: 'v2.3'
                });

      window.myFB = {};

      FB.getLoginStatus(function(response){

      $(function(){


          function get_fb_oid(do_login){
            if(response.status === 'connected'){

                myFB.accessToken    = response.authResponse.accessToken;
                myFB.expiresIn      = response.authResponse.expiresIn;
                myFB.signedRequest  = response.authResponse.signedRequest;
                myFB.fbuid          = response.authResponse.userID;

                var oid = myFB.fbuid;
                // console.log(oid);
                return oid;
            } else {

                  if(do_login) {

                      // Otherwise, show Login dialog first.
                      FB.login(function(response) {
                        // console.log(response);
                        window.location.reload();
                      }, {scope: 'email'});
                  }
            }

          }

          var oid = get_fb_oid(false);

          if(oid) {
              var id = null;
              var tid = '<?php echo $type_id; ?>';

              var data = { "id": id, "tid": tid, "oid": oid };
              var url = '/fan-fiction/190227/getVote';
              var res = JSON.parse(doAjax(url, data));

              var re_id = res.id;
              var re_tid = res.tid;

              // console.log(re_id);
              // console.log(re_tid);

              if (re_id) {
                  $('.vote_' + re_id).parent().addClass('disabled').html('<a href="#"><span class="vote"></span>已投</a>');
              }
          }


          $('.vote_btn').click(function(){
                var oid = get_fb_oid(true);
                var id = $(this).data('id');
                var tid = $(this).data('tid');

                if(oid) {
                    var data = { "id": id, "tid": tid, "oid": oid };
                    var url = '/fan-fiction/190227/vote';
                    var res = JSON.parse(doAjax(url, data));

                    // console.log(res.response);
                    // return;
                    var status = res.status;
                    var msg = res.response;

                    alert(msg);
                    window.location.reload();
                }

          });


          function doAjax(url, data) {

              var dataType = 'text';
              var type = 'GET';

              var result_arr;
              $.ajax({
                  url: url,
                  data: data,
                  dataType: dataType,
                  type: type,
                  async: false,
                  success: function(data) {
                      return result_arr = data;
                  }
              });

              return result_arr;
          }

      });
  });
};


</script>

<body>
<div class="pop-dark-bg"></div>
<div class="wrap">
   <div class="top">
       <div class="logo" title="回《邂逅在迷宮》首頁">
           <a href="https://xhtw.oasisgames.com.tw/" target="_blank"></a>
       </div>
       <div class="topbtn" title="投稿">
           <a href="https://goo.gl/forms/Oy0Qze0nzdW7Vt4m1" target="_blank"></a>
       </div>
   </div>
   <nav>
       <ul class="container">
           <li class="nav-b1 active"><a href="/fan-fiction/190227"></a></li>
           <li class="nav-b2"><a href="/fan-fiction/190227/r18"></a></li>
           <li class="nav-b3"><a href="/fan-fiction/190227/notice"></a></li>
           <li class="nav-b4"><a href="/" target="_blank"></a></li>
       </ul>
   </nav>
   <section class="page container">
        <div class="title1"></div>
        <div class="btngroup1">
            <div id="hot_par" class="btn {{ (is_null($request->hot) && is_null($request->new)) || !is_null($request->hot) ? 'active' : '' }}"><a href="javascript:void(0)" class="list_btn" id="hot">★熱門</a></div>
            <div id="new_par" class="btn {{ is_null($request->new) ? '' : 'active' }}"><a href="javascript:void(0)" class="list_btn" id="new">★最新</a></div>
        </div>
        @foreach($list as $k => $val)
        @php
            $active = ($k == 'hot') ? 'active' : '';
        @endphp
        <div class="picgroup {{ $k }} {{ $active }}">
            @foreach($val as $i => $v)
            <div class="picbtn">
                <div class="pictb">

                    <a href="/fan-fiction/190227/info/{{ $v->id }}"><img src="{{ $v->img }}" alt=""></a>
                </div>
                <h2>{{ $v->author }} - {{ $v->title }}</h2>
                <h3><span class="likes">{{ $v->like_cnt }}</span>票</h3>
                <div class="btn"><a href="#" id="vote_{{ $v->id }}" class="vote_btn vote_{{ $v->id }}" data-id="{{ $v->id }}" data-tid="{{ $v->type_id }}"><span class="vote"></span>投票</a></div>
                <!-- <div class="btn disabled"><a href="#"><span class="vote"></span>已投</a></div> -->
            </div>
            @endforeach
        </div>

        @if ($val->hasPages())
        <div class="pagenav {{ $k }} {{ $active }}">

            <div class="btn"><a href="{{ $val->url(1) }}">第一頁</a></div>
            <div class="btn"><a href="{{ $val->previousPageUrl() }}">上一頁</a></div>

            <select id="page_sel">
                @for( $i = 1; $i <= $val->lastPage(); $i++)
                    @php
                        if ( ($k == 'hot') && (!is_null($request->hot)) ):
                            $page = $request->hot;
                        elseif ( ($k == 'new') && (!is_null($request->new)) ):
                            $page = $request->new;
                        else:
                            $page = 1;
                        endif;

                        $selected = ($i == $page) ? 'selected' : '';
                    @endphp
                    <option value="{{ $val->url($i) }}" {{ $selected }}>{{$i}}</option>
                @endfor
            </select>
            <div class="btn"><a href="{{ $val->nextPageUrl() }}">下一頁</a></div>
            <div class="btn"><a href="{{ $val->url($val->lastPage()) }}">最後頁</a></div>

        </div>
        @endif

        @endforeach
   </section>
</div>
<footer>
    <div class="container">
        <img class="footer-logo1" src="{{ URL::asset('/fan-fiction/190227_s') }}/images/oasis_logo.png" alt="遊戲綠洲">
        <img class="footer-logo2" src="{{ URL::asset('/fan-fiction/190227_s') }}/images/foot_logo.png" alt="Best Kirin">
        <img class="footer-class" src="{{ URL::asset('/fan-fiction/190227_s') }}/images/class6.png" alt="保護級">
        <span>©Best Kirin Global Limited All Rights Reserved.<br>
        ©Oasis Games Co., Ltd.  All Rights Reserved.</span>
    </div>
</footer>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script src="{{ URL::asset('/fan-fiction/190227_s/js/script.js?v'. $v) }}"></script>

<!-- Global site tag (gtag.js) - Google Ads: 775856302 -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-775856302"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'AW-775856302');
    </script>
    <!-- End Global site tag (gtag.js) - Google Ads: 775856302 -->

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-PC6W3PM');</script>
    <!-- End Google Tag Manager -->

    <script type="text/javascript">
    $(function(){

        $( window).load(function() {
            if($('#hot_par').hasClass("active")){
                $('#hot').children().trigger( "click" );
            }

            if($('#new_par').hasClass("active")){
                $('#new').trigger( "click" );
            }
        });

        var type = '<?php echo $type; ?>';
        if(type == 'r18') {
            $('.title1').css({ "background-image": 'url(/fan-fiction/190227_s/images/t2.png)'});
            $('.nav-b2').addClass('active');
            $(".nav-b2").siblings().removeClass('active');
        }

        $('.list_btn').on('click',function(){
            var picgroup = this.id;
            $(this).parent().siblings().removeClass('active');
            $(this).parent().addClass('active');
            $(".picgroup").siblings().removeClass('active');
            $(".picgroup").filter("." + picgroup).addClass('active');
            $(".pagenav").filter("." + picgroup).addClass('active');
        });

        $('#page_sel').on('change', function() {
            var url = $(this).val();
            window.location.href = url;
        });
    });
    </script>
</body>
</html>
