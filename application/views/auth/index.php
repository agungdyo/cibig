
<style>
	.bungkus{
		background-color: rgb(13, 150, 223);
		width: 100%;
		height: 100%;
		position: absolute;
		z-index: -1;
		opacity: 0;
		transition: 1s;
	}
	.mid{
		position: absolute;
		top: 45%;
		left: 50%;
		z-index: 9999;
		transform: translate(-50%,-50%);
	}
	.spinner {
  width: 170px;
  text-align: center;
}

.spinner > div {
  width: 38px;
  height: 38px;
  background-color: #ffff;

  border-radius: 100%;
  display: inline-block;
  -webkit-animation: sk-bouncedelay 1.4s infinite ease-in-out both;
  animation: sk-bouncedelay 1.4s infinite ease-in-out both;
}

.spinner .bounce1 {
  -webkit-animation-delay: -0.32s;
  animation-delay: -0.32s;
}

.spinner .bounce2 {
  -webkit-animation-delay: -0.16s;
  animation-delay: -0.16s;
}
	.spinner2 {
  margin: 100px auto 0;
  width: 180px;
  text-align: center;
}

.spinner2 > div {
  width: 8px;
  height: 8px;
  background-color: #ffff;

  border-radius: 100%;
  display: inline-block;
  -webkit-animation: sk-bouncedelay .8s infinite ease-in-out both;
  animation: sk-bouncedelay .8s infinite ease-in-out both;
}

.spinner2 .bounce1 {
  -webkit-animation-delay: -0.32s;
  animation-delay: -0.32s;
}

.spinner2 .bounce2 {
  -webkit-animation-delay: -0.16s;
  animation-delay: -0.16s;
}
.grupeye {
	position: absolute;
	top:50%;
	right: 10px;
	transform: translate(-50%,-50%);
	z-index: 99;
	cursor: pointer;
}

@-webkit-keyframes sk-bouncedelay {
  0%, 80%, 100% { -webkit-transform: scale(0) }
  40% { -webkit-transform: scale(1.0) }
}

@keyframes sk-bouncedelay {
  0%, 80%, 100% { 
    -webkit-transform: scale(0);
    transform: scale(0);
  } 40% { 
    -webkit-transform: scale(1.0);
    transform: scale(1.0);
  }
}
	.text-loading {
        position: absolute;
        top: 90%;
        left: 50%;
        transform: translate(-50%, -50%);
        margin: auto;
        color: white;
        text-align: center;
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    }
</style>
<div class="bungkus">
	<div class="mid">
		<h3 class="text-loading">
		<div class="spinner2">
			Loading
			<div class="bounce1"></div>
			<div class="bounce2"></div>
			<div class="bounce3"></div>
		</div>	
		</h3>
	</div>
</div>
<?php if ($this->session->flashdata('berhasil')) { ?>
	<div class="flash-data" data-flashdata="<?= $this->session->flashdata('berhasil'); ?>" data-tipe="Berhasil"
	data-judul="Data x"></div>
<?php } if ($this->session->flashdata('gagal')) { ?>
<div class="flash-data" data-flashdata="<?= $this->session->flashdata('gagal'); ?>" data-tipe="Gagal"
	data-judul="Data x"></div>
<?php } ?>
<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form method="post" class="login100-form validate-form" action="<?= site_url('auth') ?>">
					<span class="login100-form-title p-b-40">
						<strong>Login to continue</strong> 
					</span>
					<div class="wrap-input100 validate-input" data-validate = "Username is required">
						<input class="input100" type="text" name="username" id="username" value="<?= set_value('username') ?>">
						<span class="focus-input100"></span>
						<span class="label-input100">Username or Email <?= form_error('username','<span class="text-error">','</span>') ?></span>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="password" id="password" value="<?= set_value('password') ?>">
						<div class="grupeye">
							<i style="font-size: 18px" id="icon" class="fa fa-eye-slash"></i>
						</div>
						<span class="focus-input100"></span>
						<span class="label-input100">Password <?= form_error('password','<span class="text-error">','</span>') ?></span>
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
						<button id="login-btn" type="submit" name="submit" class="login100-form-btn">
							Login
						</button>
					</div>
					<div class="text-center p-t-46 p-b-20">
						<span class="txt2">
							<a href="" target="_blank" class="txt1">
								Forgot Password?
							</a><br>
							Don't have account ? <a href="<?= site_url('auth/register') ?>">Sign up</a>
						</span>
					</div>
					<div class="login100-form-social flex-c-m">
						<a href="<?= base_url() ?>" class="login100-form-social-item flex-c-m bg1 m-r-5">
							<i class="fa fa-arrow-left" aria-hidden="true"></i>
						</a>
					</div>
				</form>
				<div class="login100-more" style="background-image: url('<?= base_url('login/') ?>images/bg-01.jpg');">
			</div>
		</div>
		<div class="respon-wa">
			<a href="" class="float" target="_blank">
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
	<script>
		$("#login-btn").click(function () {
			var user = $("#username").val();
			var pass = $("#password").val();
			if (user != '' && pass != '') {
				document.querySelector(".bungkus").style.zIndex = 999;
				document.querySelector(".bungkus").style.opacity = 1;
				document.querySelector(".bungkus").style.transition = '1s';
				document.querySelector(".limiter").style.display = 'none';
			}
		});
			pass = $("#password");
			$("#icon").click( function () {
				if(pass.className == 'input100 active') {
					pass.attr('type', 'text');
					$("icon").className = 'fa fa-eye';
					pass.className = 'input100';

				} else {
					pass.attr('type', 'password');
					$("icon").className = 'fa fa-eye-slash';
					pass.className = 'input100 active';
				}

			});
	</script>
	