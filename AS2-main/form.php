<?php
$page_title = "Reservar Brinquedo - Inflatoy";
require_once 'bd/conectaBD.php';

// Conecta ao banco e busca brinquedos ativos
$conn = new mysqli($servername, $username, $password, $database);
$conn->set_charset("utf8mb4");

$sql = "SELECT id_brinquedo, nome FROM brinquedos WHERE ativo = 1 ORDER BY nome";
$result = $conn->query($sql);
$brinquedos = [];
if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $brinquedos[] = $row;
    }
}
$conn->close();

// Verifica se veio um brinquedo via GET
$toySelecionado = isset($_GET['toy']) ? intval($_GET['toy']) : 0;

require_once 'includes/header.php';
?>

<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-custom-lg border animate__animated animate__fadeInUp">
                    <div class="card-header" style="background: var(--color-bg); border-bottom: 2px solid var(--color-primary);">
                        <h3 class="mb-0" style="color: var(--color-text);">
                            <i class="bi bi-calendar-check" style="color: var(--color-primary);"></i> Solicitar Reserva
                        </h3>
                    </div>
                    <div class="card-body p-4">
                        <p class="text-muted mb-4">
                            Preencha os dados abaixo para solicitar o aluguel do seu brinquedo. 
                            <strong>Todos os campos são obrigatórios.</strong>
                        </p>
                        
                        <hr class="divider">

                        <form id="reservationForm" action="form_action.php" method="POST">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="name" class="form-label">
                                        <i class="bi bi-person"></i> Seu Nome *
                                    </label>
                                    <input type="text" class="form-control" name="name" id="name" 
                                           placeholder="Seu Nome Completo" required>
                                    <span class="text-danger small" id="errorName"></span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">
                                        <i class="bi bi-phone"></i> Celular *
                                    </label>
                                    <input type="tel" class="form-control" name="phone" id="phone" 
                                           pattern="\(\d{2}\)\s\d{4,5}-\d{4}$"
                                           placeholder="(xx) xxxxx-xxxx" title="(xx) xxxxx-xxxx" required>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">
                                        <i class="bi bi-envelope"></i> E-mail *
                                    </label>
                                    <input type="email" class="form-control" name="email" id="email" 
                                           placeholder="seu@email.com" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="date" class="form-label">
                                        <i class="bi bi-calendar"></i> Data da Festa *
                                    </label>
                                    <input type="date" class="form-control" name="date" id="date" required>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="toy" class="form-label">
                                        <i class="bi bi-cube"></i> Brinquedo Desejado *
                                    </label>
                                    <select class="form-select" id="toy" name="toy" required>
                                        <option value="">Selecione um Brinquedo</option>
                                        <?php foreach ($brinquedos as $brinquedo): ?>
                                            <option value="<?php echo $brinquedo['id_brinquedo']; ?>" 
                                                    <?php echo ($toySelecionado == $brinquedo['id_brinquedo']) ? 'selected' : ''; ?>>
                                                <?php echo htmlspecialchars($brinquedo['nome']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <span class="text-danger small" id="errorToy"></span>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label class="form-label">
                                    <i class="bi bi-clock"></i> Período de Aluguel *
                                </label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-check p-3 border rounded">
                                            <input class="form-check-input" type="radio" name="period" 
                                                   id="periodDiario" value="diario" required>
                                            <label class="form-check-label" for="periodDiario">
                                                <strong>Diário</strong><br>
                                                <small class="text-muted">08h - 18h</small>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check p-3 border rounded">
                                            <input class="form-check-input" type="radio" name="period" 
                                                   id="periodCompleto" value="completo" required>
                                            <label class="form-check-label" for="periodCompleto">
                                                <strong>Festa Completa</strong><br>
                                                <small class="text-muted">24 horas</small>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <span class="text-danger small" id="errorPeriod"></span>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg" id="submitBtn">
                                    <i class="bi bi-check-circle"></i> Solicitar Cotação
                                </button>
                            </div>
                        </form>
                        
                        <script>
                        // Feedback visual ao enviar
                        (function() {
                            const form = document.getElementById('reservationForm');
                            const btn = document.getElementById('submitBtn');
                            
                            if (form && btn) {
                                form.addEventListener('submit', function(e) {
                                    // Só desabilita o botão se o formulário for válido
                                    // A validação JavaScript pode prevenir o envio se houver erros
                                    setTimeout(function() {
                                        if (!form.checkValidity()) {
                                            return; // Se não for válido, não desabilita
                                        }
                                        btn.disabled = true;
                                        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Enviando...';
                                    }, 100);
                                });
                            }
                        })();
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
