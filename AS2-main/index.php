<?php
$page_title = "Inflatoy - Aluguel de Infláveis";
require_once 'bd/conectaBD.php';
require_once 'includes/header.php';

// Conecta ao banco e busca brinquedos ativos
$conn = new mysqli($servername, $username, $password, $database);
$conn->set_charset("utf8mb4");

$sql = "SELECT b.id_brinquedo, b.nome, b.descricao, b.preco_dia, 
               c.nome as categoria_nome
        FROM brinquedos b
        INNER JOIN categorias c ON b.id_categoria = c.id_categoria
        WHERE b.ativo = 1
        ORDER BY b.nome";

$result = $conn->query($sql);
$brinquedos = [];
if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $brinquedos[] = $row;
    }
}
$conn->close();

// Mapeamento de nomes para imagens
$imagemMap = [
    'Castelo Mágico' => 'castelo.jpg',
    'Super Escorregador Radical' => 'escorregador.jpg',
    'Piscina de Bolinhas' => 'piscina.jpg',
    'Combo Atividades' => 'combo.jpg',
    'Combo Atividades 2' => 'combo2.jpg'
];
?>

<!-- Hero Section -->
<section class="hero-section py-5 mb-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 animate__animated animate__fadeInLeft">
                <h1 class="display-4 fw-bold mb-4">
                    <i class="bi bi-balloon-heart-fill" style="color: var(--color-primary);"></i> Divirta-se com Inflatoy!
                </h1>
                <p class="lead mb-4">
                    Alugue os melhores brinquedos infláveis para tornar sua festa inesquecível!
                </p>
                <a href="form.php" class="btn btn-primary btn-lg">
                    <i class="bi bi-calendar-check"></i> Reservar Agora
                </a>
            </div>
            <div class="col-lg-4 text-center animate__animated animate__fadeInRight">
                <i class="bi bi-balloon-heart" style="font-size: 150px; color: var(--color-primary-light); opacity: 0.5;"></i>
            </div>
        </div>
        <hr class="divider mt-5">
    </div>
</section>

<!-- Catálogo de Brinquedos -->
<section class="catalog-section py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold mb-3" style="color: var(--color-text);">
                <i class="bi bi-grid-3x3-gap" style="color: var(--color-primary);"></i> Nosso Catálogo
            </h2>
            <p class="text-muted">Escolha o brinquedo perfeito para sua festa</p>
        </div>
        
        <hr class="divider mb-5">

        <?php if (empty($brinquedos)): ?>
            <div class="alert alert-info text-center">
                <i class="bi bi-info-circle"></i> Nenhum brinquedo disponível no momento.
            </div>
        <?php else: ?>
            <div class="row g-4">
                <?php foreach ($brinquedos as $index => $brinquedo): 
                    // Determina a imagem
                    $imagem = 'img/default.jpg';
                    foreach ($imagemMap as $nome => $img) {
                        if (strpos($brinquedo['nome'], $nome) !== false || $brinquedo['nome'] == $nome) {
                            $imagem = 'img/' . $img;
                            break;
                        }
                    }
                    if ($imagem == 'img/default.jpg') {
                        $imagensPorId = [1 => 'castelo.jpg', 2 => 'escorregador.jpg', 3 => 'piscina.jpg', 4 => 'combo.jpg', 5 => 'combo2.jpg'];
                        if (isset($imagensPorId[$brinquedo['id_brinquedo']])) {
                            $imagem = 'img/' . $imagensPorId[$brinquedo['id_brinquedo']];
                        }
                    }
                ?>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card h-100 shadow-custom border-0 animate__animated animate__fadeInUp rounded-custom" 
                             style="animation-delay: <?php echo $index * 0.1; ?>s;">
                            <div class="card-img-wrapper" style="height: 280px; overflow: hidden;">
                                <img src="<?php echo htmlspecialchars($imagem); ?>" 
                                     alt="<?php echo htmlspecialchars($brinquedo['nome']); ?>" 
                                     class="card-img-top h-100 w-100 object-fit-cover"
                                     onerror="this.src='img/castelo.jpg'">
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold">
                                    <?php echo htmlspecialchars($brinquedo['nome']); ?>
                                </h5>
                                <p class="text-muted small mb-2">
                                    <i class="bi bi-tag"></i> <?php echo htmlspecialchars($brinquedo['categoria_nome']); ?>
                                </p>
                                <?php if (!empty($brinquedo['descricao'])): ?>
                                    <p class="card-text small text-muted flex-grow-1">
                                        <?php echo htmlspecialchars(substr($brinquedo['descricao'], 0, 80)) . '...'; ?>
                                    </p>
                                <?php endif; ?>
                                <div class="d-flex justify-content-between align-items-center mt-auto">
                                    <div>
                                        <span class="price-display h5 fw-bold mb-0">
                                            R$ <?php echo number_format($brinquedo['preco_dia'], 2, ',', '.'); ?>
                                        </span>
                                        <small class="text-muted d-block">por dia</small>
                                    </div>
                                    <a href="form.php?toy=<?php echo $brinquedo['id_brinquedo']; ?>" 
                                       class="btn btn-primary rounded-custom">
                                        <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>


<?php require_once 'includes/footer.php'; ?>
