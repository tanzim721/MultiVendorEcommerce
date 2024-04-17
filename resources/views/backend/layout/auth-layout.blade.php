<!DOCTYPE html>
<html>
	<head>
		<!-- Basic Page Info -->
		<meta charset="utf-8" />
		<title>@yield('pageTitle')</title>

		<!-- Site favicon -->
		<link
			rel="apple-touch-icon"
			sizes="180x180"
			href="{{asset('backend/vendors/images/apple-touch-icon.png')}}"
		/>
		<link
			rel="icon"
			type="image/png"
			sizes="32x32"
			href="{{asset('backend/vendors/images/favicon-32x32.png')}}"
		/>
		<link
			rel="icon"
			type="image/png"
			sizes="16x16"
			href="{{asset('backend/vendors/images/favicon-16x16.png')}}"
		/>

		<!-- Mobile Specific Metas -->
		<meta
			name="viewport"
			content="width=device-width, initial-scale=1, maximum-scale=1"
		/>

		<!-- Google Font -->
		<link
			href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
			rel="stylesheet"
		/>
		<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="{{asset('backend/vendors/styles/core.css')}}" />
		<link
			rel="stylesheet"
			type="text/css"
			href="{{asset('backend/vendors/styles/icon-font.min.css')}}"
		/>
		<link rel="stylesheet" type="text/css" href="{{asset('backend/vendors/styles/style.css')}}" />

		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script
			async
			src="https://www.googletagmanager.com/gtag/js?id=G-GBZ3SGGX85')}}"
		></script>
		<script
			async
			src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2973766580778258"
			crossorigin="anonymous"
		></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag() {
				dataLayer.push(arguments);
			}
			gtag("js", new Date());

			gtag("config", "G-GBZ3SGGX85");
		</script>
		<!-- Google Tag Manager -->
		<script>
			(function (w, d, s, l, i) {
				w[l] = w[l] || [];
				w[l].push({ "gtm.start": new Date().getTime(), event: "gtm.js" });
				var f = d.getElementsByTagName(s)[0],
					j = d.createElement(s),
					dl = l != "dataLayer" ? "&l=" + l : "";
				j.async = true;
				j.src = "https://www.googletagmanager.com/gtm.js?id=" + i + dl;
				f.parentNode.insertBefore(j, f);
			})(window, document, "script", "dataLayer", "GTM-NXZMQSS");
		</script>
		<!-- End Google Tag Manager -->

        @livewireStyles
        @stack('stylesheets')

	</head>
	<body class="login-page">
		<div class="login-header box-shadow">
			<div class="container-fluid d-flex justify-content-between align-items-center">
				<div class="brand-logo">
					<a href="login.html">
						<img src="{{asset('backend/vendors/images/deskapp-logo.svg')}}" alt="" />
					</a>
				</div>
				<div class="login-menu">
					<ul>
                        @if ( !Route::is('admin.*') )
    						<li><a href="register.html">Register</a></li>
                        @endif 
					</ul>
				</div>
			</div>
		</div>
		<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-md-6 col-lg-7">
						<img src="{{asset('backend/vendors/images/login-page-img.png')}}" alt="" />
					</div>
					@yield('content')
				</div>
			</div>
		</div>
		
        
		<!-- js -->
		<script src="backend/vendors/scripts/core.js"></script>
		<script src="backend/vendors/scripts/script.min.js"></script>
		<script src="backend/vendors/scripts/process.js"></script>
		<script src="backend/vendors/scripts/layout-settings.js"></script>
        
        <!-- for fire-fox when admin login to home page and back to login page then return to login home page...   -->
        <script>
            if(navigator.userAgent.indexOf("Firefox") != -1){
                histry.pushState(null, null, document.URL);
                window.addEventListener('popstate', function(){
                    histroy.pushState(null, null, document.URL);
                });
            }
        </script>
        @livewireScripts
		@stack('scripts')
	</body>
</html>
