  <nav class="main-header navbar navbar-expand navbar-dark bg-info">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
      <li class="nav-item">
        <!-- SEARCH FORM -->
      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
		<div class="user-panel d-flex">
			<div class="info">
				<a href="#" class="d-block">{{ Auth::user()->name }}</a>
			</div>
			<div class="image">
				<img src="{{ url('/') }}/admin_lte/dist/img/avatar5.png" class="img-circle elevation-2" alt="User Image">
			</div>
		</div>
	  </li>
	  <li class="nav-item">
        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fa fa-sign-out"></i> Sign Out</a>
		<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
			@csrf
		</form>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
