<?php
$page_title = "Sobre Nós - Inflatoy";
require_once 'includes/header.php';
?>

<section class="py-5">
    <div class="container">
        <div class="text-center mb-5 animate__animated animate__fadeInDown">
            <h1 class="display-4 fw-bold">Sobre o Projeto</h1>
            <p class="lead text-muted">Conheça mais sobre nossa aplicação</p>
        </div>

        <!-- Card do Trabalho -->
        <div class="card shadow-custom mb-5 animate__animated animate__fadeInUp border">
            <div class="card-body p-4">
                <h3 class="card-title" style="color: var(--color-text); border-bottom: 2px solid var(--color-primary); padding-bottom: var(--padding-sm); display: inline-block;">
                    <i class="bi bi-code-square" style="color: var(--color-primary);"></i> Atividade Somativa 2
                </h3>
                <p class="card-text mt-3">
                    Este site foi desenvolvido como parte da <strong>Atividade Somativa 2</strong> da disciplina de 
                    Desenvolvimento Web Full-Stack.
                </p>
                <p class="card-text">
                    O projeto demonstra a integração completa entre <strong>Front-End</strong> (HTML5, CSS3, JavaScript) 
                    e <strong>Back-End</strong> (PHP, MySQL), incluindo sistema de autenticação, CRUD completo e 
                    validação de formulários.
                </p>
            </div>
        </div>
        
        <hr class="divider">

        <!-- Sobre a Inflatoy -->
        <div class="card shadow-custom mb-5 animate__animated animate__fadeInUp border" style="animation-delay: 0.1s;">
            <div class="card-body p-4">
                <h3 class="card-title" style="color: var(--color-text); border-bottom: 2px solid var(--color-primary); padding-bottom: var(--padding-sm); display: inline-block;">
                    <i class="bi bi-balloon-heart" style="color: var(--color-primary);"></i> Sobre a Inflatoy
                </h3>
                <p class="card-text mt-3">
                    Nós somos dedicados a levar diversão segura e inesquecível para todas as festas infantis. 
                    Nosso compromisso é com a qualidade e a alegria dos seus filhos.
                </p>
                <a href="form.php" class="btn btn-primary mt-3">
                    <i class="bi bi-calendar-check"></i> Faça sua Reserva
                </a>
            </div>
        </div>
        
        <hr class="divider">

        <!-- Autores -->
        <h2 class="text-center mb-4 animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
            <i class="bi bi-people"></i> Autores
        </h2>
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="card shadow-custom h-100 animate__animated animate__fadeInUp border" style="animation-delay: 0.3s;">
                    <div class="card-body text-center p-4">
                        <i class="bi bi-person-circle" style="font-size: 4rem; color: var(--color-primary);"></i>
                        <h4 class="mt-3" style="color: var(--color-text);">Lucas Soares Cardoso</h4>
                        <p class="text-muted">Inteligência Artificial Aplicada</p>
                        <hr class="divider" style="margin: var(--padding-md) 0;">
                        <button class="btn btn-sm btn-outline-primary" onclick="toggleAuthorInfo(1)">
                            Ver Detalhes
                        </button>
                        <div class="mt-3" id="details1" style="display: none;">
                            <p class="small text-muted">
                                Desenvolvedor responsável pela explicação do código e gravação do vídeo
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-custom h-100 animate__animated animate__fadeInUp border" style="animation-delay: 0.4s;">
                    <div class="card-body text-center p-4">
                        <i class="bi bi-person-circle" style="font-size: 4rem; color: var(--color-primary);"></i>
                        <h4 class="mt-3" style="color: var(--color-text);">Samuel Gustavo de Lima</h4>
                        <p class="text-muted">Análise e Desenvolvimento de Sistemas</p>
                        <hr class="divider" style="margin: var(--padding-md) 0;">
                        <button class="btn btn-sm btn-outline-primary" onclick="toggleAuthorInfo(2)">
                            Ver Detalhes
                        </button>
                        <div class="mt-3" id="details2" style="display: none;">
                            <p class="small text-muted">
                                Desenvolvedor responsável pelos testes e validações do código e requisitos do projeto
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-custom h-100 animate__animated animate__fadeInUp border" style="animation-delay: 0.5s;">
                    <div class="card-body text-center p-4">
                        <i class="bi bi-person-circle" style="font-size: 4rem; color: var(--color-primary);"></i>
                        <h4 class="mt-3" style="color: var(--color-text);">Victor Hugo Guedes Pirozzi</h4>
                        <p class="text-muted">Análise e Desenvolvimento de Sistemas</p>
                        <hr class="divider" style="margin: var(--padding-md) 0;">
                        <button class="btn btn-sm btn-outline-primary" onclick="toggleAuthorInfo(3)">
                            Ver Detalhes
                        </button>
                        <div class="mt-3" id="details3" style="display: none;">
                            <p class="small text-muted">
                                Desenvolvedor responsável pela estruturação do código
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <hr class="divider">

        <!-- Tecnologias -->
        <div class="card shadow-custom animate__animated animate__fadeInUp border" style="animation-delay: 0.6s;">
            <div class="card-body p-4">
                <h3 class="card-title" style="color: var(--color-text); border-bottom: 2px solid var(--color-primary); padding-bottom: var(--padding-sm); display: inline-block;">
                    <i class="bi bi-tools" style="color: var(--color-primary);"></i> Tecnologias Utilizadas
                </h3>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-filetype-html text-primary me-3" style="font-size: 2rem;"></i>
                            <div>
                                <strong>HTML5</strong>
                                <p class="small text-muted mb-0">Estrutura semântica com elementos modernos</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-filetype-css text-info me-3" style="font-size: 2rem;"></i>
                            <div>
                                <strong>CSS3</strong>
                                <p class="small text-muted mb-0">Estilização com Flexbox, Grid e variáveis</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-filetype-js text-warning me-3" style="font-size: 2rem;"></i>
                            <div>
                                <strong>JavaScript</strong>
                                <p class="small text-muted mb-0">Interatividade e validação de formulários</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-filetype-php text-primary me-3" style="font-size: 2rem;"></i>
                            <div>
                                <strong>PHP</strong>
                                <p class="small text-muted mb-0">Processamento server-side e autenticação</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-database text-success me-3" style="font-size: 2rem;"></i>
                            <div>
                                <strong>MySQL</strong>
                                <p class="small text-muted mb-0">Banco de dados relacional com CRUD completo</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-bootstrap text-primary me-3" style="font-size: 2rem;"></i>
                            <div>
                                <strong>Bootstrap 5</strong>
                                <p class="small text-muted mb-0">Framework CSS responsivo e mobile-first</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
function toggleAuthorInfo(num) {
    const details = document.getElementById('details' + num);
    const button = event.target;
    
    if (details.style.display === 'none' || details.style.display === '') {
        details.style.display = 'block';
        button.textContent = 'Ocultar Detalhes';
    } else {
        details.style.display = 'none';
        button.textContent = 'Ver Detalhes';
    }
}
</script>

<?php require_once 'includes/footer.php'; ?>
