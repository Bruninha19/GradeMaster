<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grade Master - Criar Conta</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Estilos básicos para centralizar o formulário */
        body {
            font-family: sans-serif;
            background-color: #ffffff;
            display: flex;
            justify-content: flex-start;
            align-items: flex-start;
            min-height: 100vh;
        }
        #app {
            background-color: #ffffff;
            width: 100%;
            display: flex; /* Para usar flexbox para centralizar conteúdo verticalmente */
            flex-direction: column; /* Conteúdo em coluna */
            justify-content: flex-start; /* Alinha ao topo, ajuste para center se quiser tudo centralizado */
            padding: 20px 0; /* Adiciona um padding menor no topo e na base do #app */
            box-sizing: border-box; /* Garante que o padding não adicione largura extra */
        
        }
        .logo {
            position: fixed;
            z-index: 1000;
            display: flex;
            margin-top: -90px;
            gap: 10px;
            margin-left: 28px;
        }
        .logo img {
            height: 300px; /* Ajuste o tamanho do logo */
            

        }
        .form-title {
            color: #FCA13D; /* Cor laranja do seu layout */
            font-size: 2em;
            margin-top: 150px;
            margin-bottom: 30px;
            font-weight: bold;
            margin-left: 73px;
            
            
        }
    </style>
</head>
<body>
    <div id="app">
        <div class="logo">
            <img src="/images/logo_GradeMaster.png" alt="Grade Master Logo"> 
        </div>
        <h1 class="form-title">CRIAR CONTA</h1>

        <register-form-component></register-form-component>


    </div>
</body>
</html>