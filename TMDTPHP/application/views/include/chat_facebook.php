<!-- Load Facebook SDK for JavaScript -->
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js#xfbml=1&version=v2.12&autoLogAppEvents=1';
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>

	<!-- Your customer chat code -->
	<div class="fb-customerchat"
	attribution="setup_tool"
	page_id="171071540394147"
	theme_color="#13cf13"
	logged_in_greeting="Xin chào. Tôi có thể giúp gì cho bạn!"
	logged_out_greeting="Xin chào. Tôi có thể giúp gì cho bạn!">
	</div>