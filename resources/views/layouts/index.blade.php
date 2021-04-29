<!DOCTYPE html>
<html lang="en">
    <head>
    	@include('layouts.header')
    	<meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body class="hold-transition sidebar-mini">
    	<div id="app">
    		<div class="wrapper">

            	@include('layouts.nav')
            	@include('layouts.aside')

    			<div class="content-wrapper">
    				@include('layouts.alert')
    				@include('layouts.breadcrumb')
    				<section class="content">
    					<div class="container-fluid">
            				@yield('content')
                  		</div>
                	</section>
    			</div>

                <!-- Control Sidebar -->
                <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
                </aside>
            	@include('layouts.footer')
            </div>
    	</div>
    	@include('layouts.scripts')
    </body>
</html>