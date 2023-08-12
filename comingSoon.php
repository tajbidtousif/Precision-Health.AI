<!DOCTYPE html>
<html>
<head>
    <title>Coming Soon</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f0f0f0;
            font-family: Arial, sans-serif;
        }
        
        .content {
            text-align: center;
            margin-bottom: 20px;
        }

        .animation {
            font-size: 2.5rem;
            color: #333;
            position: relative;
            display: inline-block;
        }

        .animation::before {
            content: "Under Development";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, #ff8a00, #e52e71);
            color: transparent;
            z-index: -1;
            clip-path: polygon(0 0, 100% 0, 100% 100%, 0 100%);
            animation: reveal 2s ease-in-out infinite alternate;
        }

        @keyframes reveal {
            0% {
                transform: translateY(-100%);
            }
            100% {
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="content">
        <h1 class="animation">Coming Soon</h1>
        <p><a href="service.php">&lt;&lt; Go Back</a></p>
    </div>
</body>
</html>
