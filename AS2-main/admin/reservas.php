<?php
$page_title = "Gerenciar Reservas - Inflatoy";
require_once '../bd/verifica_sessao.php';
require_once '../bd/conectaBD.php';

$mensagem = '';
$tipo_mensagem = '';

// Processar atualização de status
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['atualizar_status'])) {
    $id = intval($_POST['id']);
    $status = $_POST['status'];
    
    $conn = new mysqli($servername, $username, $password, $database);
    $conn->set_charset("utf8mb4");
    
    $sql = "UPDATE reservas SET status=? WHERE id_reserva=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $id);
    
    if ($stmt->execute()) {
        $mensagem = 'Status da reserva atualizado com sucesso!';
        $tipo_mensagem = 'success';
    } else {
        $mensagem = 'Erro ao atualizar status.';
        $tipo_mensagem = 'danger';
    }
    $stmt->close();
    $conn->close();
}

// Processar exclusão
if (isset($_GET['excluir'])) {
    $id = intval($_GET['excluir']);
    $conn = new mysqli($servername, $username, $password, $database);
    $sql = "DELETE FROM reservas WHERE id_reserva=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        $mensagem = 'Reserva excluída com sucesso!';
        $tipo_mensagem = 'success';
    } else {
        $mensagem = 'Erro ao excluir reserva.';
        $tipo_mensagem = 'danger';
    }
    $stmt->close();
    $conn->close();
}

// Buscar reserva para visualização
$reserva_detalhes = null;
if (isset($_GET['detalhes'])) {
    $id = intval($_GET['detalhes']);
    $conn = new mysqli($servername, $username, $password, $database);
    $conn->set_charset("utf8mb4");
    $sql = "SELECT * FROM reservas WHERE id_reserva=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $reserva_detalhes = $result->fetch_assoc();
    }
    $stmt->close();
    $conn->close();
}

// Listar reservas
$conn = new mysqli($servername, $username, $password, $database);
$conn->set_charset("utf8mb4");
$sql = "SELECT * FROM reservas ORDER BY data_reserva DESC";
$result = $conn->query($sql);
$conn->close();

require_once '../includes/header.php';

// Mapeamento de status
$status_map = [
    'solicitado' => ['label' => 'Solicitado', 'class' => 'warning'],
    'confirmado' => ['label' => 'Confirmado', 'class' => 'success'],
    'cancelado' => ['label' => 'Cancelado', 'class' => 'danger']
];

$periodo_map = [
    'diario' => 'Diário (08h - 18h)',
    'completo' => 'Festa Completa (24h)'
];
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-calendar-check"></i> Gerenciar Reservas</h2>
        <a href="../painel.php" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Voltar ao Painel
        </a>
    </div>

    <?php if ($mensagem): ?>
        <div class="alert alert-<?php echo $tipo_mensagem; ?> alert-dismissible fade show animate__animated animate__fadeInDown">
            <?php echo $mensagem; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Modal de Detalhes -->
    <?php if ($reserva_detalhes): ?>
        <div class="modal fade show" id="modalDetalhes" tabindex="-1" style="display: block;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header" style="background: var(--color-bg); border-bottom: 2px solid var(--color-primary);">
                        <h5 class="modal-title" style="color: var(--color-text);"><i class="bi bi-info-circle" style="color: var(--color-primary);"></i> Detalhes da Reserva</h5>
                        <a href="reservas.php" class="btn-close"></a>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <strong>Nome:</strong><br>
                                <span class="text-capitalize-words"><?php echo htmlspecialchars(ucwords(strtolower($reserva_detalhes['nome_cliente']))); ?></span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong>Telefone:</strong><br>
                                <?php echo htmlspecialchars($reserva_detalhes['telefone'] ?? '-'); ?>
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong>E-mail:</strong><br>
                                <?php echo htmlspecialchars($reserva_detalhes['email'] ?? '-'); ?>
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong>Data da Festa:</strong><br>
                                <?php echo date('d/m/Y', strtotime($reserva_detalhes['data_festa'])); ?>
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong>Período:</strong><br>
                                <?php echo $periodo_map[$reserva_detalhes['periodo']] ?? $reserva_detalhes['periodo']; ?>
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong>Status:</strong><br>
                                <span class="badge bg-<?php echo $status_map[$reserva_detalhes['status']]['class']; ?>">
                                    <?php echo $status_map[$reserva_detalhes['status']]['label']; ?>
                                </span>
                            </div>
                            <div class="col-md-12 mb-3">
                                <strong>Data da Reserva:</strong><br>
                                <?php echo date('d/m/Y H:i', strtotime($reserva_detalhes['data_reserva'])); ?>
                            </div>
                        </div>
                        
                        <hr>
                        
                        <form method="POST" action="">
                            <input type="hidden" name="id" value="<?php echo $reserva_detalhes['id_reserva']; ?>">
                            <div class="row">
                                <div class="col-md-8">
                                    <label class="form-label"><strong>Atualizar Status:</strong></label>
                                    <select class="form-select" name="status" required>
                                        <?php foreach ($status_map as $key => $status): ?>
                                            <option value="<?php echo $key; ?>" 
                                                    <?php echo $reserva_detalhes['status'] == $key ? 'selected' : ''; ?>>
                                                <?php echo $status['label']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-4 d-flex align-items-end">
                                    <button type="submit" name="atualizar_status" class="btn btn-primary w-100">
                                        <i class="bi bi-check-circle"></i> Atualizar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <a href="reservas.php" class="btn btn-secondary">Fechar</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-backdrop fade show"></div>
    <?php endif; ?>

    <!-- Lista de Reservas -->
    <div class="card shadow-custom">
        <div class="card-header" style="background: var(--color-bg-gray); border-bottom: 1px solid var(--color-border);">
            <h5 class="mb-0" style="color: var(--color-text);"><i class="bi bi-list-ul" style="color: var(--color-primary);"></i> Lista de Reservas</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Cliente</th>
                            <th>Telefone</th>
                            <th>E-mail</th>
                            <th>Data Festa</th>
                            <th>Período</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result && $result->num_rows > 0): ?>
                            <?php while($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo $row['id_reserva']; ?></td>
                                    <td><strong class="text-capitalize-words"><?php echo htmlspecialchars(ucwords(strtolower($row['nome_cliente']))); ?></strong></td>
                                    <td><?php echo htmlspecialchars($row['telefone'] ?? '-'); ?></td>
                                    <td><?php echo htmlspecialchars($row['email'] ?? '-'); ?></td>
                                    <td><?php echo date('d/m/Y', strtotime($row['data_festa'])); ?></td>
                                    <td><?php echo $periodo_map[$row['periodo']] ?? $row['periodo']; ?></td>
                                    <td>
                                        <span class="badge bg-<?php echo $status_map[$row['status']]['class']; ?>">
                                            <?php echo $status_map[$row['status']]['label']; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <a href="?detalhes=<?php echo $row['id_reserva']; ?>" 
                                           class="btn btn-sm btn-info" title="Ver Detalhes">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="?excluir=<?php echo $row['id_reserva']; ?>" 
                                           class="btn btn-sm btn-danger" 
                                           onclick="return confirm('Tem certeza que deseja excluir esta reserva?');" 
                                           title="Excluir">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center text-muted">Nenhuma reserva encontrada.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>

