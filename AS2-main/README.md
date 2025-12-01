# 🎈 ATS2 - Inflatoy: Sistema de Aluguel de Brinquedos Infláveis

## 📋 Sobre o Projeto

**ATS2 (Atividade Somativa 2)** - Sistema web full-stack para gerenciamento de aluguel de brinquedos infláveis, desenvolvido como parte da disciplina de Desenvolvimento Web Full-Stack.

### 🎯 Área de Negócio
**Inflatoy** - Plataforma para gerenciar o aluguel de brinquedos infláveis para festas infantis, incluindo catálogo de produtos, sistema de reservas e painel administrativo completo.

---

## 🛠️ Tecnologias Utilizadas

- **Front-End:**
  - HTML5
  - CSS3 (Bootstrap 5.3.2)
  - JavaScript (ES6+)
  
- **Back-End:**
  - PHP 7.4+
  - MySQL/MariaDB
  
- **Frameworks e Bibliotecas:**
  - Bootstrap 5.3.2
  - Bootstrap Icons
  - Animate.css

---

## 📦 Estrutura do Projeto

```
ATS2/
├── index.php                    # Página inicial (pública)
├── form.php                     # Formulário de reserva (pública)
├── form_action.php              # Processamento de reserva
├── about.php                    # Sobre o projeto (pública)
├── painel.php                   # Painel admin (protegida)
├── admin/
│   ├── index.php               # Redireciona para painel
│   ├── brinquedos.php          # CRUD brinquedos (protegida)
│   ├── categorias.php          # CRUD categorias (protegida)
│   └── reservas.php            # CRUD reservas (protegida)
├── login/
│   ├── login.php               # Página de login
│   ├── login_exe.php           # Processamento de login
│   ├── cadastrar_usuario.php   # Cadastro de usuário
│   └── logout.php              # Logout
├── bd/
│   ├── conectaBD.php           # Conexão com banco
│   └── verifica_sessao.php     # Verificação de autenticação
├── includes/
│   ├── header.php              # Header reutilizável
│   └── footer.php              # Footer reutilizável
├── css/
│   └── style.css               # Estilos customizados
├── script/
│   └── script.js               # Validações JavaScript
├── img/                        # Imagens dos brinquedos
└── inflatoy_db.sql             # Script SQL do banco de dados
```

---

## 🚀 Instalação e Configuração

### Pré-requisitos
- PHP 7.4 ou superior
- MySQL/MariaDB 5.7 ou superior
- Servidor web (Apache/Nginx) ou PHP built-in server
- Git (para clonar o repositório)

### Passo 1: Clonar o Repositório
```bash
git clone git@github.com:cardosolucas1/AS1.git
cd AS1
```

### Passo 2: Configurar o Banco de Dados
1. Acesse o phpMyAdmin ou cliente MySQL
2. Importe o arquivo `inflatoy_db.sql`
3. Ou execute no MySQL:
```sql
mysql -u root -p < inflatoy_db.sql
```

### Passo 3: Configurar Conexão com Banco
Edite o arquivo `bd/conectaBD.php`:
```php
<?php
$servername = "localhost";
$username = "seu_usuario";
$password = "sua_senha";
$database = "inflatoy_db";
?>
```

### Passo 4: Iniciar o Servidor

#### Opção 1: PHP Built-in Server
```bash
php -S localhost:8000
```

#### Opção 2: XAMPP/MAMP
- Coloque a pasta do projeto em `htdocs` (XAMPP) ou `htdocs` (MAMP)
- Acesse: `http://localhost/ATS2/`

#### Opção 3: Script Automático
```bash
chmod +x iniciar_servidor.sh
./iniciar_servidor.sh
```

### Passo 5: Acessar a Aplicação
- **URL:** `http://localhost:8000`
- **Usuário padrão:** admin@inflatoy.com
- **Senha padrão:** (verificar no banco de dados)

---

## 📱 Funcionalidades

### Páginas Públicas
- ✅ **Página Inicial:** Catálogo de brinquedos disponíveis
- ✅ **Formulário de Reserva:** Clientes podem solicitar aluguel
- ✅ **Sobre Nós:** Informações sobre o projeto

### Área Administrativa (Requer Login)
- ✅ **Painel de Controle:** Dashboard com estatísticas
- ✅ **CRUD de Brinquedos:** Gerenciar catálogo
- ✅ **CRUD de Categorias:** Organizar brinquedos
- ✅ **CRUD de Reservas:** Gerenciar solicitações

### Sistema de Autenticação
- ✅ Login com email e senha
- ✅ Cadastro de novos usuários
- ✅ Senhas criptografadas (password_hash)
- ✅ Proteção de páginas administrativas
- ✅ Logout seguro

---

## 🗄️ Estrutura do Banco de Dados

### Tabelas
1. **categorias** - Categorias de brinquedos
2. **brinquedos** - Catálogo de brinquedos (FK: id_categoria)
3. **reservas** - Solicitações de aluguel
4. **usuarios** - Usuários do sistema

### Relacionamentos
- `categorias` (1) → `brinquedos` (N) - Relacionamento 1xN

---

## ⚠️ IMPORTANTE: GitHub Pages e PHP/MySQL

**GitHub Pages NÃO suporta PHP e MySQL nativamente!**

GitHub Pages serve apenas arquivos estáticos (HTML, CSS, JavaScript). Para aplicações PHP/MySQL, você precisa de um servidor que suporte essas tecnologias.

### Alternativas para Deploy

#### 1. **000webhost** (Gratuito)
- Suporta PHP e MySQL
- URL: https://www.000webhost.com/
- Upload via FTP ou interface web

#### 2. **InfinityFree** (Gratuito)
- Suporta PHP e MySQL
- URL: https://www.infinityfree.net/
- Upload via FTP

#### 3. **Heroku** (Gratuito com limitações)
- Suporta PHP via buildpack
- MySQL via addon (pago) ou PostgreSQL (gratuito)
- URL: https://www.heroku.com/

#### 4. **Vercel** (Gratuito)
- Suporta PHP via serverless functions
- MySQL via serviço externo
- URL: https://vercel.com/

#### 5. **Railway** (Gratuito com limitações)
- Suporta PHP e MySQL
- URL: https://railway.app/

### Instruções para Deploy em Hosting PHP

1. **Fazer upload dos arquivos:**
   - Compacte a pasta `AS2-main` em ZIP
   - Faça upload via FTP ou interface do hosting

2. **Configurar banco de dados:**
   - Crie o banco de dados no painel do hosting
   - Importe o arquivo `inflatoy_db.sql`
   - Atualize `bd/conectaBD.php` com as credenciais do hosting

3. **Ajustar permissões:**
   - Certifique-se de que as pastas têm permissões corretas (755)
   - Arquivos PHP devem ter permissão 644

---

## 🧪 Testes

### Testar Funcionalidades
1. **Cadastro de Usuário:**
   - Acesse `/login/cadastrar_usuario.php`
   - Crie uma nova conta
   - Faça login com a conta criada

2. **CRUD de Brinquedos:**
   - Faça login
   - Acesse `/admin/brinquedos.php`
   - Teste adicionar, editar e excluir brinquedos

3. **CRUD de Categorias:**
   - Acesse `/admin/categorias.php`
   - Teste todas as operações

4. **CRUD de Reservas:**
   - Acesse `/admin/reservas.php`
   - Visualize, atualize status e exclua reservas

5. **Formulário Público:**
   - Acesse `/form.php` (sem login)
   - Preencha e envie uma reserva

---

## 📝 Requisitos Atendidos

✅ Definição de área de negócio  
✅ Base de dados MySQL com relacionamento 1xN  
✅ Dados mínimos para demonstração  
✅ Tabela de usuários com senha criptografada  
✅ Sistema de login completo  
✅ Interface padronizada (Bootstrap)  
✅ Validação de formulários (JavaScript + HTML5 + PHP)  
✅ CRUD completo (INSERT, SELECT, UPDATE, DELETE)  
✅ Acesso restrito apenas para usuários autenticados  

---

## 👥 Autores

- **Lucas Soares Cardoso** - Inteligência Artificial Aplicada
- **Samuel Gustavo de Lima** - Análise e Desenvolvimento de Sistemas
- **Victor Hugo Guedes Pirozzi** - Análise e Desenvolvimento de Sistemas

---

## 📄 Licença

Este projeto foi desenvolvido para fins educacionais como parte da Atividade Somativa 2.

---

## 🔗 Links Úteis

- [Documentação PHP](https://www.php.net/docs.php)
- [Documentação MySQL](https://dev.mysql.com/doc/)
- [Bootstrap 5](https://getbootstrap.com/docs/5.3/)
- [Documentação Completa](./VERIFICACAO_REQUISITOS.md)

---

**Desenvolvido com ❤️ para a disciplina de Desenvolvimento Web Full-Stack**
