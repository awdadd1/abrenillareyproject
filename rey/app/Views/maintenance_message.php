<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Under Maintenance</title>
    <style>
        /* Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Georgia', serif;
            background: #fff5e6; /* warm vintage tone */
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            text-align: center;
        }

        /* Barbershop stripe banner */
        .stripe-banner {
            width: 100%;
            height: 30px;
            background: repeating-linear-gradient(
                45deg,
                #e74c3c,
                #e74c3c 20px,
                #ffffff 20px,
                #ffffff 40px
            );
            margin-bottom: 40px;
        }

        h1 {
            font-size: 3em;
            color: #e74c3c;
            text-shadow: 2px 2px #fff;
            margin-bottom: 20px;
        }

        p {
            font-size: 1.2em;
            color: #555;
            max-width: 500px;
            margin-bottom: 40px;
        }

        /* Barber pole icon */
        .barber-pole {
            width: 60px;
            height: 150px;
            background: repeating-linear-gradient(
                45deg,
                #e74c3c,
                #e74c3c 20px,
                #ffffff 20px,
                #ffffff 40px,
                #3498db 40px,
                #3498db 60px
            );
            border-radius: 30px;
            margin-bottom: 40px;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Optional button */
        .back-button {
            display: inline-block;
            padding: 12px 25px;
            font-size: 1em;
            background-color: #e74c3c;
            color: #fff;
            border-radius: 30px;
            text-decoration: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            transition: transform 0.2s;
        }

        .back-button:hover {
            transform: scale(1.05);
        }

        /* Responsive */
        @media(max-width: 600px) {
            h1 { font-size: 2.2em; }
            p { font-size: 1em; padding: 0 20px; }
            .barber-pole { width: 40px; height: 100px; }
        }
    </style>
</head>
<body>
    <div class="stripe-banner"></div>
    <div class="barber-pole"></div>
    <h1>🚧 Closed for Maintenance 🚧</h1>
    <p>Our barbershop is currently under maintenance. We’re trimming some issues to serve you better. Please check back soon!</p>
    <a href="/" class="back-button">Back to Home</a>
</body>
</html>
