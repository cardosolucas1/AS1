//Controle de menu
function setupMenu() {
    const navToggle = document.querySelector('.nav-toggle');
    const navList = document.getElementById('navList');
    if (navToggle && navList) {
        navToggle.addEventListener('click', function() {
            navList.classList.toggle('active');
            const isExpanded = navList.classList.contains('active');
            navToggle.setAttribute('aria-expanded', isExpanded);
        });
    }
}

// Valida formulario 
function setupFormValidation() {
    const form = document.getElementById('reservationForm');
    const phoneInput = document.getElementById('phone');
    if (!form) return; 

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

    const showValidationError = (input, message) => {
        const inputId = input.id || input.name;
        const errorElement = document.getElementById(`error${inputId.charAt(0).toUpperCase() + inputId.slice(1)}`);
        
        if (input.type !== 'radio') {
            input.classList.add('error');
        }

        if (errorElement) {
            errorElement.textContent = message;
        }
    };

    const clearValidationError = (input) => {
        if (input.type !== 'radio') {
            input.classList.remove('error');
        }
        const inputId = input.id || input.name;
        const errorElement = document.getElementById(`error${inputId.charAt(0).toUpperCase() + inputId.slice(1)}`);
        if (errorElement) {
            errorElement.textContent = '';
        }
        if (input.type === 'radio') {
             document.getElementById('errorPeriod').textContent = '';
        }
    };
    
    // bloqueia caracteres não numéricos no campo de telefone
    const blockNonNumerics = (event) => {
        if (event.key.length > 1 || event.metaKey || event.ctrlKey) {
            return;
        }
        
        // Testa se o caractere digitado NÃO é um dígito (0-9)
        if (!/\d/.test(event.key)) {
            event.preventDefault(); // Bloqueia a digitação
        }
    };

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
    
    // Aplicação dos Listeners no campo de telefone
    if (phoneInput) {
        // 1. Bloqueia a digitação de não-numéricos no momento da tecla
        phoneInput.addEventListener('keydown', blockNonNumerics); 
        // 2. Aplica a máscara (parênteses e hífen) a cada entrada
        phoneInput.addEventListener('input', maskPhone);
        
        // Define o tamanho máximo para evitar números extras
        phoneInput.setAttribute('maxlength', '15'); 
    }

    // Validação ao enviar o formulário
    form.addEventListener('submit', function(event) {
        event.preventDefault(); 

        let isValid = true;
        
        // Validação de TODOS os campos
        const fields = [
            { id: 'name', validator: validateName, msg: 'Nome deve ter pelo menos 3 caracteres.' },
            { id: 'phone', validator: validatePhone, msg: 'Telefone inválido (formato: (xx) xxxxx-xxxx).' },
            { id: 'email', validator: validateEmail, msg: 'E-mail inválido.' },
            { id: 'date', validator: validateDate, msg: 'A data deve ser igual ou posterior à hoje.' },
            { id: 'toy', validator: validateSelect, msg: 'Selecione um brinquedo.' }
        ];

        fields.forEach(field => {
            const input = document.getElementById(field.id);
            if (!field.validator(input.value)) {
                showValidationError(input, field.msg);
                isValid = false;
            } else {
                clearValidationError(input);
            }
        });

        // Validação Radio (Período)
        const periodInput = document.querySelector('input[name="period"]');
        if (!validateRadio('period')) {
            showValidationError(periodInput, 'Selecione um período de aluguel.');
            isValid = false;
        } else {
            document.getElementById('errorPeriod').textContent = '';
        }

        if (isValid) {
            form.submit();
        }
    });

    // Limpeza de erros dinamicamente
    document.querySelectorAll('.form-input').forEach(input => {
        input.addEventListener('input', function() {
            clearValidationError(this);
        });
    });
    document.querySelectorAll('input[name="period"]').forEach(radio => {
        radio.addEventListener('change', function() {
            document.getElementById('errorPeriod').textContent = '';
        });
    });
}

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


// Preenche automaticamente o campo de brinquedo se vier via GET
function setupAutoFillToy() {
    const toySelect = document.getElementById('toy');
    if (!toySelect) return;
    
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const toyParam = urlParams.get('toy');
    
    if (toyParam && toySelect) {
        toySelect.value = toyParam;
    }
}

// Inicializa todas as funções que devem rodar ao carregar a página
document.addEventListener('DOMContentLoaded', function() {
    setupMenu();
    setupFormValidation();
    setupGetParams();
    setupAutoFillToy();
});