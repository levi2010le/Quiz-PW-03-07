<?php
    $dados = $_COOKIE['quiz_dados'] ?? '';
    $jogadores = $dados ? json_decode($dados, true) : [];
    
    // Ordenar
    usort($jogadores, function($a, $b) {
        return $b['acertos'] - $a['acertos'];
    });
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ranking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="card shadow-lg">
            <div class="card-body">
                <h1 class="card-title text-center mb-4">🏆 Ranking</h1>
                
                <?php if (empty($jogadores)): ?>
                    <div class="alert alert-info text-center">
                        Nenhum resultado ainda
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>Posição</th>
                                    <th>Nome</th>
                                    <th>Acertos</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($jogadores as $i => $j): ?>
                                    <tr class="<?php echo $i === 0 ? 'table-success' : ($i === 1 ? 'table-info' : ($i === 2 ? 'table-warning' : '')); ?>">
                                        <td>
                                            <strong>
                                                <?php 
                                                    if ($i === 0) echo '🥇 1º';
                                                    elseif ($i === 1) echo '🥈 2º';
                                                    elseif ($i === 2) echo '🥉 3º';
                                                    else echo ($i + 1) . 'º';
                                                ?>
                                            </strong>
                                        </td>
                                        <td><?php echo $j['nome']; ?></td>
                                        <td><strong><?php echo $j['acertos']; ?>/10</strong></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
                
                <div class="d-grid gap-2 mt-4">
                    <a href="index.php" class="btn btn-primary">Voltar</a>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>