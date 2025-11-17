# ✅ CHECKLIST RÁPIDO - DEFESA EM VÍDEO

## 📋 ANTES DE GRAVAR

- [ ] Todas as páginas funcionando localmente
- [ ] Navegador aberto com `index.html`
- [ ] Editor de código aberto com todos os arquivos
- [ ] Microfone testado
- [ ] Câmera funcionando
- [ ] Cursor visível na tela

---

## 🎬 DURANTE A GRAVAÇÃO

### 1. APRESENTAÇÃO (30s)
- [ ] Aparecer na câmera
- [ ] Dizer nome completo
- [ ] Mencionar o trabalho

### 2. PÁGINA INICIAL (1min)
- [ ] Abrir `index.html` no navegador
- [ ] Mostrar página funcionando
- [ ] Abrir código HTML (linhas 18-26) - menu
- [ ] Abrir código CSS (linhas 64-86) - estilos do menu
- [ ] Explicar HTML e CSS puro

### 3. MENU PADRÃO (30s)
- [ ] Navegar entre páginas (index → form → about)
- [ ] Mostrar menu em todas as páginas
- [ ] Mostrar página ativa destacada
- [ ] Explicar que é HTML/CSS puro, sem frameworks

### 4. FORMULÁRIO (1min 30s)
- [ ] Abrir `form.html`
- [ ] Tentar enviar vazio → mostrar erros
- [ ] Testar validações (nome curto, telefone, data passada)
- [ ] Mostrar código HTML (linhas 32-77)
- [ ] Mostrar código JavaScript (linhas 20-41) - validações
- [ ] Mostrar máscara de telefone (linhas 74-90)
- [ ] Explicar: required, type, pattern, regex, JavaScript

### 5. RECEPÇÃO GET (1min)
- [ ] Preencher e enviar formulário
- [ ] Mostrar dados na URL
- [ ] Mostrar `form_action.html` com dados exibidos
- [ ] Mostrar código HTML (linhas 35-42)
- [ ] Mostrar código JavaScript (linhas 155-191) - URLSearchParams
- [ ] Explicar processamento de GET com JavaScript

### 6. PÁGINA SOBRE (1min)
- [ ] Abrir `about.html`
- [ ] Clicar nos botões "Ver Detalhes" → mostrar interatividade JavaScript
- [ ] Clicar no botão "Alterar Cor de Fundo" → mostrar mudança dinâmica
- [ ] Mostrar código HTML (linhas 28-82) - estrutura semântica
- [ ] Mostrar CSS (linhas 276-409) - Grid, classes, hover
- [ ] Mostrar JavaScript (linhas 217-245) - manipulação DOM
- [ ] Mencionar os 3 autores e seus cursos
- [ ] Mencionar tecnologias (HTML/CSS/JS puro)

### 7. CONCLUSÃO (30s)
- [ ] Resumir funcionalidades
- [ ] Mencionar HTML/CSS/JS puro
- [ ] Agradecer

---

## 📝 CÓDIGOS PARA DESTACAR

### HTML - Menu (todas as páginas)
```18:26:index.html
<aside class="sidebar">
    <nav class="nav">
        <ul class="nav-list-sidebar">
            <li class="nav-item-active"><a href="index.html" class="nav-link-sidebar">Inicio</a></li>
            <li><a href="form.html" class="nav-link-sidebar">Contato</a></li>
            <li><a href="about.html" class="nav-link-sidebar">Sobre Nós</a></li>
        </ul>
    </nav>
</aside>
```

### CSS - Estilos do Menu
```64:86:css/style.css
.nav-list-sidebar {
    list-style: none;
}

.nav-link-sidebar {
    display: block;
    padding: 10px 20px;
    text-decoration: none;
    color: var(--color-dark);
    transition: background-color 0.2s;
}

.nav-link-sidebar:hover {
    background-color: #dce27e;
}

.nav-item-active {
    background-color: var(--color-sidebar-active);
}

.nav-item-active .nav-link-sidebar {
    color: var(--color-light);
}
```

### JavaScript - Validações
```20:41:script/script.js
//Funçãos de validação
const validateName = (name) => name.trim().length >= 3;

//Padronização de caracteres numéricos e validação de formato
const validatePhone = (phone) => {
    const cleanedPhone = phone.trim();
    const phoneRegex = /^\(\d{2}\) \d{4,5}-\d{4}$/;
    return phoneRegex.test(cleanedPhone);
};

const validateEmail = (email) => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.trim());
const validateDate = (date) => {
    if (!date) return false;
    const selectedDate = new Date(date);
    const today = new Date();
    today.setHours(0, 0, 0, 0);
    selectedDate.setHours(0, 0, 0, 0);
    return selectedDate >= today;
};

const validateSelect = (value) => value !== "";
const validateRadio = (name) => document.querySelector(`input[name="${name}"]:checked`) !== null;
```

### JavaScript - Recepção GET
```155:191:script/script.js
// Recupera e exibe parâmetros GET
function setupGetParams() {
    const dataList = document.getElementById('dataList');
    if (!dataList) return; 

    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);

    const toyMap = {
        'castelo': 'Castelo Mágico',
        'escorregador': 'Super Escorregador',
        'piscina': 'Piscina de Bolinhas',
        'combo': 'Combo Atividades',
        'combo2': 'Combo Atividades 2',
        'touro': 'Touro Mecânico',
        'guerra': 'Guerra de Cotonetes'
    };

    const periodMap = {
        'diario': 'Diário (08h - 18h)',
        'completo': 'Festa Completa (24h)'
    };

    const updateElement = (id, value, map = null) => {
        const element = document.getElementById(id);
        if (element) {
            element.textContent = map ? map[value] || value : value;
        }
    };

    // Recupera e exibe cada parâmetro
    updateElement('outName', urlParams.get('name') || 'N/A');
    updateElement('outPhone', urlParams.get('phone') || 'N/A');
    updateElement('outEmail', urlParams.get('email') || 'N/A');
    updateElement('outDate', urlParams.get('date') || 'N/A');
    updateElement('outToy', urlParams.get('toy') || 'N/A', toyMap);
    updateElement('outPeriod', urlParams.get('period') || 'N/A', periodMap);
}
```

---

## 🎯 PONTOS-CHAVE PARA MENCIONAR

✅ **HTML puro** - sem frameworks  
✅ **CSS puro** - classes reutilizáveis  
✅ **JavaScript puro** - sem bibliotecas  
✅ **Validações múltiplas** - required, type, pattern, regex, JS  
✅ **Método GET** - dados na URL  
✅ **URLSearchParams** - processamento JavaScript  
✅ **Menu padrão** - presente em todas as páginas  
✅ **Padrão visual uniforme** - cores e estilos consistentes  

---

**Tempo total: 5 minutos** ⏱️

