<?php
    session_start();
    
    if (!isset($_SESSION['nome'])) {
        header('Location: index.php');
        exit();
    }
    
    $perguntas = [
        ['pergunta' => 'Qual é a cor do céu?', 'alternativas' => ['Azul', 'Verde', 'Vermelho', 'Amarelo'], 'correta' => 0],
        ['pergunta' => 'Quanto é 2 + 2?', 'alternativas' => ['3', '4', '5', '6'], 'correta' => 1],
        ['pergunta' => 'Qual animal late?', 'alternativas' => ['Gato', 'Cachorro', 'Pássaro', 'Peixe'], 'correta' => 1],
        ['pergunta' => 'Qual fruta é amarela?', 'alternativas' => ['Maçã', 'Banana', 'Morango', 'Uva'], 'correta' => 1],
        ['pergunta' => 'Quantos dedos tem na mão?', 'alternativas' => ['3', '4', '5', '6'], 'correta' => 2],
        ['pergunta' => 'Qual é a cor da grama?', 'alternativas' => ['Amarela', 'Vermelha', 'Verde', 'Azul'], 'correta' => 2],
        ['pergunta' => 'Qual estação é quente?', 'alternativas' => ['Inverno', 'Primavera', 'Verão', 'Outono'], 'correta' => 2],
        ['pergunta' => 'Quanto é 5 + 3?', 'alternativas' => ['7', '8', '9', '10'], 'correta' => 1],
        ['pergunta' => 'Qual animal mia?', 'alternativas' => ['Cachorro', 'Vaca', 'Gato', 'Cavalo'], 'correta' => 2],
        ['pergunta' => 'Qual é a capital do Brasil?', 'alternativas' => ['São Paulo', 'Rio de Janeiro', 'Brasília', 'Salvador'], 'correta' => 2]
    ];
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $acertos = 0;
        
        for ($i = 0; $i < count($perguntas); $i++) {
            if (isset($_POST["q$i"]) && $_POST["q$i"] == $perguntas[$i]['correta']) {
                $acertos++;
            }
        }
        
        $_SESSION['acertos'] = $acertos;
        header('Location: resultado.php');
        exit();
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="card shadow-lg">
            <div class="card-body">
                <h1 class="card-title text-center mb-2">Quiz</h1>
                <p class="text-center text-muted mb-4">Jogador: <strong><?php echo $_SESSION['nome']; ?></strong></p>
                
                <form method="POST">
                    <?php foreach ($perguntas as $i => $p): ?>
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo ($i + 1) . ". " . $p['pergunta']; ?></h5>
                                
                                <?php foreach ($p['alternativas'] as $j => $alt): ?>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="q<?php echo $i; ?>" value="<?php echo $j; ?>" id="q<?php echo $i; ?>_<?php echo $j; ?>" required>
                                        <label class="form-check-label" for="q<?php echo $i; ?>_<?php echo $j; ?>">
                                            <?php echo $alt; ?>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    
                    <button type="submit" class="btn btn-success w-100">Finalizar</button>
                </form>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>