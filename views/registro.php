<link rel="stylesheet" href="resources/css/style.css">
<body>
	<div class="container">
		<div class="container-screen">
            
            <?php if(!empty($model->errors)): ?>
                <div class="get-errors"><?= $model->errors ?></div>
            <?php endif; ?>

			<div class="app-title">
				<h1>Create Acount</h1>
			</div>

			<div class="container-form">

                <form action="<?php echo $helper->url("user","create"); ?>" method="post" class="col-lg-5">
                    <div class="control-group">
                        <input type="text" value="<?php echo $model->username ?>" placeholder="Username" id="username" name="username">
                        <label for="username"></label>
                    </div>

                    <div class="control-group">
                        <input type="text" value="<?php echo $model->phone ?>" placeholder="Phone number" id="phone" name="phone">
                        <label for="phone"></label>
                    </div>

                    <div class="control-group">
                        <input type="text" value="<?php echo $model->email ?>" placeholder="Email" id="email" name="email">
                        <label for="email"></label>
                    </div>

                    <div class="control-group">
                        <input type="password" value="<?php echo $model->password ?>" placeholder="Password" id="password" name="password">
                        <label for="login-pass"></label>
                    </div>

				    <button class="btn btn-primary btn-large btn-block" type="submit">Submit</button>
                </form>
			</div>
		</div>
	</div>
</body>