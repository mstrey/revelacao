<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sucesso</title>
    <style>
        * {
            box-sizing: border-box;
        }
        body { 
            font-family: sans-serif; 
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: #f4f7f6;
            padding: 20px;
        }
        .success-card {
            background: #fff;
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            width: 100%;
            max-width: 500px;
            text-align: center;
        }
        .icon-success {
            width: 80px;
            height: 80px;
            background-color: #e6f9ed;
            color: #28a745;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            margin: 0 auto 20px auto;
        }
        h1 {
            font-size: 1.8rem;
            color: #333;
            margin-top: 0;
            margin-bottom: 15px;
        }
        p {
            font-size: 1.1rem;
            color: #666;
            line-height: 1.6;
            margin: 0;
        }
    </style>
</head>
<body>
    <main class="success-card">
        <div class="icon-success" aria-hidden="true">✓</div>
        <h1>Registro Salvo com Sucesso!</h1>
        <p>Obrigado. O sistema foi configurado com sucesso.</p>
    </main>
</body>
</html>