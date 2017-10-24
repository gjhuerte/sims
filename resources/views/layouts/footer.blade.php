<style>
	@font-face {
	  font-family: 'Open Sans';
	  font-style: normal;
	  font-weight: 400;
	  src: local('Open Sans'), local('OpenSans'), url({{ asset('fonts/open-sans.woff2') }}) format('woff2');
	  unicode-range: U+0460-052F, U+20B4, U+2DE0-2DFF, U+A640-A69F;
	}

	*{
		padding:0;
		margin:0;
	}

	html{
		/*background-color: #eaf0f2;*/
		background-color: white;
	}

	body{
		font:14px/1.5 Arial, Helvetica, sans-serif;
	}

	header{
		text-align: center;
		padding-top: 100px;
		margin-bottom:200px;
	}

	header h1{
		font: normal 32px/1.5 'Open Sans', sans-serif;
		color: #3F71AE;
		padding-bottom: 16px;
	}

	header h2{
		color: #F05283;
	}

	header h2 a{
		color:inherit;
		text-decoration: none;
		display: inline-block;
		border: 1px solid #F05283;
		padding: 10px 15px;
		border-radius: 3px;
		font: bold 14px/1 'Open Sans', sans-serif;
		text-transform: uppercase;
	}

	header h2 a:hover{
		background-color:#F05283;
		transition:0.2s;
		color:#fff;
	}

	header ul {
		max-width: 600px;
		margin: 60px auto 0;
	}

	header ul a{
		text-decoration: none;
		color: #FFF;
		text-align: left;
		background-color: #B9C1CA;
		padding: 10px 16px;
		border-radius: 2px;
		opacity: 0.8;
		font-size: 16px;
		display: inline-block;
		margin: 4px;
		line-height: 1;
		outline: none;

		transition: 0.2s ease;
	}

	header ul li a.active{
		background-color: #66B650;
		pointer-events: none;
	}

	header ul li a:hover {
		opacity: 1;
	}

	header ul{
		list-style: none;
		padding: 0;
	}

	header ul li{
		display: inline-block;
	}


	/* In our demo, the footers are fixed to the bottom of the page */

	footer{
		position: fixed;
		bottom: 0;
	}

	@media (max-height:800px){
		footer { position: static; }
		header { padding-top:40px; }
	}
	.footer-distributed{
		/*background-color: #292c2f;*/
		background-color: #0d5167;
		box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.12);
		box-sizing: border-box;
		width: 100%;
		text-align: left;
		font: normal 16px sans-serif;

		padding: 45px 50px;
		margin-top: 80px;
	}

	.footer-distributed .footer-left p{
		color:  #8f9296;
		font-size: 14px;
		margin: 0;
	}

	/* Footer links */

	.footer-distributed p.footer-links{
		font-size:18px;
		font-weight: bold;
		color:  #ffffff;
		margin: 0 0 10px;
		padding: 0;
	}

	.footer-distributed p.footer-links a{
		display:inline-block;
		line-height: 1.8;
		text-decoration: none;
		color:  inherit;
	}

	.footer-distributed .footer-right{
		float: right;
		margin-top: 6px;
		max-width: 180px;
	}

	.footer-distributed .footer-right a{
		display: inline-block;
		width: 35px;
		height: 35px;
		/*background-color:  #33383b;*/
		background-color: #0d5167;
		border-radius: 2px;

		font-size: 20px;
		color: #ffffff;
		text-align: center;
		line-height: 35px;

		margin-left: 3px;
	}

	/* If you don't want the footer to be responsive, remove these media queries */

	@media (max-width: 600px) {

		.footer-distributed .footer-left,
		.footer-distributed .footer-right{
			text-align: center;
		}

		.footer-distributed .footer-right{
			float: none;
			margin: 0 auto 20px;
		}

		.footer-distributed .footer-left p.footer-links{
			line-height: 1.8;
		}
	}

</style>
	<footer class="footer-distributed">

		<div class="footer-right">

			<a href="#"><i class="fa fa-facebook"></i></a>
			<a href="#"><i class="fa fa-twitter"></i></a>
			<a href="#"><i class="fa fa-linkedin"></i></a>
			<a href="#"><i class="fa fa-github"></i></a>

		</div>

		<div class="footer-left">

			<p class="footer-links">
				<a href="#">Home</a>
				·
				<a href="#">Rules</a>
				·
				<a href="#">Reservation</a>
				·
				<a href="#">About</a>
				·
				<a href="#">Contact</a>
			</p>

			<p>CCIS - LOO &copy; 2017</p>
		</div>

	</footer>