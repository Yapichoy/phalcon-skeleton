<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>
			{% block title %}{% endblock %}
		</title>
        {{ partial('includes/styles') }}
	</head>
	<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed sidebar-collapse">
		<div class="wrapper">
			<!-- Preloader -->
			<div class="preloader flex-column justify-content-center align-items-center">
				<img class="animation__wobble" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
			</div>

			{{ partial('includes/navbar') }}

			<!-- Main Sidebar Container -->
			{{ partial('includes/sidebar') }}

			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper"> 
                {% block content %}{% endblock %}
			</div>
            <!-- /.control-sidebar -->

            <!-- Main Footer -->
            <footer class="main-footer"></footer>
		</div>
        {{ partial('includes/scripts') }}
	</body>
</html>
