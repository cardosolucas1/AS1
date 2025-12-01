<?php
$page_title = "Reserva - Inflatoy";
require_once 'bd/conectaBD.php';

$mensagem = '';
$erro = '';
$dadosReserva = [];

// Processa o formulário se foi enviado via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Recebe e sanitiza os dados
    $nome_cliente = trim($_POST['name'] ?? '');
    $telefone = trim($_POST['phone'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $data_festa = $_POST['date'] ?? '';
    $id_brinquedo = intval($_POST['toy'] ?? 0);
    $periodo = $_POST['period'] ?? '';

    // Validação básica
    if (empty($nome_cliente) || empty($telefone) || empty($email) || empty($data_festa) || $id_brinquedo == 0 || empty($periodo)) {
        $erro = "Por favor, preencha todos os campos obrigatórios.";
    } else {
        // Validação de email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $erro = "E-mail inválido.";
        } else {
            // Validação de data
            $data_selecionada = new DateTime($data_festa);
            $hoje = new DateTime();
            $hoje->setTime(0, 0, 0);
            
            if ($data_selecionada < $hoje) {
                $erro = "A data da festa deve ser igual ou posterior a hoje.";
            } else {
                // Tenta inserir no banco
                try {
                    $conn = new mysqli($servername, $username, $password, $database);
                    $conn->set_charset("utf8mb4");

                    // Verifica se o brinquedo existe e está ativo
                    $sql_check = "SELECT id_brinquedo FROM brinquedos WHERE id_brinquedo = ? AND ativo = 1";
                    $stmt_check = $conn->prepare($sql_check);
                    $stmt_check->bind_param("i", $id_brinquedo);
                    $stmt_check->execute();
                    $result_check = $stmt_check->get_result();
                    
                    if ($result_check->num_rows == 0) {
                        $erro = "Brinquedo selecionado não está disponível.";
                        $stmt_check->close();
                        $conn->close();
                    } else {
                        // Insere a reserva
                        $sql = "INSERT INTO reservas (nome_cliente, telefone, email, data_festa, periodo, status) 
                                VALUES (?, ?, ?, ?, ?, 'solicitado')";
                        
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("sssss", $nome_cliente, $telefone, $email, $data_festa, $periodo);
                        
                        if ($stmt->execute()) {
                            $mensagem = "Reserva realizada com sucesso! Em breve entraremos em contato.";
                            $dadosReserva = [
                                'nome' => $nome_cliente,
                                'telefone' => $telefone,
                                'email' => $email,
                                'data' => $data_festa,
                                'periodo' => $periodo
                            ];
                            
                            // Busca o nome do brinquedo
                            $sql_brinquedo = "SELECT nome FROM brinquedos WHERE id_brinquedo = ?";
                            $stmt_brinquedo = $conn->prepare($sql_brinquedo);
                            $stmt_brinquedo->bind_param("i", $id_brinquedo);
                            $stmt_brinquedo->execute();
                            $result_brinquedo = $stmt_brinquedo->get_result();
                            if ($row = $result_brinquedo->fetch_assoc()) {
                                $dadosReserva['brinquedo'] = $row['nome'];
                            }
                            $stmt_brinquedo->close();
                        } else {
                            $erro = "Erro ao processar a reserva. Tente novamente.";
                        }
                        
                        $stmt->close();
                        $conn->close();
                    }
                } catch (Exception $e) {
                    $erro = "Erro no banco de dados: " . $e->getMessage();
                }
            }
        }
    }
} else {
    // Se não foi POST, redireciona para o formulário
    header("Location: form.php");
    exit();
}

// Mapeamento para exibição
$periodoMap = [
    'diario' => 'Diário (08h - 18h)',
    'completo' => 'Festa Completa (24h)'
];

require_once 'includes/header.php';
?>

<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <?php if ($mensagem): ?>
                    <div class="card shadow-custom-lg border animate__animated animate__fadeInUp">
                        <div class="card-header" style="background: var(--color-bg); border-bottom: 2px solid var(--color-primary);">
                            <h3 class="mb-0" style="color: var(--color-text);">
                                <i class="bi bi-check-circle" style="color: var(--color-primary);"></i> Solicitação Recebida!
                            </h3>
                        </div>
                        <div class="card-body p-4">
                            <div class="alert alert-success">
                                <i class="bi bi-info-circle"></i> <?php echo $mensagem; ?>
                            </div>
                            
                            <h5 class="mb-3"><i class="bi bi-list-check"></i> Detalhes da Reserva:</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th width="30%">Nome:</th>
                                            <td><span class="text-capitalize-words"><?php echo htmlspecialchars(ucwords(strtolower($dadosReserva['nome']))); ?></span></td>
                                        </tr>
                                        <tr>
                                            <th>Telefone:</th>
                                            <td><?php echo htmlspecialchars($dadosReserva['telefone']); ?></td>
                                        </tr>
                                        <tr>
                                            <th>E-mail:</th>
                                            <td><?php echo htmlspecialchars($dadosReserva['email']); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Data da Festa:</th>
                                            <td><?php echo date('d/m/Y', strtotime($dadosReserva['data'])); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Brinquedo:</th>
                                            <td><?php echo htmlspecialchars($dadosReserva['brinquedo'] ?? 'N/A'); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Período:</th>
                                            <td><?php echo $periodoMap[$dadosReserva['periodo']] ?? $dadosReserva['periodo']; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="d-grid gap-2 d-md-flex justify-content-md-center mt-4">
                                <a href="index.php" class="btn btn-primary btn-lg">
                                    <i class="bi bi-house"></i> Voltar para a Home
                                </a>
                                <a href="form.php" class="btn btn-outline-primary btn-lg">
                                    <i class="bi bi-plus-circle"></i> Nova Reserva
                                </a>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="card shadow-custom-lg border animate__animated animate__fadeInUp">
                        <div class="card-header" style="background: var(--color-bg); border-bottom: 2px solid var(--color-danger);">
                            <h3 class="mb-0" style="color: var(--color-text);">
                                <i class="bi bi-exclamation-triangle" style="color: var(--color-danger);"></i> Erro ao Processar Reserva
                            </h3>
                        </div>
                        <div class="card-body p-4">
                            <div class="alert alert-danger">
                                <i class="bi bi-x-circle"></i> <?php echo htmlspecialchars($erro); ?>
                            </div>
                            
                            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                <a href="form.php" class="btn btn-danger btn-lg">
                                    <i class="bi bi-arrow-left"></i> Tentar Novamente
                                </a>
                                <a href="index.php" class="btn btn-outline-secondary btn-lg">
                                    <i class="bi bi-house"></i> Voltar para a Home
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
