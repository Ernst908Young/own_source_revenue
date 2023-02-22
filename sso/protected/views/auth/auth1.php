<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<form action="<?=$this->createUrl('/auth/validate')?>" method="post" class="form-horizontal">
	
	<input type="hidden" name="callback_url" value="<?=$callback_url?>" />
	<input type="hidden" name="callback_failure_url" value="<?=$callback_failure_url?>" />
	<input type="hidden" name="callback_success_url" value="<?=$callback_success_url?>" />
	
	<div class="form-group" align="center">
		<h1>SSO :: Auth Level 1</h1>
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">Email / IUID</label>
		<div class="col-sm-10">
			<input type="text" name="email" class="form-control" id="inputEmail3" placeholder="Email / IUID">
		</div>
	</div>
	<div class="form-group">
		<label for="inputPassword3" class="col-sm-2 control-label">Password</label>
		<div class="col-sm-10">
			<input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Password">
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">
				Sign in
			</button>
		</div>
	</div>
</form>
