{% extends 'templates/auth.template.volt' %}
{% block title %}Registration{% endblock %}

{% block content %}
<div class="card-body">
	<p class="login-box-msg">Register a new membership</p>

	<form id="registrationForm">
		<div class="input-group mb-3">
			<input type="text" class="form-control" placeholder="Full name" id="name" name="name">
			<div class="input-group-append">
				<div class="input-group-text">
					<span class="fas fa-user"></span>
				</div>
			</div>
		</div>
		<div class="input-group mb-3">
			<input type="email" class="form-control" placeholder="Email" id="email" name="email">
			<div class="input-group-append">
				<div class="input-group-text">
					<span class="fas fa-envelope"></span>
				</div>
			</div>
		</div>
		<div class="input-group mb-3">
			<input type="password" class="form-control" placeholder="Password" id="password" name="password">
			<div class="input-group-append">
				<div class="input-group-text">
					<span class="fas fa-lock"></span>
				</div>
			</div>
		</div>
		<div class="input-group mb-3">
			<input type="password" class="form-control" placeholder="Retype password" id="confirm_password" name="confirm_password">
			<div class="input-group-append">
				<div class="input-group-text">
					<span class="fas fa-lock"></span>
				</div>
			</div>
		</div>
		<div class="row">
			<!-- /.col -->
			<div class="col-4">
				<button type="submit" class="btn btn-primary btn-block">Register</button>
			</div>
			<!-- /.col -->
		</div>
	</form>

	<a href="/auth" class="text-center">I already have a membership</a>
</div>
{% endblock %}

{% block scripts %}
<script>
	let registrationForm = document.getElementById('registrationForm');
	registrationForm.onsubmit = async (e) => {
		e.preventDefault();
		let formData = new FormData(registrationForm);
		let response = await fetch('/auth/register', {
			method: 'POST',
			body: formData
		});

		let result = await response.json();

		if (result.status) {
			window.location.href = "/";
		} else {
			alert(result.message);
		}
	};
</script> 
{% endblock %}