// Valida formulario 
function setupFormValidation() {
    const form = document.getElementById('reservationForm');
    const phoneInput = document.getElementById('phone');
    if (!form) {
        console.warn('Formulário de reserva não encontrado');
        return;
    } 

    //Funçãos de validação
    const validateName = (name) => name.trim().length >= 3;
    
    //Padronização de caracteres numéricos e validação de formato
    const validatePhone = (phone) => {
        const cleanedPhone = phone.trim();
        // Aceita formato (xx) xxxxx-xxxx ou apenas números (mínimo 10 dígitos)
        const phoneRegex = /^(\(\d{2}\) \d{4,5}-\d{4}|\d{10,11})$/;
        // Se não passar no regex, verifica se tem pelo menos 10 dígitos numéricos
        if (!phoneRegex.test(cleanedPhone)) {
            const digitsOnly = cleanedPhone.replace(/\D/g, '');
            return digitsOnly.length >= 10 && digitsOnly.length <= 11;
        }
        return true;
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
        let isValid = true;
        
        // Limpa erros anteriores
        document.querySelectorAll('.error').forEach(el => el.classList.remove('error'));
        document.querySelectorAll('[id^="error"]').forEach(el => el.textContent = '');
        
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
            if (input) {
                const value = input.value.trim();
                if (!field.validator(value)) {
                    showValidationError(input, field.msg);
                    isValid = false;
                } else {
                    clearValidationError(input);
                }
            }
        });

        // Validação Radio (Período)
        if (!validateRadio('period')) {
            const errorPeriod = document.getElementById('errorPeriod');
            if (errorPeriod) {
                errorPeriod.textContent = 'Selecione um período de aluguel.';
                errorPeriod.style.display = 'block';
            }
            isValid = false;
        } else {
            const errorPeriod = document.getElementById('errorPeriod');
            if (errorPeriod) {
                errorPeriod.textContent = '';
            }
        }

        // Se não for válido, previne o envio e mostra erros
        if (!isValid) {
            event.preventDefault();
            event.stopPropagation();
            console.log('Formulário inválido, impedindo envio');
            console.log('Campos validados:', {
                name: document.getElementById('name')?.value,
                phone: document.getElementById('phone')?.value,
                email: document.getElementById('email')?.value,
                date: document.getElementById('date')?.value,
                toy: document.getElementById('toy')?.value,
                period: document.querySelector('input[name="period"]:checked')?.value
            });
            // Scroll para o primeiro erro
            const firstError = document.querySelector('.error') || document.querySelector('[id^="error"]');
            if (firstError) {
                firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                if (firstError.tagName === 'INPUT' || firstError.tagName === 'SELECT') {
                    firstError.focus();
                }
            }
            return false;
        }
        
        // Se for válido, permite o envio normal do formulário
        console.log('Formulário válido, permitindo envio');
        console.log('Dados do formulário:', {
            name: document.getElementById('name')?.value,
            phone: document.getElementById('phone')?.value,
            email: document.getElementById('email')?.value,
            date: document.getElementById('date')?.value,
            toy: document.getElementById('toy')?.value,
            period: document.querySelector('input[name="period"]:checked')?.value
        });
        // Não faz preventDefault, então o formulário será enviado normalmente
        return true;
    });

    // Limpeza de erros dinamicamente ao digitar
    const validationFields = [
        { id: 'name', validator: validateName, msg: 'Nome deve ter pelo menos 3 caracteres.' },
        { id: 'phone', validator: validatePhone, msg: 'Telefone inválido (formato: (xx) xxxxx-xxxx).' },
        { id: 'email', validator: validateEmail, msg: 'E-mail inválido.' },
        { id: 'date', validator: validateDate, msg: 'A data deve ser igual ou posterior à hoje.' },
        { id: 'toy', validator: validateSelect, msg: 'Selecione um brinquedo.' }
    ];
    
    validationFields.forEach(field => {
        const input = document.getElementById(field.id);
        if (input) {
            input.addEventListener('input', function() {
                clearValidationError(this);
            });
            input.addEventListener('blur', function() {
                // Validação em tempo real ao sair do campo
                if (this.value.trim() !== '') {
                    if (!field.validator(this.value)) {
                        showValidationError(this, field.msg);
                    } else {
                        clearValidationError(this);
                    }
                }
            });
        }
    });
    
    document.querySelectorAll('input[name="period"]').forEach(radio => {
        radio.addEventListener('change', function() {
            const errorPeriod = document.getElementById('errorPeriod');
            if (errorPeriod) {
                errorPeriod.textContent = '';
            }
        });
    });
    
    // Validação do select de brinquedo
    const toySelect = document.getElementById('toy');
    if (toySelect) {
        toySelect.addEventListener('change', function() {
            clearValidationError(this);
        });
    }
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
        'combo2': 'Combo Atividades 2'
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


function setupAboutPage() {
    for (let i = 1; i <= 3; i++) {
        const details = document.getElementById(`details${i}`);
        if (details) {
            details.style.display = 'none';
        }
    }
}

document.addEventListener('DOMContentLoaded', function() {
    try {
        setupFormValidation();
        setupGetParams();
        setupAutoFillToy();
        setupAboutPage();
        console.log('Scripts de validação carregados com sucesso');
    } catch (error) {
        console.error('Erro ao carregar scripts de validação:', error);
        // Mesmo com erro, o formulário ainda funciona com validação HTML5
    }
});
});