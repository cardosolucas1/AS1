<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$usuario_logado = isset($_SESSION['id_usuario']);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title : 'Inflatoy - Aluguel de Infláveis'; ?></title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <!-- Custom CSS -->
    <?php
    // Detecta se estamos em uma subpasta (admin ou login)
    $isAdmin = strpos($_SERVER['PHP_SELF'], '/admin/') !== false;
    $isLogin = strpos($_SERVER['PHP_SELF'], '/login/') !== false;
    $cssPath = ($isAdmin || $isLogin) ? '../css/style.css' : 'css/style.css';
    ?>
    <link rel="stylesheet" href="<?php echo $cssPath; ?>">
    
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding-top: 76px;
        }
        
        .animate-fade-in {
            animation: fadeIn 0.5s ease-in;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top animate-fade-in">
        <div class="container">
            <?php
            // Detecta se estamos em uma subpasta (admin ou login)
            $isAdmin = strpos($_SERVER['PHP_SELF'], '/admin/') !== false;
            $isLogin = strpos($_SERVER['PHP_SELF'], '/login/') !== false;
            $basePath = ($isAdmin || $isLogin) ? '../' : '';
            ?>
            <a class="navbar-brand" href="<?php echo $basePath; ?>index.php">
                <i class="bi bi-balloon-heart-fill"></i> INFLATOY
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $basePath; ?>index.php">
                            <i class="bi bi-house-door"></i> Início
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $basePath; ?>form.php">
                            <i class="bi bi-calendar-check"></i> Reservar
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $basePath; ?>about.php">
                            <i class="bi bi-info-circle"></i> Sobre
                        </a>
                    </li>
                </ul>
                
                <ul class="navbar-nav">
                    <?php if ($usuario_logado): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle user-menu" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle"></i> <span class="text-capitalize-words"><?php echo htmlspecialchars(ucwords(strtolower($_SESSION['nome']))); ?></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="<?php echo $basePath; ?>painel.php">
                                    <i class="bi bi-speedometer2"></i> Painel Admin
                                </a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="<?php echo $basePath; ?>login/logout.php">
                                    <i class="bi bi-box-arrow-right"></i> Sair
                                </a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="btn btn-login btn-sm me-2" href="<?php echo $basePath; ?>login/login.php">
                                <i class="bi bi-box-arrow-in-right"></i> Entrar
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-cadastro btn-sm" href="<?php echo $basePath; ?>login/cadastrar_usuario.php">
                                <i class="bi bi-person-plus"></i> Cadastrar
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

