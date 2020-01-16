<!DOCTYPE HTML>
<html lang = "en">
<head>
<title><?php echo $title; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="robots" content="index, follow">
	<meta name="description" content="<?php echo $description; ?>">
	<meta name="keywords" content="<?php echo $keywords; ?>">
	<meta name="author" content="phpmu.com">
	<meta name="robots" content="all,index,follow">
	<meta http-equiv="Content-Language" content="id-ID">
	<meta NAME="Distribution" CONTENT="Global">
	<meta NAME="Rating" CONTENT="General">
	<link rel="canonical" href="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>"/>
	<?php if ($this->uri->segment(1)=='berita' AND $this->uri->segment(2)=='detail'){ $rows = $this->model_utama->view_where('berita',array('judul_seo' => $this->uri->segment(3)))->row_array();
	   echo '<meta property="og:title" content="'.$title.'" />
			 <meta property="og:type" content="article" />
			 <meta property="og:url" content="'.base_url().''.$this->uri->segment(3).'" />
			 <meta property="og:image" content="'.base_url().'asset/foto_berita/'.$rows['gambar'].'" />
			 <meta property="og:description" content="'.$description.'"/>';
	} ?>
	<link rel="shortcut icon" href="<?php echo base_url(); ?>asset/images/<?php echo favicon(); ?>" />
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="rss.xml" />
	<!-- <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>template/<?php echo template(); ?>/background/<?php echo background(); ?>/reset.css" />
	<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>template/<?php echo template(); ?>/background/<?php echo background(); ?>/main-stylesheet.css" />
	<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>template/<?php echo template(); ?>/background/<?php echo background(); ?>/shortcode.css" />
	<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>template/<?php echo template(); ?>/background/<?php echo background(); ?>/fonts.css" />
	<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>template/<?php echo template(); ?>/background/<?php echo background(); ?>/responsive.css" />
	<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>template/<?php echo template(); ?>/background/style.css">
	<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>template/<?php echo template(); ?>/background/bootstrap.css">
	<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>template/<?php echo template(); ?>/background/ideaboxWeather.css">
	<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>template/<?php echo template(); ?>/slide/slide.css">
	<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>template/<?php echo template(); ?>/background/style_tp.css"> -->

	<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>template/<?php echo template(); ?>/asset/css/bootstrap.min.css">
	<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>template/<?php echo template(); ?>/asset/css/font-awesome.min.css">
	<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>template/<?php echo template(); ?>/asset/css/prettyPhoto.css">
	<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>template/<?php echo template(); ?>/asset/css/owl.carousel.css">
	<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>template/<?php echo template(); ?>/asset/css/revslider.css">
	<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>template/<?php echo template(); ?>/asset/css/style.css">
	<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>template/<?php echo template(); ?>/asset/css/responsive.css">
  <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>template/<?php echo template(); ?>/custsom.css">

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>template/<?php echo template(); ?>/asset/js/modernizr.custom.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
	<!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>/asset/admin/plugins/datatables/dataTables.bootstrap.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>template/<?php echo template(); ?>/lightbox/lightbox.css">
	<script type="text/javascript" src="<?php echo base_url(); ?>template/<?php echo template(); ?>/jscript/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>template/<?php echo template(); ?>/jscript/jquery-latest.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>template/<?php echo template(); ?>/jscript/theme-scripts.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>template/<?php echo template(); ?>/background/bootstrap.js"></script>
	<?php if ($this->uri->segment(1)=='main' OR $this->uri->segment(1)==''){ ?>
	<script type="text/javascript" src="<?php echo base_url(); ?>template/<?php echo template(); ?>/slide/js/jssor.slider-23.1.0.mini.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>template/<?php echo template(); ?>/slide/js/slide.js"></script>
	<?php } ?>
	<script src="https://members.phpmu.com/asset/js/bootstrap.min.js"></script> -->
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.0";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));

	$(document).ready(function(){
        $('#state').change(function(){
          var state_id = $(this).val();
          $.ajax({
            type:"POST",
            url:"<?php echo site_url('auth/city'); ?>",
            data:"stat_id="+state_id,
            success: function(response){
              $('#city').html(response);
            }
          })
        })
      })

      $(document).ready(function(){
        $('#state_reseller').change(function(){
          var state_id = $(this).val();
          $.ajax({
            type:"POST",
            url:"<?php echo site_url('auth/city'); ?>",
            data:"stat_id="+state_id,
            success: function(response){
              $('#city_reseller').html(response);
            }
          })
        })
      })
      
	function toDuit(number) {
	    var number = number.toString(), 
	    duit = number.split('.')[0], 
	    duit = duit.split('').reverse().join('')
	        .replace(/(\d{3}(?!$))/g, '$1,')
	        .split('').reverse().join('');
	    return 'Rp ' + duit ;
    }
	</script>
	<style type="text/css">
		@-webkit-keyframes placeHolderShimmer {
          0% {
            background-position: -468px 0;
          }
          100% {
            background-position: 468px 0;
          }
        }

        @keyframes placeHolderShimmer {
          0% {
            background-position: -468px 0;
          }
          100% {
            background-position: 468px 0;
          }
        }

        .content-placeholder {
          display: inline-block;
          -webkit-animation-duration: 1s;
          animation-duration: 1s;
          -webkit-animation-fill-mode: forwards;
          animation-fill-mode: forwards;
          -webkit-animation-iteration-count: infinite;
          animation-iteration-count: infinite;
          -webkit-animation-name: placeHolderShimmer;
          animation-name: placeHolderShimmer;
          -webkit-animation-timing-function: linear;
          animation-timing-function: linear;
          background: #f6f7f8;
          background: -webkit-gradient(linear, left top, right top, color-stop(8%, #eeeeee), color-stop(18%, #dddddd), color-stop(33%, #eeeeee));
          background: -webkit-linear-gradient(left, #eeeeee 8%, #dddddd 18%, #eeeeee 33%);
          background: linear-gradient(to right, #eeeeee 8%, #dddddd 18%, #eeeeee 33%);
          -webkit-background-size: 800px 104px;
          background-size: 800px 104px;
          height: inherit;
          position: relative;
        }

        .post_data
        {
          padding:24px;
          border:1px solid #f9f9f9;
          border-radius: 5px;
          margin-bottom: 24px;
          box-shadow: 10px 10px 5px #eeeeee;
        }
	</style>

    <style type="text/css">
      .preloader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background-color: #fff;
      }
      .preloader .loading {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%,-50%);
        font: 14px arial;
      }
    </style>
    <script>
      $(document).ready(function(){
        $(".preloader").fadeOut();
      })
    </script>

<script type="text/javascript">
	  $(document).ready(function() {

	    $(document).ajaxStart(function() {
		    $('#loading').show();
        //$('#btnload').show();
		    $('#result').hide();
	    }).ajaxStop(function() {
		    $('#loading').hide();
        //$('#btnload').hide();
		    $('#result').fadeIn('slow');
	    });

	    $('#frmAddCart').submit(function() {
		    $.ajax({
			    type: 'POST',
			    url: $(this).attr('action'),
			    data: $(this).serialize(),
			    success: function(data) {
            $('#reloading').html(data);
            $('#reloadcontent').hide();
			    }
		    })
		    return false;
	    });

      $('#frmLogin').submit(function() {
		    $.ajax({
			    type: 'POST',
			    url: $(this).attr('action'),
			    data: $(this).serialize(),
			    success: function(data) {
            $('#aksilogin').html(data);
            //console.log(data);
            //$('#reloading').html(data);
            //$('#reloadcontent').hide();
			    }
		    })
		    return false;
	    });

      $('#btnLogout').click(function(){
        var urllogout = '<?php echo base_url() ?>members/logout';
        console.log(urllogout);
        $.ajax({
			    url: urllogout,
			    success: function(data) {
            $('#aksilogout').html(data);
            //console.log(data);
            //$('#reloading').html(data);
            //$('#reloadcontent').hide();
			    }
		    })
		    return false;
      });

      var tot = document.getElementById('totbelanja').value;
      console.log(tot);

      for(var i = 1; i <= tot; ++i )
      {
        (function(x) {
          $('#hapuscart'+x).click(function(){
            var idp = document.getElementById('idpen'+x).value;
            var url = '<?php echo base_url() ?>members/keranjang_delete/'+idp;
           
            console.log(url);
            $.ajax({
              url: url,
              success: function(data) {
                //$('#reloading').html(data);
                //console.log(data);
                $('#reloading').html(data);
                $('#reloadcontent').hide();
              }
            })
            return false;
          });
        }(i))
      }

      $('#popupLogin').click(function(){
        //var urllogout = '<?php echo base_url() ?>members/logout';
        //console.log(urllogout);
        //$.ajax({
			    //url: urllogout,
			   // success: function(data) {
            //$('#aksilogout').html(data);
            //console.log(data);
            //$('#reloading').html(data);
            //$('#reloadcontent').hide();
			    //}
		   //})
		    //return false;
        swal.fire({
                title: '<h1>Login</h1>',
                icon: 'info',
                html:
                '<form method="post" action="<?php echo base_url(); ?>auth/aksilogin" role="form" id="frmLogin">' +
                '<div class="row">' +
                '<div class="col-md-12">' +
                '<p>Please login to continue</p>' +
                '</div>' +
                '</div>' +
                '<div class="row">' +
                '<div class="col-md-12">' +
                '<div class="form-group has-danger">' +
                '<label class="sr-only" for="username">E-Mail Address</label>' +
                '<div class="input-group mb-2 mr-sm-2 mb-sm-0">' +
                '<input type="text" name="a" class="form-control" id="username" placeholder="Username" required autofocus>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="row">' +
                '<div class="col-md-12">' +
                '<div class="form-group">' +
                '<label class="sr-only" for="password">Password</label>' +
                '<div class="input-group mb-2 mr-sm-2 mb-sm-0">' +
                '<input type="password" name="b" class="form-control" id="password" placeholder="Password" required>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="row">' +
                '<div class="col-md-12">' +
                '<input name="login" type="submit" class="swal2-styled" value="Login">' +
                '<!--<a class="btn btn-link" href="reset">Forgot Your Password?</a>-->' +
                '</div>' +
                '</div>' +
                '<div class="row mt-5">' +
                '<div class="col-md-12">' +
                '<div class="form-control-feedback" style="display: none;">' +
                '<span class="text-danger align-middle">' +
                '<i class="fa fa-close"></i> Incorrect username or password' +
                '</span>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</form>' +
                '<div id="aksilogin"></div>',
                showCloseButton: true,
                showConfirmButton: false
            });
      });
	})
  </script>

  <style>
    body.swal2-shown > [aria-hidden="true"] {
      filter: blur(10px);
    }
  </style>
</head>

<body>

    <div class="preloader">
      <div class="loading">
        <img src="<?php echo base_url()?>template/<?php echo template()?>/loader.gif" width="80">
        <p>Harap Tunggu</p>
      </div>
    </div>


<!--<div id='Back-to-top'>
  <img alt='Scroll to top' src='http://members.phpmu.com/asset/css/img/top.png'/>
</div> -->
<div id='aksilogout'></div>
	<div id="wrapper">
		<?php include "header.php"; ?>	
					<!-- <div class="breaking-news">
						<span class="the-title">Breaking News</span>
						<ul>
							<?php
							  $terkini = $this->model_utama->view_where_ordering_limit('berita',array('status' => 'Y'),'id_berita','DESC',0,10);
							  foreach ($terkini->result_array() as $row) {
								echo "<li><a href='".base_url()."$row[judul_seo]'>$row[judul]</a></li>";
							  }
							?>
						</ul>
					</div> -->
					
		<?php echo $contents; ?>
		<?php 
			include "footer.php";
			$this->model_utama->kunjungan(); 
		?>
	</div>
  <a href="#" id="scroll-top" title="Scroll to Top"><i class="fa fa-angle-up"></i></a><!-- End #scroll-top -->
		<!-- Scripts -->
		<script type="text/javascript" src="<?php echo base_url(); ?>template/<?php echo template(); ?>/asset/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>template/<?php echo template(); ?>/asset/js/smoothscroll.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>template/<?php echo template(); ?>/asset/js/jquery.debouncedresize.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>template/<?php echo template(); ?>/asset/js/retina.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>template/<?php echo template(); ?>/asset/js/jquery.placeholder.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>template/<?php echo template(); ?>/asset/js/jquery.hoverIntent.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>template/<?php echo template(); ?>/asset/js/twitter/jquery.tweet.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>template/<?php echo template(); ?>/asset/js/jquery.flexslider-min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>template/<?php echo template(); ?>/asset/js/owl.carousel.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>template/<?php echo template(); ?>/asset/js/jflickrfeed.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>template/<?php echo template(); ?>/asset/js/jquery.prettyPhoto.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>template/<?php echo template(); ?>/asset/js/jquery.themepunch.tools.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>template/<?php echo template(); ?>/asset/js/jquery.themepunch.revolution.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>template/<?php echo template(); ?>/asset/js/main.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>template/<?php echo template(); ?>/asset/js/ongkir.js"></script>
		


  <script>
    $(document).ready(function(){

      //var limit = 6;
      if ($(window).width() < 960) {
        var limit = 2;
        var limits = 1;
      }
      else {
        var limit = 6;
        var limits = 3;
      }
      var start = 0;
      var action = 'inactive';

      function lazzy_loader(limit)
      {
        var output = '';
        for(var count=0; count<limits; count++)
        {
          output += '<div class="col-sm-12 col-md-6 col-lg-4 p-b-50">';
          output += '<div class="block2">';
          output += '<p><span class="content-placeholder" style="width:100%; min-height:195px;">&nbsp;</span></p>';
          output += '<p><span class="content-placeholder" style="width:100%; height: 54px;">&nbsp;</span></p>';
          output += '<p><span class="content-placeholder" style="width:100%; height: 18px;">&nbsp;</span></p>';
          output += '<p><span class="content-placeholder" style="width:100%; height: 35px;">&nbsp;</span></p>';
          output += '</div>';
          output += '</div>';
        }
        $('#load_data_message').html(output);
      }

      lazzy_loader(limit);

      function load_data(limit, start)
      {
        $.ajax({
          url:"<?php echo base_url(); ?>produk/fetch_produk",
          method:"POST",
          data:{limit:limit, start:start},
          cache: false,
          success:function(data)
          {
            if(data == '')
            {
              $('#load_data_message').html('<div class="row" id="load_data_message"><div class="col-md-12"><div class="alert alert-info col-md-12 text-center"><small>Tidak ada Produk untuk di tampilkan lagi</small></div></div></div>');
              action = 'active';
            }
            else
            {
              $('#load_data').append(data);
              $('#load_data_message').html("");
              action = 'inactive';
            }
          }
        })
      }

      if(action == 'inactive')
      {
        action = 'active';
        load_data(limit, start);
      }

      $(window).scroll(function(){
        if($(window).scrollTop() + $(window).height() > $("#load_data").height() && action == 'inactive')
        {
          lazzy_loader(limit);
          action = 'active';
          start = start + limit;
          setTimeout(function(){
            load_data(limit, start);
          }, 2000);
        }
      });

    });
</script>

		<script>
        $(function() {

            // Slider Revolution
            jQuery('#slider-rev').revolution({
                delay:5000,
                startwidth:870,
                startheight:520,
                onHoverStop:"true",
                hideThumbs:250,
                navigationHAlign:"center",
                navigationVAlign:"bottom",
                navigationHOffset:0,
                navigationVOffset:15,
                soloArrowLeftHalign:"left",
                soloArrowLeftValign:"center",
                soloArrowLeftHOffset:0,
                soloArrowLeftVOffset:0,
                soloArrowRightHalign:"right",
                soloArrowRightValign:"center",
                soloArrowRightHOffset:0,
                soloArrowRightVOffset:0,
                touchenabled:"on",
                stopAtSlide:-1,
                stopAfterLoops:-1,
                dottedOverlay:"none",
                fullWidth:"on",
                spinned:"spinner4", 
                shadow:3, // 1 2 3 to change shadows
                hideTimerBar: "on",
                // navigationStyle:"preview2"
              });

            /* This is fix for mobile devices position slider at the top  via absolute pos */
            var fixSliderForMobile = function () {
                var winWidth = $(window).width();

                if (winWidth <= 767 && $('#slider-rev-container').length) {
                    var revSliderHeight = $('#slider-rev').height();
                        console.log(revSliderHeight);
                    $('.slider-position').css('padding-top', revSliderHeight);
                    $('.main-content').css('position', 'static');
                } else {
                    $('.slider-position').css('padding-top', 0);
                    $('.main-content').css('position', 'relative');
                }
            };

            fixSliderForMobile();

            /* Resize fix positionin */
            if($.event.special.debouncedresize) {
                $(window).on('debouncedresize', function() {
                    fixSliderForMobile();
                });
            } else {
                $(window).on('resize', function () {
                    fixSliderForMobile();
                });
            }
            
                
        });
    </script>

<script>
  function openLink(evt, animName) {
  var i, x, tablinks;
  x = document.getElementsByClassName("city");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < x.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" w3-red", "");
  }
  document.getElementById(animName).style.display = "block";
  evt.currentTarget.className += " w3-red";
}
</script>

	<script type='text/javascript'>
		$(function() { $(window).scroll(function() {
		    if($(this).scrollTop()>400) { $('#Back-to-top').fadeIn(); }else { $('#Back-to-top').fadeOut();}});
		    $('#Back-to-top').click(function() {
		        $('body,html')
		        .animate({scrollTop:0},300)
		        .animate({scrollTop:40},200)
		        .animate({scrollTop:0},130)
		        .animate({scrollTop:15},100)
		        .animate({scrollTop:0},70);
		        });
		});

		function jam(){
			var waktu = new Date();
			var jam = waktu.getHours();
			var menit = waktu.getMinutes();
			var detik = waktu.getSeconds();
			 
			if (jam < 10){ jam = "0" + jam; }
			if (menit < 10){ menit = "0" + menit; }
			if (detik < 10){ detik = "0" + detik; }
			var jam_div = document.getElementById('jam');
			jam_div.innerHTML = jam + ":" + menit + ":" + detik;
			setTimeout("jam()", 1000);
		} jam();

		</script>

	<script type="text/javascript">
      (function (jQuery) {
      $.fn.ideaboxWeather = function (settings) {
      var defaults = {
      modulid   :'Swarakalibata',
      width :'100%',
      themecolor    :'#2582bd',
      todaytext :'Hari Ini',
      radius    :true,
      location  :' Jakarta',
      daycount  :7,
      imgpath   :'img_cuaca/', 
      template  :'vertical',
      lang  :'id',
      metric    :'C', 
      days  :["Minggu","Senin","Selasa","Rabu","Kamis","Jum'at","Sabtu"],
      dayssmall :["Mg","Sn","Sl","Rb","Km","Jm","Sa"]};
      var settings = $.extend(defaults, settings);

      return this.each(function () {
      settings.modulid = "#" + $(this).attr("id");
      $(settings.modulid).css({"width":settings.width,"background":settings.themecolor});

      if (settings.radius)
      $(settings.modulid).addClass("ow-border");

      getWeather();
      resizeEvent();

      $(window).on("resize",function(){
      resizeEvent();});

      function resizeEvent(){
      var mW=$(settings.modulid).width();

      if (mW<200){
      $(settings.modulid).addClass("ow-small");}
      else{
      $(settings.modulid).removeClass("ow-small");}}

      function getWeather(){$.get("http://api.openweathermap.org/data/2.5/forecast/daily?q="+settings.location+"&mode=xml&units=metric&cnt="+settings.daycount+"&lang="+settings.lang+"&appid=b318ee3082fcae85097e680e36b9c749", function(data) {
      var $XML = $(data);
      var sstr = "";
      var location = $XML.find("name").text();
      $XML.find("time").each(function(index,element) {
      var $this = $(this);
      var d = new Date($(this).attr("day"));
      var n = d.getDay();
      var metrics = "";
      if (settings.metric=="F"){
      metrics = Math.round($this.find("temperature").attr("day") * 1.8 + 32)+"°F";}
      else{
      metrics = Math.round($this.find("temperature").attr("day"))+"°C";}

      if (index==0){
      if (settings.template=="vertical"){
      sstr=sstr+'<div class="ow-today">'+
      '<span><img src="<?php echo base_url(); ?>asset/'+settings.imgpath+$this.find("symbol").attr("var")+'.png"/></span>'+
      '<h2>'+metrics+'<span>'+ucFirst($this.find("symbol").attr("name"))+'</span><b>'+location+' - '+settings.todaytext+'</b></h2>'+
      '</div>';}
      else{
      sstr=sstr+'<div class="ow-today">'+
      '<span><img src="<?php echo base_url(); ?>asset/'+settings.imgpath+$this.find("symbol").attr("var")+'.png"/></span>'+
      '<h2>'+metrics+'<span>'+ucFirst($this.find("symbol").attr("name"))+'</span><b>'+location+' - '+settings.todaytext+'</b></h2>'+
      '</div>';}}
      else{
      if (settings.template=="vertical"){
      sstr=sstr+'<div class="ow-days">'+
      '<span>'+settings.days[n]+'</span>'+
      '<p><img src="<?php echo base_url(); ?>asset/'+settings.imgpath+$this.find("symbol").attr("var")+'.png" title="'+ucFirst($this.find("symbol").attr("name"))+'"> <b>'+metrics+'</b></p>'+
      '</div>';}
      else{
      sstr=sstr+'<div class="ow-dayssmall" style="width:'+100/(settings.daycount-1)+'%">'+
      '<span title='+settings.days[n]+'>'+settings.dayssmall[n]+'</span>'+
      '<p><img src="<?php echo base_url(); ?>asset/'+settings.imgpath+$this.find("symbol").attr("var")+'.png" title="'+ucFirst($this.find("symbol").attr("name"))+'"></p>'+
      '<b>'+metrics+'</b>'+
      '</div>';}}});

      $(settings.modulid).html(sstr); 
      });}

      function ucFirst(string) {
      return string.substring(0, 1).toUpperCase() + string.substring(1).toLowerCase();}});
      };
      })(jQuery);

      $(document).ready(function(){
      $('#example1').ideaboxWeather({
      location      :' Jakarta, ID'});});
    </script>

    <script>
	$(function(){
	    var url = window.location.pathname, 
	        urlRegExp = new RegExp(url.replace(/\/$/,'') + "$"); // create regexp to match current url pathname and remove trailing slash if present as it could collide with the link in navigation in case trailing slash wasn't present there
	        // now grab every link from the navigation
	        $('.the-menu a').each(function(){
	            // and test its normalized href against the url pathname regexp
	            if(urlRegExp.test(this.href.replace(/\/$/,''))){
	                $(this).addClass('active');
	            }
	        });

	});
	</script>
	<script src="<?php echo base_url(); ?>asset/admin/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/admin/plugins/datatables/dataTables.bootstrap.min.js"></script>
	<script>
      $(function () { 
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "scrollX": true,
          "lengthMenu": [[30, 55, 70, -1], [30, 55, 70, "All"]]
        });
      });
    </script>
</body>
</html>