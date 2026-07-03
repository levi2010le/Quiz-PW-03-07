<?php
    session_start();
    
    if (!isset($_SESSION['acertos'])) {
        header('Location: index.php');
        exit();
    }
    
    $nome = $_SESSION['nome'];
    $acertos = $_SESSION['acertos'];
    $percentual = ($acertos / 10) * 100;
    
    // Salvar em cookie
    $dados = $_COOKIE['quiz_dados'] ?? '';
    $jogadores = $dados ? json_decode($dados, true) : [];
    
    $encontrou = false;
    foreach ($jogadores as &$j) {
        if ($j['nome'] == $nome) {
            if ($acertos > $j['acertos']) {
                $j['acertos'] = $acertos;
            }
            $encontrou = true;
            break;
        }
    }
    
    if (!$encontrou) {
        $jogadores[] = ['nome' => $nome, 'acertos' => $acertos];
    }
    
    setcookie('quiz_dados', json_encode($jogadores), time() + (365 * 24 * 60 * 60));
    
    unset($_SESSION['acertos']);
    unset($_SESSION['nome']);
    
    
    if ($percentual == 100) {
        $cor = 'success';
        $mensagem = 'Perfeito!';
    } elseif ($percentual >= 80) {
        $cor = 'success';
        $mensagem = 'Excelente!';
    } elseif ($percentual >= 60) {
        $cor = 'info';
        $mensagem = 'Bom trabalho!';
    } elseif ($percentual >= 40) {
        $cor = 'warning';
        $mensagem = 'Estude mais!';
    } else {
        $cor = 'danger';
        $mensagem = 'Tente novamente!';
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card shadow-lg" style="width: 400px;">
            <div class="card-body">
                <div class="alert alert-<?php echo $cor; ?> text-center mb-4">
                    <h4><?php echo $mensagem; ?></h4>
                </div>
                
                <h5 class="text-center mb-3">Nome: <strong><?php echo $nome; ?></strong></h5>
                
                <div class="text-center mb-4">
                    <h2 class="text-<?php echo $cor; ?>"><?php echo $acertos; ?>/10</h2>
                    <p class="text-muted"><?php echo round($percentual, 1); ?>%</p>
                </div>
                
                <div class="d-grid gap-2">
                    <a href="index.php" class="btn btn-primary">Novo Jogador</a>
                    <a href="ranking.php" class="btn btn-secondary">Ver Ranking</a>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>