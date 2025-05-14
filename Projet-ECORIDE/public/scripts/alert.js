const alertSuccess = document.querySelector('.alert-success');

if (alertSuccess) {
    const image = document.createElement('img')
    image.src = '../media/Icones_svg/Alert success.svg';
    image.alt = 'alert success'
    alertSuccess.appendChild(image);
}

const alertDanger = document.querySelector('.alert-danger');

if (alertSuccess) {
    const image = document.createElement('img')
    image.src = '{{ asset(\'/media/Icones_svg/Alert danger.svg\') }}';
    image.alt = 'alert success'
}