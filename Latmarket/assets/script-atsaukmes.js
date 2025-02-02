document.addEventListener("DOMContentLoaded", function () {
    const textarea = document.querySelector(".textarea-long textarea");
    const counter = document.querySelector(".textarea-long .long");
    const maxLength = 1000;

    textarea.addEventListener("input", function () {
        const currentLength = textarea.value.length;
        counter.textContent = `${currentLength}/${maxLength}`;
    });
});
