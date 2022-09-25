<link rel="stylesheet" href="resources/css/style.css">
<body>
	<div class="login-container">
		<div class="container-screen">

			<?php if(!empty($model->errors)): ?>
                <div class="get-errors"><?= $model->errors ?></div>
            <?php endif; ?>

			<div class="app-title">
				<h1>Login</h1>
			</div>

			<div class="container-form">
				<form action="<?php echo $helper->url("user","login"); ?>" method="post" class="col-lg-5">
					<div class="control-group">
						<input type="text" class="login-field" value="<?php echo $model->username ?>" placeholder="Username" id="username" name="username">
						<label class="login-field-icon fui-user" for="username"></label>
					</div>

					<div class="control-group">
						<input type="password" class="login-field" value="<?php echo $model->password ?>" placeholder="Password" id="password" name="password">
						<label class="login-field-icon fui-lock" for="password"></label>
					</div>

					<button class="btn btn-primary btn-large btn-block" type="submit">Submit</button>
					<a class="login-link" href="?controller=user&action=create">REGISTER</a>
				</form>
			</div>
		</div>
	</div>
</body>