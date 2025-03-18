document.addEventListener("DOMContentLoaded", function () {
    const stars = document.querySelectorAll(".stars i");
    const ratingInput = document.getElementById("rating-value");

    stars.forEach(star => {
        star.addEventListener("click", function () {
            let index = this.getAttribute("data-index");

            ratingInput.value = index;
            stars.forEach(s => s.classList.remove("active"));

            for (let i = 0; i < index; i++) {
                stars[i].classList.add("active");
            }
        });
    });
});


document.addEventListener("DOMContentLoaded", function () {
    const textarea = document.querySelector(".textarea-long textarea");
    const counter = document.querySelector(".textarea-long .long");
    const maxLength = 800;

    textarea.addEventListener("input", function () {
        const currentLength = textarea.value.length;
        counter.textContent = `${currentLength}/${maxLength}`;
    });
});


