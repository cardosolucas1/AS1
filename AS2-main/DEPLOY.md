# 🚀 Guia de Deploy - ATS2

## ⚠️ IMPORTANTE: GitHub Pages não suporta PHP/MySQL

GitHub Pages serve apenas arquivos estáticos (HTML, CSS, JavaScript). Para aplicações PHP/MySQL, você precisa de um servidor que suporte essas tecnologias.

---

## 🌐 Opções de Deploy

### 1. 000webhost (Recomendado - Gratuito)

**Vantagens:**
- ✅ Gratuito
- ✅ Suporta PHP e MySQL
- ✅ 300 MB de espaço
- ✅ Sem anúncios

**Passos:**
1. Acesse: https://www.000webhost.com/
2. Crie uma conta gratuita
3. Crie um novo site
4. Acesse o File Manager ou use FTP
5. Faça upload de todos os arquivos do projeto
6. No painel, crie um banco de dados MySQL
7. Importe o arquivo `inflatoy_db.sql`
8. Edite `bd/conectaBD.php` com as credenciais fornecidas

---

### 2. InfinityFree (Gratuito)

**Vantagens:**
- ✅ Gratuito
- ✅ Suporta PHP e MySQL
- ✅ 5 GB de espaço
- ✅ Sem anúncios

**Passos:**
1. Acesse: https://www.infinityfree.net/
2. Crie uma conta
3. Crie um novo site
4. Use o File Manager ou FTP para upload
5. Crie banco de dados MySQL no painel
6. Importe `inflatoy_db.sql`
7. Configure `bd/conectaBD.php`

---

### 3. Heroku (Gratuito com limitações)

**Vantagens:**
- ✅ Gratuito (com limitações)
- ✅ Suporta PHP
- ✅ MySQL via addon (pago) ou PostgreSQL (gratuito)

**Passos:**
1. Instale Heroku CLI
2. Crie arquivo `composer.json`:
```json
{
    "require": {
        "php": "^7.4"
    }
}
```

3. Crie arquivo `Procfile`:
```
web: vendor/bin/heroku-php-apache2
```

4. Faça deploy:
```bash
heroku create seu-app
git push heroku main
```

---

### 4. Vercel (Gratuito)

**Vantagens:**
- ✅ Gratuito
- ✅ Suporta PHP via serverless
- ⚠️ MySQL precisa ser externo (ex: PlanetScale, Railway)

**Passos:**
1. Instale Vercel CLI: `npm i -g vercel`
2. No diretório do projeto: `vercel`
3. Configure variáveis de ambiente
4. Use MySQL externo (PlanetScale, Railway, etc.)

---

### 5. Railway (Gratuito com limitações)

**Vantagens:**
- ✅ Gratuito (com limitações)
- ✅ Suporta PHP e MySQL
- ✅ Deploy via GitHub

**Passos:**
1. Acesse: https://railway.app/
2. Conecte seu repositório GitHub
3. Configure banco de dados MySQL
4. Configure variáveis de ambiente
5. Deploy automático

---

## 📦 Preparação para Deploy

### 1. Remover arquivos desnecessários
Certifique-se de que o `.gitignore` está configurado corretamente.

### 2. Configurar conexão do banco
Crie um arquivo de exemplo:
```php
// bd/conectaBD.php
<?php
$servername = "localhost"; // ou IP do servidor
$username = "seu_usuario";
$password = "sua_senha";
$database = "inflatoy_db";
?>
```

### 3. Verificar permissões
- Pastas: 755
- Arquivos PHP: 644

### 4. Testar localmente
Antes de fazer deploy, teste tudo localmente:
```bash
php -S localhost:8000
```

---

## 🔧 Configuração Pós-Deploy

### 1. Banco de Dados
- Importe `inflatoy_db.sql`
- Verifique se todas as tabelas foram criadas
- Teste conexão com `bd/conectaBD.php`

### 2. URLs e Caminhos
- Verifique se todos os caminhos relativos estão corretos
- Teste navegação entre páginas
- Verifique se imagens carregam corretamente

### 3. Segurança
- ✅ Não commite credenciais no Git
- ✅ Use `.env` ou arquivo de configuração local
- ✅ Configure HTTPS se possível
- ✅ Valide todos os inputs

---

## 📝 Checklist de Deploy

- [ ] Todos os arquivos foram enviados
- [ ] Banco de dados criado e importado
- [ ] `bd/conectaBD.php` configurado
- [ ] Permissões de arquivos corretas
- [ ] Testado login e cadastro
- [ ] Testado CRUD completo
- [ ] Testado formulário público
- [ ] URLs funcionando corretamente
- [ ] Imagens carregando
- [ ] CSS e JavaScript funcionando

---

## 🆘 Troubleshooting

### Erro de conexão com banco
- Verifique credenciais em `bd/conectaBD.php`
- Verifique se o banco foi criado
- Verifique se o usuário tem permissões

### Página em branco
- Verifique logs de erro do PHP
- Verifique se PHP está habilitado
- Verifique permissões de arquivos

### CSS/JS não carregam
- Verifique caminhos relativos
- Verifique se arquivos foram enviados
- Limpe cache do navegador

---

## 📞 Suporte

Para problemas com deploy, consulte:
- Documentação do hosting escolhido
- Logs de erro do servidor
- Console do navegador (F12)

---

**Boa sorte com o deploy! 🚀**

