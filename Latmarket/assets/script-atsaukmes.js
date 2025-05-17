document.addEventListener("DOMContentLoaded", function () {
    const stars = document.querySelectorAll(".review__stars i");
    const ratingInput = document.getElementById("review-rating");

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
    const textarea = document.querySelector(".review__textarea-group textarea");
    const counter = document.querySelector(".review__textarea-group .review__char-limit");
    const maxLength = 800;

    textarea.addEventListener("input", function () {
        const currentLength = textarea.value.length;
        counter.textContent = `${currentLength}/${maxLength}`;
    });
});
