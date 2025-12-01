# 🧪 Como Testar o Projeto INFLATOY

## ⚠️ IMPORTANTE: Antes de Testar

### 1. **Instalar/Configurar PHP e MySQL**

Se você ainda não tem PHP e MySQL instalados:

**No macOS:**
```bash
# Instalar Homebrew (se não tiver)
/bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"

# Instalar PHP
brew install php

# Instalar MySQL
brew install mysql
brew services start mysql
```

**OU use XAMPP/MAMP:**
- Baixe e instale o XAMPP: https://www.apachefriends.org/
- Ou MAMP: https://www.mamp.info/

### 2. **Importar o Banco de Dados**

**Opção A - Via phpMyAdmin (XAMPP/MAMP):**
1. Inicie o XAMPP/MAMP
2. Acesse http://localhost/phpmyadmin
3. Crie um banco chamado `inflatoy_db`
4. Selecione o banco e vá em "Importar"
5. Escolha o arquivo `inflatoy_db.sql` da pasta AS2-main
6. Clique em "Executar"

**Opção B - Via Linha de Comando:**
```bash
mysql -u root -p
CREATE DATABASE inflatoy_db;
USE inflatoy_db;
SOURCE /caminho/para/AS2-main/inflatoy_db.sql;
exit;
```

### 3. **Configurar Conexão**

Edite o arquivo `bd/conectaBD.php` se necessário:
```php
$servername = "localhost"; 
$username = "root";        // Seu usuário MySQL
$password = "";            // Sua senha MySQL (vazio se não tiver)
$database = "inflatoy_db";
```

## 🚀 Iniciar o Servidor

### **Método 1: Servidor PHP Embutido (Recomendado)**

Abra um terminal na pasta do projeto e execute:

```bash
cd /Users/lsoaresc/Downloads/ATS1/AS2-main
php -S localhost:8000
```

**OU use o script:**
```bash
cd /Users/lsoaresc/Downloads/ATS1/AS2-main
./iniciar_servidor.sh
```

### **Método 2: XAMPP/MAMP**

1. Copie a pasta `AS2-main` para:
   - **XAMPP:** `C:\xampp\htdocs\` (Windows) ou `/Applications/XAMPP/htdocs/` (Mac)
   - **MAMP:** `/Applications/MAMP/htdocs/`
2. Acesse: `http://localhost/AS2-main/index.php`

## 🌐 Acessar a Aplicação

### **Front-End (Público):**
- **Página Inicial:** http://localhost:8000/index.php
- **Formulário de Reserva:** http://localhost:8000/form.php
- **Sobre Nós:** http://localhost:8000/about.php

### **Área Administrativa:**
- **Login:** http://localhost:8000/login/login.php
- **Cadastrar Usuário:** http://localhost:8000/login/cadastrar_usuario.php
- **Painel Admin:** http://localhost:8000/painel.php (após login)

## ✅ Checklist de Testes

### **Front-End:**
- [ ] Acessar `index.php` e ver brinquedos carregados do banco
- [ ] Clicar em "Mais Informações" em um brinquedo
- [ ] Preencher formulário de reserva:
  - [ ] Validar nome (mínimo 3 caracteres)
  - [ ] Validar telefone com máscara (xx) xxxxx-xxxx
  - [ ] Validar email
  - [ ] Validar data (não pode ser passada)
  - [ ] Selecionar brinquedo
  - [ ] Escolher período
- [ ] Enviar formulário e ver confirmação
- [ ] Verificar se reserva foi salva no banco

### **Back-End:**
- [ ] Acessar `login/login.php`
- [ ] Criar novo usuário via "Cadastre-se aqui"
- [ ] Fazer login com novo usuário
- [ ] Tentar acessar `painel.php` sem login (deve redirecionar)
- [ ] Acessar painel após login
- [ ] Ver lista de usuários cadastrados
- [ ] Fazer logout
- [ ] Tentar acessar painel novamente (deve redirecionar)

## 🔍 Verificar Banco de Dados

No phpMyAdmin ou MySQL:
```sql
-- Ver reservas criadas
SELECT * FROM reservas;

-- Ver usuários cadastrados
SELECT id_usuario, nome_usuario, email, nivel_acesso FROM usuarios;

-- Ver brinquedos disponíveis
SELECT * FROM brinquedos WHERE ativo = 1;

-- Ver categorias
SELECT * FROM categorias;
```

## 🐛 Problemas Comuns

### **Erro: "PHP não encontrado"**
- Instale o PHP ou use XAMPP/MAMP
- Verifique se PHP está no PATH: `which php`

### **Erro de Conexão com Banco**
- Verifique se MySQL está rodando
- Confirme credenciais em `bd/conectaBD.php`
- Verifique se banco `inflatoy_db` existe

### **Página em Branco**
- Verifique logs de erro do PHP
- Ative exibição de erros no PHP (desenvolvimento)
- Verifique permissões dos arquivos

### **Imagens não aparecem**
- Verifique se pasta `img/` existe e tem as imagens
- Verifique caminhos relativos

## 📝 Notas

- O servidor PHP embutido é apenas para desenvolvimento
- Para produção, use Apache/Nginx
- Sempre verifique os logs de erro do PHP
- Mantenha o banco de dados atualizado

---

**Bons testes! 🎉**

Se encontrar problemas, verifique:
1. PHP está instalado e no PATH
2. MySQL está rodando
3. Banco de dados foi importado
4. Credenciais estão corretas

