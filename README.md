# Inflatoy - Site de Aluguel de Brinquedos Infláveis

Site desenvolvido para a **Atividade Somativa 1** da disciplina de Desenvolvimento Web Front-End.

## 📋 Descrição

Site institucional da **Inflatoy**, empresa especializada em aluguel de brinquedos infláveis para festas infantis. O site foi desenvolvido utilizando apenas HTML, CSS e JavaScript puro, sem frameworks ou bibliotecas externas.

## 🚀 Tecnologias Utilizadas

- **HTML5** - Estruturação do conteúdo
- **CSS3** - Estilização e layout responsivo
- **JavaScript (ES6+)** - Interatividade e validação de formulários

## 📁 Estrutura do Projeto

```
AS1/
├── index.html          # Página inicial
├── form.html           # Formulário de reserva
├── form_action.html    # Página de confirmação (recebe dados via GET)
├── about.html          # Página sobre a empresa
├── css/
│   └── style.css      # Estilos do site
├── script/
│   └── script.js      # Scripts JavaScript
└── img/
    ├── castelo.jpg
    ├── escorregador.jpg
    ├── piscina.jpg
    ├── combo.jpg
    └── combo2.jpg
```

## ✨ Funcionalidades

### Página Inicial (index.html)
- Exibição do catálogo de brinquedos
- Menu de navegação padrão
- Links diretos para formulário de reserva

### Formulário (form.html)
- Validação completa de todos os campos:
  - **Nome**: mínimo de 3 caracteres
  - **Telefone**: máscara automática e validação por regex
  - **E-mail**: validação de formato
  - **Data**: validação de data futura
  - **Brinquedo**: seleção obrigatória
  - **Período**: seleção obrigatória (radio buttons)
- Preenchimento automático do brinquedo quando acessado via link da página inicial
- Envio de dados via método GET

### Página de Confirmação (form_action.html)
- Recebe e processa dados enviados via GET
- Exibe resumo da reserva utilizando JavaScript
- Mapeamento de valores para nomes amigáveis

### Página Sobre (about.html)
- Informações sobre a empresa
- Menu de navegação padrão

## 🎨 Características de Design

- **Padrão visual uniforme**: cores, fontes e estilos consistentes em todas as páginas
- **Menu padrão**: presente em todas as páginas com indicação visual da página ativa
- **Layout responsivo**: adaptável a diferentes tamanhos de tela
- **Cores temáticas**: paleta de cores vibrante e adequada ao público infantil

## 📝 Como Publicar no GitHub Pages

1. Faça o commit de todos os arquivos para o repositório:
   ```bash
   git add .
   git commit -m "Projeto Inflatoy - Atividade Somativa 1"
   git push origin main
   ```

2. No GitHub, vá em **Settings** > **Pages**

3. Em **Source**, selecione a branch **main** e a pasta **/ (root)**

4. Clique em **Save**

5. Aguarde alguns minutos e acesse: `https://seu-usuario.github.io/nome-do-repo/`

## 🔍 Validações Implementadas

- ✅ Validação de nome (mínimo 3 caracteres)
- ✅ Máscara e validação de telefone com regex
- ✅ Validação de e-mail com regex
- ✅ Validação de data (não permite datas passadas)
- ✅ Validação de select (brinquedo obrigatório)
- ✅ Validação de radio buttons (período obrigatório)
- ✅ Mensagens de erro dinâmicas
- ✅ Limpeza automática de erros ao corrigir campos

## 📚 Recursos JavaScript

- Manipulação do DOM
- Event Listeners
- Validação de formulários
- Máscara de entrada (telefone)
- Processamento de parâmetros GET (URLSearchParams)
- Alteração dinâmica de estilos

## 👨‍💻 Autor

Desenvolvido para a Atividade Somativa 1 - Desenvolvimento Web Front-End

---

**Nota**: Este projeto foi desenvolvido exclusivamente com HTML, CSS e JavaScript puro, sem utilização de frameworks ou bibliotecas externas, conforme requisitos da atividade.

