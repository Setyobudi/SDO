<section id="content">
<div class="md-margin"></div><!-- .space -->
        	<div class="container">
        		<div class="row">
        			<div class="col-md-12">
						<header class="content-title">
                            <h1 class="title">Masuk ke PekanRaya</h1>
                            <p class="title-desc">Jika belum mempunyai akun, daftar <a href="<?php echo base_url(); ?>auth/register">disini</a>.</p>
                            <div class="md-margin"></div><!-- space -->
						</header>
        			
						   <div class="row">
							   	<div class="col-md-6 col-sm-6 col-xs-12">
                                   <form method="post" action="<?php echo base_url(); ?>auth/aksilogin" role="form" id='frmLogin'>
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="input-icon input-icon-email"></span><span class="input-text">Username</span></span>
                                            <input type="text" name="a" class="form-control input-lg" placeholder="Masukkan Username" autofocus=""  minlength='5' required>
                                        </div>
                                         <div class="input-group xs-margin">
                                            <span class="input-group-addon"><span class="input-icon input-icon-password"></span><span class="input-text">Password</span></span>
                                            <input type="password" name="b" class="form-control input-lg" placeholder="Masukkan Password" autocomplete="off" required>
                                        </div>
                                    <span class="help-block text-right"><a href="#" data-toggle='modal' data-target='#lupass'>Lupa Password?</a></span>
                                    <input name='login' type="submit" class="btn btn-custom-2" value="Login"/>
                                    </form>
                                    <div class="sm-margin"></div>
							   	</div>
						   </div><!-- End.row -->
								   
        			</div><!-- End .col-md-12 -->
        		</div><!-- End .row -->
			</div><!-- End .container -->
            <div id='aksilogin'></div>
        </section><!-- End #content -->