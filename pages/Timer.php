<?php
    session_start();
    include("connect.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style.css">
	<title></title>
    <style>
        /* General Reset */
        body, h1, h2 {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            color: #333;
        }

        /* Timer Container Styling */
        .timer-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(to bottom right, #FFE6C9, #FFC785);
            color: #fff;
            text-align: center;
        }

        /* Timer Styling */
        .timer {
            padding: 20px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            animation: fadeIn 1.5s ease;
        }

        /* Headings */
        .timer h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            animation: bounceIn 1s ease;
        }

        .timer h2 {
            font-size: 3rem;
        }

        /* Countdown Text */
        #countdown {
            font-weight: bold;
            color: #574964;
        }

        /* Keyframes for Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes bounceIn {
            from {
                transform: scale(0.8);
                opacity: 0.8;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }
    </style>
</head>
<body>
	<div class="timer-container">
		<div class="timer" style="display: flex; flex-direction:column; justify-content: center; align-item: center;">
		<h1>Still Count Down Ten Minutes</h1>
		<h2>
			<span id = "countdown">600</span>s
		</h2>
	</div>
	</div>

	<script type="text/javascript">
		var seconds = 600;
		function updateCountdown(){
			document.getElementById('countdown').textContent = seconds;
			seconds--;
			if (seconds<0) {
				window.location.href='sign-in.php';
			}
		}
		setInterval (updateCountdown,1000);
	</script>

</body>
</html>