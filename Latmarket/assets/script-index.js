document.addEventListener("DOMContentLoaded", function () {
    const mainGrid = document.querySelector('.category-grid');
    const allGroupGrids = document.querySelectorAll('.group-grid');


    const categoryMap = {
        "categoryTransport": "transportSection",
        "categoryDarbs": "DarbsSection",
        "categoryElektrotehnika": "ElektrotehnikaSection",
    };


    Object.keys(categoryMap).forEach(categoryId => {
        const card = document.getElementById(categoryId);
        if (card) {
            card.addEventListener("click", function () {

                mainGrid.classList.remove("active");
                allGroupGrids.forEach(grid => grid.classList.remove("active"));

                const groupId = categoryMap[categoryId];
                const targetGroup = document.getElementById(groupId);
                if (targetGroup) {
                    targetGroup.classList.add("active");
                }
            });
        }
    });

    document.querySelectorAll(".back-Button button").forEach(button => {
        button.addEventListener("click", () => {
            allGroupGrids.forEach(grid => grid.classList.remove("active"));
            mainGrid.classList.add("active");
        });
    });
});