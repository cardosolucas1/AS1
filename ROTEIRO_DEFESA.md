# 🎥 ROTEIRO DE DEFESA - ATIVIDADE SOMATIVA 1
## Site Inflatoy - Aluguel de Brinquedos Infláveis

**Duração máxima: 5 minutos**

---

## 📋 INTRODUÇÃO (30 segundos)

### 1. Apresentação Pessoal
**AÇÃO:** Apareça na câmera e diga:
- "Olá, meu nome é [SEU NOME]"
- "Vou apresentar o trabalho da Atividade Somativa 1: um site desenvolvido com HTML, CSS e JavaScript puro"

**TRANSITION:** "Agora vou mostrar o site funcionando e explicar o código desenvolvido."

---

## 🏠 PARTE 1: PÁGINA INICIAL (index.html) - 1 minuto

### O que fazer:
1. **Abra o navegador** e acesse `index.html` localmente (mostre o caminho do arquivo)
   - Exemplo: `file:///Users/lsoaresc/Downloads/AS1/index.html` ou `http://localhost/AS1/index.html`

2. **Mostre a página funcionando:**
   - "Esta é a página inicial do site Inflatoy"
   - "Aqui temos o catálogo de brinquedos infláveis disponíveis para aluguel"
   - "Vou clicar em um dos brinquedos para mostrar a navegação"

3. **Abra o código HTML** (`index.html`) e destaque:

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

**NARRE:** "Aqui temos a estrutura HTML do menu de navegação, criado com elementos semânticos HTML5: `<nav>`, `<ul>`, `<li>` e links `<a>`."

4. **Mostre o CSS** (`css/style.css`) - linhas 64-86:

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

**NARRE:** "O menu foi estilizado completamente com CSS puro, sem frameworks. Usamos classes reutilizáveis como `.nav-link-sidebar` e `.nav-item-active` para indicar a página atual. O hover também foi implementado com CSS."

---

## 🎨 PARTE 2: MENU PADRÃO EM TODAS AS PÁGINAS - 30 segundos

### O que fazer:
1. **Navegue entre as páginas** (index.html → form.html → about.html)
   - Mostre que o menu aparece em todas as páginas
   - Mostre que a página ativa fica destacada (fundo escuro)

2. **Destaque no código:**
   - Mostre que todas as páginas têm a mesma estrutura do menu (linhas 18-26)
   - Mostre que apenas a classe `nav-item-active` muda de página para página

**NARRE:** "O menu padrão está presente em todas as páginas do site, criado exclusivamente com HTML e CSS, sem uso de frameworks. A página ativa é indicada pela classe `nav-item-active`, que muda dinamicamente em cada página."

---

## 📝 PARTE 3: PÁGINA DE FORMULÁRIO (form.html) - 1 minuto e 30 segundos

### O que fazer:
1. **Abra `form.html` no navegador** e mostre o formulário

2. **Demonstre as validações:**
   - Tente enviar o formulário vazio → mostre as mensagens de erro
   - Preencha um nome com menos de 3 caracteres → mostre erro
   - Digite um telefone → mostre a máscara funcionando
   - Tente uma data passada → mostre erro
   - Deixe um campo obrigatório vazio → mostre erro

3. **Mostre o código HTML** - linhas 32-77:

```32:77:form.html
<form id="reservationForm" action="form_action.html" method="GET" class="form-container">
    
    <div class="form-group">
        <label for="name">Seu Nome<i class="fa fa-user" aria-hidden="true"></i></label>
        <input type="text" name="name" id="name" placeholder="Seu Nome Completo" required>
        <span class="error-message" id="errorName"></span>
    </div><br>  

    <div class="form-group">
        <label for="phone">Celular<i class="fa fa-phone" aria-hidden="true"></i></label>
        <input type="tel" name="phone" id="phone" pattern="\(\d{2}\)\s\d{4,5}-\d{4}$"
        placeholder="Seu celular" title="(xx) xxxxx-xxxx" required>
    </div><br>
    
    <div class="form-group">
        <label for="email">E-mail:<i class="fa fa-envelope" aria-hidden="true"></i></label>
        <input type="email" name="email" id="email" placeholder="Seu Email" required>
    </div><br>

    <div class="form-group">
        <label for="date">Selecione a Data desejada<i class="fa fa-date" aria-hidden="true"></i></label>
        <input type="date" name="date" id="date" placeholder="Selecione a Data" required>
    </div><br>

    <div class="form-group">
        <label for="toy">Brinquedo Desejado:</label>
        <select id="toy" name="toy" required class="form-input">
            <option value="">Selecione um Brinquedo</option>
            <option value="castelo">Castelo Mágico</option>
            <option value="escorregador">Super Escorregador</option>
            <option value="piscina">Piscina de Bolinhas</option>
            <option value="combo">Combo Atividades</option>
            <option value="combo2">Combo Atividades 2</option>
        </select>
        <span class="error-message" id="errorToy"></span>
    </div>
    
    <div class="form-group">
        <label>Período de Aluguel:</label>
        <label class="form-radio-label"><input type="radio" name="period" value="diario" required> Diário (08h - 18h)</label>
        <label class="form-radio-label"><input type="radio" name="period" value="completo" required> Festa Completa (24h)</label>
        <span class="error-message" id="errorPeriod"></span>
    </div>

    <button type="submit" class="btn btn-primary btn-full btn-detail">Solicitar Cotação</button>
</form>
```

**NARRE:** "O formulário utiliza múltiplas técnicas de validação: o atributo HTML5 `required` para campos obrigatórios, o tipo `email` para validação de e-mail, o tipo `date` para seleção de data, e o atributo `pattern` com expressão regular para validação de telefone."

4. **Mostre o JavaScript** (`script/script.js`) - linhas 20-41:

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

**NARRE:** "As validações são implementadas em JavaScript: validação de nome com mínimo de 3 caracteres, validação de telefone com expressão regular, validação de e-mail com regex, validação de data para não permitir datas passadas, e validação de select e radio buttons."

5. **Mostre a máscara de telefone** - linhas 74-90:

```74:90:script/script.js
// Aplica a máscara de telefone (formato: (xx) xxxxx-xxxx)
const maskPhone = (event) => {
    let value = event.target.value.replace(/\D/g, ""); // Remove tudo que não for dígito
    let formattedValue = '';

    if (value.length > 0) {
        formattedValue += '(' + value.substring(0, 2);
    }
    if (value.length > 2) {
        formattedValue += ') ' + value.substring(2, 7);
    }
    if (value.length > 7) {
        formattedValue += '-' + value.substring(7, 11);
    }
    
    event.target.value = formattedValue;
};
```

**NARRE:** "A máscara de telefone é aplicada dinamicamente com JavaScript, formatando automaticamente o número no padrão (xx) xxxxx-xxxx enquanto o usuário digita."

---

## 📨 PARTE 4: RECEPÇÃO DE DADOS VIA GET (form_action.html) - 1 minuto

### O que fazer:
1. **Preencha o formulário** completamente e envie
   - Mostre que os dados aparecem na URL (método GET)
   - Exemplo: `form_action.html?name=João&phone=(11) 98765-4321&email=joao@email.com&date=2025-02-15&toy=castelo&period=diario`

2. **Mostre a página `form_action.html`** funcionando com os dados exibidos

3. **Mostre o código HTML** - linhas 35-42:

```35:42:form_action.html
<ul id="dataList" style="list-style: none; padding-left: 0;">
    <li><strong>Nome:</strong> <span id="outName"></span></li>
    <li><strong>Telefone:</strong> <span id="outPhone"></span></li>
    <li><strong>E-mail:</strong> <span id="outEmail"></span></li>
    <li><strong>Data da Festa:</strong> <span id="outDate"></span></li>
    <li><strong>Brinquedo:</strong> <span id="outToy"></span></li>
    <li><strong>Período:</strong> <span id="outPeriod"></span></li>
</ul>
```

**NARRE:** "A página possui elementos HTML com IDs específicos onde os dados serão inseridos dinamicamente via JavaScript."

4. **Mostre o JavaScript** (`script/script.js`) - linhas 155-191:

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

**NARRE:** "A função `setupGetParams()` utiliza `URLSearchParams` para extrair os parâmetros da URL enviados via método GET. Os dados são recuperados, processados com mapeamentos para nomes amigáveis, e inseridos dinamicamente nos elementos HTML usando `textContent`."

---

## ℹ️ PARTE 5: PÁGINA SOBRE (about.html) - 1 minuto

### O que fazer:
1. **Abra `about.html` no navegador** e mostre a página funcionando

2. **Demonstre a interatividade JavaScript:**
   - Clique nos botões "Ver Detalhes" dos autores → mostre os detalhes aparecendo/desaparecendo
   - Clique no botão "Alterar Cor de Fundo" → mostre a cor mudando dinamicamente

3. **Mostre o código HTML** - linhas 28-82:

```28:82:about.html
<main class="main-content-column">
    <h2>Sobre o Trabalho</h2>
    
    <div class="card card-sidebar-style about-card">
        <div class="card-body">
            <h3>Atividade Somativa 1</h3>
            <p>Este site foi desenvolvido como parte da <strong>Atividade Somativa 1</strong> da disciplina de Desenvolvimento Web Front-End.</p>
            <p>O projeto demonstra o uso exclusivo de <strong>HTML5</strong>, <strong>CSS3</strong> e <strong>JavaScript</strong> puro, sem utilização de frameworks ou bibliotecas externas.</p>
        </div>
    </div>

    <h2 style="margin-top: 30px;">Sobre a Inflatoy</h2>
    <p>Nós somos dedicados a levar diversão segura e inesquecível para todas as festas infantis. Nosso compromisso é com a qualidade e a alegria dos seus filhos.</p>
    <p>Se tiver dúvidas, use nossa página de <a href="form.html" class="about-link">Contato</a>!</p>

    <h2 style="margin-top: 30px;">Autores</h2>
    <div class="authors-container">
        <div class="author-card" id="author1">
            <h3>Lucas Soares Cardoso</h3>
            <p class="author-course">Inteligência Artificial Aplicada</p>
            <button class="btn-toggle-info" onclick="toggleAuthorInfo(1)">Ver Detalhes</button>
            <div class="author-details" id="details1">
                <p>Desenvolvedor responsável pela estruturação HTML e implementação das validações JavaScript.</p>
            </div>
        </div>
        <!-- ... outros autores ... -->
    </div>
</main>
```

**NARRE:** "Esta página utiliza elementos semânticos HTML5 como `<main>`, `<div>`, `<section>` e `<article>`. Apresenta informações sobre o trabalho, a empresa e os três autores do projeto."

4. **Mostre o CSS** - linhas 276-409:

```276:341:css/style.css
/* Estilos específicos para a página About */
.about-card {
    margin-bottom: 30px;
}

.authors-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-top: 20px;
}

.author-card {
    background: var(--color-light);
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    text-align: center;
    transition: transform 0.3s, box-shadow 0.3s;
}

.author-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
}
```

**NARRE:** "O CSS utiliza Grid Layout para organizar os cards dos autores de forma responsiva, classes reutilizáveis como `.card-sidebar-style`, variáveis CSS para cores, e efeitos de hover com transições suaves."

5. **Mostre o JavaScript** (`script/script.js`) - linhas 217-245:

```217:245:script/script.js
// Funções específicas para a página About
function toggleAuthorInfo(authorNum) {
    const details = document.getElementById(`details${authorNum}`);
    const button = event.target;
    
    if (details && button) {
        if (details.style.display === 'none' || details.style.display === '') {
            details.style.display = 'block';
            button.textContent = 'Ocultar Detalhes';
            button.style.backgroundColor = '#a58326';
        } else {
            details.style.display = 'none';
            button.textContent = 'Ver Detalhes';
            button.style.backgroundColor = '';
        }
    }
}

function togglePageColor() {
    const body = document.body;
    const currentColor = window.getComputedStyle(body).backgroundColor;
    
    // Alterna entre a cor padrão e uma cor alternativa
    if (currentColor === 'rgb(184, 243, 216)' || currentColor.includes('rgb(184, 243, 216)')) {
        body.style.backgroundColor = '#e8f5e9';
    } else {
        body.style.backgroundColor = '#b8f3d8';
    }
}
```

**NARRE:** "O JavaScript demonstra manipulação dinâmica do DOM: alteração de estilos com `style.display`, mudança de conteúdo com `textContent`, e alteração de propriedades CSS com `style.backgroundColor`. Isso evidencia o uso de JavaScript puro para interatividade."

6. **Mencione os autores:**
   - "Este trabalho foi desenvolvido por três alunos:"
   - "Lucas Soares Cardoso - Inteligência Artificial Aplicada"
   - "Samuel Gustavo de Lima - Análise e Desenvolvimento de Sistemas"
   - "Victor Hugo Guedes Pirozzi - Análise e Desenvolvimento de Sistemas"
   - "Todo o código foi escrito em HTML, CSS e JavaScript puro, sem frameworks"

---

## ✅ CONCLUSÃO (30 segundos)

**NARRE:**
- "Demonstrei todas as funcionalidades exigidas: página inicial, menu padrão, formulário com validações completas, recepção de dados via GET com JavaScript, e página informativa."
- "O site está totalmente funcional e pronto para uso."
- "Obrigado pela atenção!"

---

## ⏱️ DISTRIBUIÇÃO DE TEMPO

| Parte | Tempo |
|-------|-------|
| Apresentação | 30s |
| Página Inicial | 1min |
| Menu Padrão | 30s |
| Formulário | 1min 30s |
| Recepção GET | 1min |
| Página Sobre | 1min |
| Conclusão | 30s |
| **TOTAL** | **6min** |

*Nota: Ajuste os tempos para ficar dentro de 5 minutos, reduzindo alguns segundos em cada parte se necessário.*

---

## 💡 DICAS PARA A GRAVAÇÃO

1. **Prepare o ambiente:**
   - Tenha todas as páginas abertas no navegador
   - Tenha os arquivos de código abertos no editor
   - Teste tudo antes de gravar

2. **Durante a gravação:**
   - Fale de forma clara e pausada
   - Use o cursor para destacar o código que está explicando
   - Faça zoom no código quando necessário
   - Demonstre as funcionalidades ao vivo

3. **Edição:**
   - Corte pausas longas
   - Adicione transições suaves entre as partes
   - Certifique-se de que o áudio está claro

---

**Boa sorte com a defesa! 🎉**

