const errorList = {
    title: 'Il titolo non deve superare i 255 caratteri',
    rooms: 'Inserire un numero valido',
    beds: 'Inserire un numero valido',
    baths: 'Inserire un numero valido',
    meters: 'Inserire un numero valido',
    address: 'Inserire un indirizzo valido',
    price: 'Inserire un numero valido',
};

const form = document.getElementById('form');
const address = document.querySelector('.address');

if (form) {
    form.addEventListener('change', onChange);
    form.addEventListener('focusout', onFocusOut);
    address.addEventListener('change', checkAddress);
}

function onChange(e) {
    const el = e.target;

    if (el.id === 'image' || el.id === 'images') {
        checkSize(el);
    }
}

function onFocusOut(e) {
    const el = e.target;
    
    if (el.id === 'title' || 
        el.id === 'rooms' || 
        el.id === 'beds' || 
        el.id === 'baths' ||
        el.id === 'meters' ||
        el.id === 'price') {
        checkValue(el);
    }
}

function checkSize(el) {
    const id = el.id.concat('_error')
    const image_error = document.getElementById(id)    
    const files = [...el.files];
    files.every(image => {
        if(image.size > 2097152) {
            image_error.classList.remove('hidden')
            return false
        } else {
            image_error.classList.add('hidden')
        }
    });
}

function checkValue(el) {
    const id = el.id
    const wrapper = form.querySelector(`.${id}-wrapper`);
    const error = form.querySelector(`.${id}-error`);
    
    error.textContent = '';
    wrapper.classList.remove('text-red-700');
    el.classList.remove('border-red-700', 'border-2');

    if (!el.validity.valid) {
        error.textContent = errorList[id];
        wrapper.classList.add('text-red-700');
        el.classList.add('border-red-700', 'border-2');
    }
}

function checkAddress() {
    const wrapper = form.querySelector('.address-wrapper');
    const error = form.querySelector('.address-error');

    error.textContent = '';
    wrapper.classList.remove('text-red-700');
    this.classList.remove('border-red-700', 'border-2');

    if (!this.value) {
        error.textContent = errorList.address;
        wrapper.classList.add('text-red-700');
        this.classList.add('border-red-700', 'border-2');
    }
}