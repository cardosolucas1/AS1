<?php
$page_title = "Gerenciar Brinquedos - Inflatoy";
require_once '../bd/verifica_sessao.php';
require_once '../bd/conectaBD.php';

$mensagem = '';
$tipo_mensagem = '';

// Processar ações
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['acao'])) {
        $acao = $_POST['acao'];
        
        if ($acao === 'adicionar' || $acao === 'editar') {
            $nome = trim($_POST['nome'] ?? '');
            $descricao = trim($_POST['descricao'] ?? '');
            $preco_dia = floatval($_POST['preco_dia'] ?? 0);
            $id_categoria = intval($_POST['id_categoria'] ?? 0);
            $ativo = isset($_POST['ativo']) ? 1 : 0;
            
            $conn = new mysqli($servername, $username, $password, $database);
            $conn->set_charset("utf8mb4");
            
            if ($acao === 'adicionar') {
                $sql = "INSERT INTO brinquedos (nome, descricao, preco_dia, id_categoria, ativo) VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssdii", $nome, $descricao, $preco_dia, $id_categoria, $ativo);
            } else {
                $id = intval($_POST['id']);
                $sql = "UPDATE brinquedos SET nome=?, descricao=?, preco_dia=?, id_categoria=?, ativo=? WHERE id_brinquedo=?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssdiii", $nome, $descricao, $preco_dia, $id_categoria, $ativo, $id);
            }
            
            if ($stmt->execute()) {
                $mensagem = $acao === 'adicionar' ? 'Brinquedo adicionado com sucesso!' : 'Brinquedo atualizado com sucesso!';
                $tipo_mensagem = 'success';
            } else {
                $mensagem = 'Erro ao salvar brinquedo.';
                $tipo_mensagem = 'danger';
            }
            $stmt->close();
            $conn->close();
        }
    }
}

// Processar exclusão
if (isset($_GET['excluir'])) {
    $id = intval($_GET['excluir']);
    $conn = new mysqli($servername, $username, $password, $database);
    $sql = "DELETE FROM brinquedos WHERE id_brinquedo=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        $mensagem = 'Brinquedo excluído com sucesso!';
        $tipo_mensagem = 'success';
    } else {
        $mensagem = 'Erro ao excluir brinquedo.';
        $tipo_mensagem = 'danger';
    }
    $stmt->close();
    $conn->close();
}

// Buscar brinquedo para edição
$brinquedo_editar = null;
if (isset($_GET['editar'])) {
    $id = intval($_GET['editar']);
    $conn = new mysqli($servername, $username, $password, $database);
    $conn->set_charset("utf8mb4");
    $sql = "SELECT * FROM brinquedos WHERE id_brinquedo=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $brinquedo_editar = $result->fetch_assoc();
    }
    $stmt->close();
    $conn->close();
}

// Listar brinquedos
$conn = new mysqli($servername, $username, $password, $database);
$conn->set_charset("utf8mb4");
$sql = "SELECT b.*, c.nome as categoria_nome 
        FROM brinquedos b 
        LEFT JOIN categorias c ON b.id_categoria = c.id_categoria 
        ORDER BY b.nome";
$result = $conn->query($sql);

// Buscar categorias para o select
$sql_categorias = "SELECT * FROM categorias ORDER BY nome";
$categorias_result = $conn->query($sql_categorias);
$categorias = [];
while($row = $categorias_result->fetch_assoc()) {
    $categorias[] = $row;
}
$conn->close();

require_once '../includes/header.php';
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-cube"></i> Gerenciar Brinquedos</h2>
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

    <!-- Formulário -->
    <div class="card shadow-custom mb-4">
        <div class="card-header" style="background: var(--color-bg); border-bottom: 2px solid var(--color-primary);">
            <h5 class="mb-0" style="color: var(--color-text);">
                <i class="bi bi-<?php echo $brinquedo_editar ? 'pencil' : 'plus-circle'; ?>" style="color: var(--color-primary);"></i>
                <?php echo $brinquedo_editar ? 'Editar' : 'Adicionar'; ?> Brinquedo
            </h5>
        </div>
        <div class="card-body">
            <form method="POST" action="">
                <?php if ($brinquedo_editar): ?>
                    <input type="hidden" name="id" value="<?php echo $brinquedo_editar['id_brinquedo']; ?>">
                    <input type="hidden" name="acao" value="editar">
                <?php else: ?>
                    <input type="hidden" name="acao" value="adicionar">
                <?php endif; ?>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nome do Brinquedo *</label>
                        <input type="text" class="form-control" name="nome" 
                               value="<?php echo htmlspecialchars($brinquedo_editar['nome'] ?? ''); ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Categoria *</label>
                        <select class="form-select" name="id_categoria" required>
                            <option value="">Selecione...</option>
                            <?php foreach ($categorias as $cat): ?>
                                <option value="<?php echo $cat['id_categoria']; ?>" 
                                        <?php echo ($brinquedo_editar && $brinquedo_editar['id_categoria'] == $cat['id_categoria']) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($cat['nome']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Descrição</label>
                    <textarea class="form-control" name="descricao" rows="3"><?php echo htmlspecialchars($brinquedo_editar['descricao'] ?? ''); ?></textarea>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Preço por Dia (R$) *</label>
                        <input type="number" class="form-control" name="preco_dia" step="0.01" min="0"
                               value="<?php echo $brinquedo_editar['preco_dia'] ?? ''; ?>" required>
                    </div>
                    <div class="col-md-6 mb-3 d-flex align-items-end">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="ativo" id="ativo" 
                                   <?php echo (!$brinquedo_editar || $brinquedo_editar['ativo']) ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="ativo">Ativo</label>
                        </div>
                    </div>
                </div>
                
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <?php if ($brinquedo_editar): ?>
                        <a href="brinquedos.php" class="btn btn-secondary">Cancelar</a>
                    <?php endif; ?>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle"></i> Salvar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <hr class="divider">
    
    <!-- Lista de Brinquedos -->
    <div class="card shadow-custom">
        <div class="card-header" style="background: var(--color-bg-gray); border-bottom: 1px solid var(--color-border);">
            <h5 class="mb-0" style="color: var(--color-text);"><i class="bi bi-list-ul" style="color: var(--color-primary);"></i> Lista de Brinquedos</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Categoria</th>
                            <th>Preço/Dia</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result && $result->num_rows > 0): ?>
                            <?php while($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo $row['id_brinquedo']; ?></td>
                                    <td><strong><?php echo htmlspecialchars($row['nome']); ?></strong></td>
                                    <td><?php echo htmlspecialchars($row['categoria_nome'] ?? 'N/A'); ?></td>
                                    <td>R$ <?php echo number_format($row['preco_dia'], 2, ',', '.'); ?></td>
                                    <td>
                                        <?php if ($row['ativo']): ?>
                                            <span class="badge bg-success">Ativo</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary">Inativo</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="?editar=<?php echo $row['id_brinquedo']; ?>" 
                                           class="btn btn-sm btn-warning" title="Editar">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="?excluir=<?php echo $row['id_brinquedo']; ?>" 
                                           class="btn btn-sm btn-danger" 
                                           onclick="return confirm('Tem certeza que deseja excluir este brinquedo?');" 
                                           title="Excluir">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center text-muted">Nenhum brinquedo cadastrado.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>

