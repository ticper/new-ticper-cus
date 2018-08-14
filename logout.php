        <!-- トラッキング（統括） -->
		<script>
			window.dataLayer = window.dataLayer || [];
  			function gtag(){dataLayer.push(arguments);}
  			gtag('js', new Date());

  			gtag('config', 'UA-121847207-5');
		</script>
NowLording...
<?php
    session_start();
    session_destroy();
    print("<script>location.href = 'index.php';</script>");
?>