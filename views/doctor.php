<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro do Sexo</title>
    <style>
        * {
            box-sizing: border-box;
        }
        body { 
            font-family: sans-serif; 
            text-align: center; 
            padding: 20px; 
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: #f4f7f6;
        }
        h1 {
            font-size: 1.8rem;
            color: #333;
            margin-bottom: 40px;
        }
        form {
            background: #fff;
            padding: 30px 20px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            width: 100%;
            max-width: 500px;
        }
        .btn-group { 
            display: flex; 
            flex-direction: column; 
            gap: 20px; 
        }
        .btn-radio { display: none; }
        .label-btn { 
            display: block;
            padding: 25px 20px; 
            font-size: 22px; 
            cursor: pointer; 
            border-radius: 10px; 
            border: 3px solid transparent;
            transition: all 0.2s ease-in-out;
            color: #333;
        }
        .label-btn.boy { background-color: #e6f2ff; }
        .label-btn.girl { background-color: #ffe6eb; }
        
        /* Feedback visual quando selecionado */
        .btn-radio:checked + .label-btn.boy { 
            background-color: #add8e6; 
            border-color: #0056b3; 
            font-weight: bold;
            transform: scale(1.02);
        }
        .btn-radio:checked + .label-btn.girl { 
            background-color: #ffb6c1; 
            border-color: #c2185b; 
            font-weight: bold;
            transform: scale(1.02);
        }

        button[type="submit"] { 
            margin-top: 40px; 
            padding: 18px 30px; 
            font-size: 18px; 
            font-weight: bold;
            cursor: pointer; 
            width: 100%;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 8px;
            transition: background-color 0.3s;
        }
        button[type="submit"]:hover {
            background-color: #555;
        }

        /* Ajustes para telas maiores (Desktop/Tablets) */
        @media (min-width: 600px) {
            body { padding: 50px; }
            h1 { font-size: 2.2rem; }
            form { padding: 40px; }
            .btn-group { flex-direction: row; }
            .label-btn { flex: 1; padding: 30px 20px; font-size: 24px; }
        }
    </style>
</head>
<body>
    <form method="POST" onsubmit="return confirm('Confirma o registro do sexo selecionado? Não será possível alterar depois.');">
        <h1>Cadastro - Visão Médica</h1>
        <div class="btn-group">
            <div>
                <input type="radio" id="gender_boy" name="gender" value="boy" class="btn-radio" required aria-label="Menino">
                <label for="gender_boy" class="label-btn boy">Menino</label>
            </div>
            <div>
                <input type="radio" id="gender_girl" name="gender" value="girl" class="btn-radio" required aria-label="Menina">
                <label for="gender_girl" class="label-btn girl">Menina</label>
            </div>
        </div>
        <button type="submit">Salvar Resultado</button>
    </form>
</body>
</html>