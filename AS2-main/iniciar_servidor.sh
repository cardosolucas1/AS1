#!/bin/bash
# Script para iniciar o servidor PHP

echo "🚀 Iniciando servidor PHP na porta 8000..."
echo "📁 Diretório: $(pwd)"
echo ""
echo "✅ Acesse a aplicação em:"
echo "   🌐 Front-end: http://localhost:8000/index.php"
echo "   🔐 Login: http://localhost:8000/login/login.php"
echo ""
echo "⚠️  Certifique-se de que:"
echo "   1. O banco de dados 'inflatoy_db' está criado"
echo "   2. O arquivo inflatoy_db.sql foi importado"
echo "   3. As credenciais em bd/conectaBD.php estão corretas"
echo ""
echo "🛑 Para parar o servidor, pressione Ctrl+C"
echo ""

cd "$(dirname "$0")"
php -S localhost:8000

