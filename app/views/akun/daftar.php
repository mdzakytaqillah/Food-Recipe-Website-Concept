<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?= $data['title']; ?></title>
		<link rel="icon" type="image/x-icon" href="<?= BASEURL; ?>/icon/favicon.ico">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="<?= BASEURL; ?>/css/style.css"/>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	</head>
	
	<body class="bodyy" style="background-color: aliceblue; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; font-family: Arial, sans-serif; flex-direction: column; padding: 20px; box-sizing: border-box;">
		<?php Flasher::flash(); ?>
		<div class="accwrapper">
			<div class="accinner">
				<form action="<?= BASEURL; ?>/akun/addAkun" method="post">
					<h3 style="margin-bottom: 20px;"><?= $data['title']; ?></h3>
					<div class="accform-wrapper">
						<input type="text" placeholder="Nama" name="name" id="name" class="accform-control">
					</div>
					<div class="accform-wrapper">
						<input type="text" placeholder="Username" name="username" id="username" class="accform-control">
					</div>
					<div class="accform-wrapper">
						<input type="password" placeholder="Password" name="password" id="password" class="accform-control">
					</div>
					<div class="accform-wrapper">
						<input type="password" placeholder="Confirm Password" name="password2" id="password2" class="accform-control">
					</div>
					<button type="submit" name="register" id="accbutton">Register</button>
				</form>
				<div class="accredirectlink">
					Sudah memiliki akun? <a href="<?= BASEURL; ?>/akun/login" style="text-decoration: none;">Masuk disini</a>
				</div>
			</div>
		</div>
		
	</body>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>