<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contagem Regressiva</title>
    <style>
        * { 
            box-sizing: border-box; 
        }
        body { 
            margin: 0;
            font-family: sans-serif; 
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: #f4f7f6;
            color: #333;
            padding: 20px;
            text-align: center;
        }
        h1 {
            font-size: 2rem;
            margin-bottom: 40px;
            color: #444;
        }
        .countdown-wrapper {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
        }
        .time-box {
            background: #fff;
            min-width: 80px;
            padding: 20px 15px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .time-value {
            font-size: 2.5rem;
            font-weight: bold;
            color: #222;
            line-height: 1;
        }
        .time-label {
            font-size: 0.9rem;
            color: #777;
            margin-top: 8px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Ajustes para telas maiores (Desktop/Tablets) */
        @media (min-width: 600px) {
            h1 { font-size: 2.5rem; }
            .time-box { min-width: 120px; padding: 30px 20px; }
            .time-value { font-size: 3.5rem; }
            .time-label { font-size: 1rem; }
        }
    </style>
</head>
<body>
    <h1>O Grande Dia Está Chegando!</h1>
    
    <div class="countdown-wrapper" aria-live="polite" aria-atomic="true">
        <div class="time-box">
            <span class="time-value" id="d">00</span>
            <span class="time-label">Dias</span>
        </div>
        <div class="time-box">
            <span class="time-value" id="h">00</span>
            <span class="time-label">Horas</span>
        </div>
        <div class="time-box">
            <span class="time-value" id="m">00</span>
            <span class="time-label">Minutos</span>
        </div>
        <div class="time-box">
            <span class="time-value" id="s">00</span>
            <span class="time-label">Segundos</span>
        </div>
    </div>

    <script>
        const target = new Date("<?= $revealDate ?>").getTime();
        
        const elDays = document.getElementById("d");
        const elHours = document.getElementById("h");
        const elMinutes = document.getElementById("m");
        const elSeconds = document.getElementById("s");

        setInterval(function() {
            const now = new Date().getTime();
            const dist = target - now;
            
            if (dist < 0) {
                window.location.reload();
            } else {
                const d = Math.floor(dist / (1000 * 60 * 60 * 24));
                const h = Math.floor((dist % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const m = Math.floor((dist % (1000 * 60 * 60)) / (1000 * 60));
                const s = Math.floor((dist % (1000 * 60)) / 1000);
                
                elDays.innerText = String(d).padStart(2, '0');
                elHours.innerText = String(h).padStart(2, '0');
                elMinutes.innerText = String(m).padStart(2, '0');
                elSeconds.innerText = String(s).padStart(2, '0');
            }
        }, 1000);
    </script>
</body>
</html>