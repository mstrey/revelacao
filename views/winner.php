<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>É um(a)...</title>
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            background: <?= $gender === 'boy' ? 'radial-gradient(circle, #d4f0ff 0%, #add8e6 100%)' : 'radial-gradient(circle, #ffe6ea 0%, #ffb6c1 100%)' ?>;
            color: #333;
            font-family: sans-serif;
            text-align: center;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            margin: 0;
            overflow: hidden;
            padding: 20px;
        }
        main {
            background: rgba(255, 255, 255, 0.4);
            padding: 40px 20px;
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            width: 100%;
            max-width: 600px;
            z-index: 10;
        }
        h2 { 
            font-size: 1.5rem; 
            margin-top: 0;
            margin-bottom: 10px; 
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #555;
        }
        h1 { 
            font-size: 3.5rem; 
            margin: 0; 
            text-transform: uppercase; 
            color: <?= $gender === 'boy' ? '#0056b3' : '#c2185b' ?>;
            text-shadow: 2px 2px 4px rgba(255,255,255,0.5);
        }

        @media (min-width: 600px) {
            h2 { font-size: 2rem; }
            h1 { font-size: 5rem; }
            main { padding: 60px 40px; }
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
</head>
<body>
    <main aria-live="assertive" aria-atomic="true">
        <h2>O nome do bebê é...</h2>
        <h1><?= htmlspecialchars($name) ?></h1>
    </main>
    
    <script>
        const color = '<?= $gender === 'boy' ? '#0000ff' : '#ff0000' ?>';
        const duration = 15 * 1000;
        const animationEnd = Date.now() + duration;

        (function frame() {
            confetti({
                particleCount: 5,
                angle: 60,
                spread: 55,
                origin: { x: 0 },
                colors: [color, '#ffffff'],
                zIndex: 1
            });
            confetti({
                particleCount: 5,
                angle: 120,
                spread: 55,
                origin: { x: 1 },
                colors: [color, '#ffffff'],
                zIndex: 1
            });

            if (Date.now() < animationEnd) {
                requestAnimationFrame(frame);
            }
        }());
    </script>
</body>
</html>