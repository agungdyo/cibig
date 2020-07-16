<style>
.wrap-input100{
    height: 65px;
}
.login100-form{
	padding-top:20px;
}
</style>
<?php if ($this->session->flashdata('berhasil')) { ?>
	<div class="flash-data" data-flashdata="<?= $this->session->flashdata('berhasil'); ?>" data-tipe="Berhasil"
	data-judul="Data Guru"></div>
<?php } if ($this->session->flashdata('gagal')) { ?>
<div class="flash-data" data-flashdata="<?= $this->session->flashdata('gagal'); ?>" data-tipe="Gagal"
	data-judul="Data Guru"></div>
<?php } ?>
<div class="limiter">
		<div class="container-login100">
			<div style="min-height: 790px" class="wrap-login100">
				<form action="<?= site_url('auth/register') ?>" method="post" class="login100-form validate-form">
					<span class="login100-form-title p-b-20 p-t-20">
						<strong>Register</strong> 
					</span>
					<div class="wrap-input100 validate-input" data-validate = "Fullname is required">
						<input class="input100" type="text" name="name" value="<?= set_value('name') ?>">
						<span class="focus-input100"></span>
						<span class="label-input100">Full name <?= form_error('name','<span class="text-error">','</span>') ?></span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Username is required">
						<input class="input100" type="text" name="username" value="<?= set_value('username') ?>">
						<span class="focus-input100"></span>
						<span class="label-input100">Username <?= form_error('username','<span class="text-error">','</span>') ?></span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Phone is required">
						<input class="input100" type="number" name="phone" value="<?= set_value('phone') ?>">
						<span class="focus-input100"></span>
						<span class="label-input100">Phone <?= form_error('phone','<span class="text-error">','</span>') ?></span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: xyz@gmail.com">
						<input class="input100" type="text" name="email" value="<?= set_value('email') ?>">
						<span class="focus-input100"></span>
						<span class="label-input100">Email <?= form_error('email','<span class="text-error">','</span>') ?></span>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="password1" value="<?= set_value('password1') ?>">
						<span class="focus-input100"></span>
						<span class="label-input100">Password <?= form_error('password1','<span class="text-error">','</span>') ?></span>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="password2" value="<?= set_value('password2') ?>">
						<span class="focus-input100"></span>
						<span class="label-input100">Re-Password <?= form_error('password2','<span class="text-error">','</span>') ?></span>
					</div>
					<div style="padding: 5px 0" class="flex-sb-m w-full p-b-10 col-md-11 col-sm-12 col-xs-12">
						<div style="margin: 0px; padding: 0" class="contact100-form-checkbox col-md-9 col-sm-9 col-xs-12">
						<div class="g-recaptcha" data-sitekey="6LdKZ9MUAAAAAFitd5nD29Lf0QBM7sVWfsbhICOA"></div>
						</div>
					</div>
					<div class="p-b-25">
						<?= (isset($captcha)) ? '<span style="float: left; margin-top: -5px; margin-bottom: 5px; position: relative; font-size: 13px" class="text-error">'.$captcha.'<span>' : NULL ?>
					</div>
					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn">
							Register
						</button>
					</div>
					<div class="text-center p-t-30 p-b-20">
						<span class="txt2">
							Have account ? <a href="<?= site_url('auth') ?>">Sign in</a>
						</span>
					</div>
                </form>
				<div class="login100-more" style="background-image: url('<?= base_url('login/') ?>images/bg-01.jpg');">
				</div>
			</div>
		<div class="respon-wa">
			<a href="https://api.whatsapp.com/send?phone=51955081075&text=Hola%21%20Quisiera%20m%C3%A1s%20informaci%C3%B3n%20sobre%20Varela%202." class="float" target="_blank">
				<i class="fa fa-whatsapp my-float"></i>
			</a>
			<a style="background: #4382f4" href="" class="float fb" target="_blank">
				<i class="fa fa-facebook my-float"></i>
			</a>
			<a style="background: #f09433; 
			background: -moz-linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%); 
			background: -webkit-linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%); 
			background: linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%); 
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f09433', endColorstr='#bc1888',GradientType=1 );" href="" class="float ig" target="_blank">
				<i class="fa fa-instagram my-float"></i>
			</a>
		</div>
		</div>
	</div>
	
	