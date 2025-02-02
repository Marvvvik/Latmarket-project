const katboxes = document.querySelectorAll('.searchbox .box');
const carboxes = document.getElementById('carbox');
const darbbox = document.getElementById('darbbox');
const nekustbox = document.getElementById('nekustbox');
const celtbox = document.getElementById('celtbox');
const elektrobox = document.getElementById('elektrobox');
const drebbox = document.getElementById('drebbox');
const majbox = document.getElementById('majbox');
const triangle = document.querySelector('.triangle');


function removeActiveClass() {
    katboxes.forEach(box => {
        box.classList.remove('active');
    });
}


katboxes.forEach((box, index) => {
    box.addEventListener('click', () => {

        removeActiveClass();
        box.classList.add('active');

        if (index === 0) {

            carboxes.classList.add('active');
            triangle.style.left = "5%";

        } else {

            carboxes.classList.remove('active');

        } 

        if (index === 1) {

            darbbox.classList.add('active');
            triangle.style.left = "16%";

        } else {

            darbbox.classList.remove('active');

        }

        if (index === 2) {

            nekustbox.classList.add('active');
            triangle.style.left = "30%";

        } else {

            nekustbox.classList.remove('active');

        }

        if (index === 3) {

            celtbox.classList.add('active');
            triangle.style.left = "42.5%";

        } else {

            celtbox.classList.remove('active');

        }
        
        if (index === 4) {

            elektrobox.classList.add('active');
            triangle.style.left = "53.5%";


        } else {

            elektrobox.classList.remove('active');

        }

        if (index === 5) {

            drebbox.classList.add('active');
            triangle.style.left = "63%";


        } else {

            drebbox.classList.remove('active');

        }

        if (index === 6) {

            majbox.classList.add('active');
            triangle.style.left = "69.9%";


        } else {

            majbox.classList.remove('active');

        }

    });
});