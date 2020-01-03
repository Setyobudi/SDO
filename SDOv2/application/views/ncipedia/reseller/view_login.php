  <!-- <p class='sidebar-title text-danger produk-title'> Login Users</p> 

            <div class='alert alert-info'>Masukkan username dan password pada form berikut untuk login,...</div>
            <br> -->
            <?php 
                echo $this->session->flashdata('message'); 
                $this->session->unset_userdata('message');
            ?>
            <div class="login-form-container">
            <div class="login-form-content">
            <div class="login-form-header">
				<h3>Masuk ke akun anda</h3>
			</div>
                <form method="post" action="<?php echo base_url(); ?>auth/login" role="form" id='formku' class="login-form">
                    <div class="input-container">
                        <i class="fa fa-envelope"></i>
                        <input type="text" name="a" class="input" placeholder="Masukkan Username" autofocus=""  minlength='5' onkeyup="nospaces(this)" required>
                    </div>

                    <div class="input-container">
                        <i class="fa fa-lock"></i>
                        <input type="password" name="b" class="form-control required" placeholder="Masukkan Password" autocomplete="off" required>
                        <i id="show-password" class="fa fa-eye"></i>
                    </div>
                        <input name='login' type="submit" class="button3" value="Login"/> 
                        <a href="<?php echo base_url(); ?>auth/register" class="register">Register</a>
                        <a href="#" class="btn btn-default" data-toggle='modal' data-target='#lupass'>Lupa Password?</a>
                </form>
            </div>
</div>

            <!-- <div class="login-form-container" id="login-form">
		<div class="login-form-content">
			<div class="login-form-header">
				<h3>Masuk ke akun anda</h3>
			</div>
			<form method="post" action="" class="login-form">
				<div class="input-container">
					<i class="fa fa-envelope"></i>
					<input type="email" class="input" name="email" placeholder="Email"/>
				</div>
				<div class="input-container">
					<i class="fa fa-lock"></i>
					<input type="password"  id="login-password" class="input" name="password" placeholder="Password"/>
					<i id="show-password" class="fa fa-eye"></i>
				</div>
				<div class="rememberme-container">
					<input type="checkbox" name="rememberme" id="rememberme"/>
					<label for="rememberme" class="rememberme"><span>Biarkan tetap masuk</span></label>
					<a class="forgot-password" href="#">Lupa Password?</a>
				</div>
				<input type="submit" name="login" value="Login" class="button"/>
				<a href="#" class="register">Register</a>
			</form>
		</div>
	</div>-->