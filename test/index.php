<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <h1>Página de acesso aos testes</h1>
    <br><br>
    <p>Para que os testes sejam executados com sucesso, é preciso testar na seguinte ordem:</p>

    <ul>
        <li><a href="testTreinador.php">Testar métodos de treinador</a></li>
        <li><a href="testAtleta.php">Testar métodos de Atleta</a></li>
        <li><a href="testTime.php">Testar métodos de Time</a></li>
    </ul>
   
    <p><strong>OBS1:</strong> Precisei criar o método de pesquisar atletas por Time para utiliza-lo no DAO de Time, no momento em que preciso montar um objeto Time nas pesquisas por nome, id e na hora de listar Tudo. <br> Isso porque o Objeto Time tem um array de atletas em seu construtor</p>
    <br>
    <p><strong>OBS2:</strong> Como no diagrama exige que os retornos dos métodos de pesquisa por nome sejam um array, eu implementei a pesquisa aproximada em todos os métodos de pesquisa por nome</p>
</body>
</html>