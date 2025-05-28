$(document).ready(function() {

    atsaukmesIzvade();

})

function atsaukmesIzvade(page = 1) {
    $.ajax({
        type: "POST",
        url: "./database_admin/atsaukmes_izvade.php",
        data: { page: page },
        dataType: "json",
        success: function(response) {
            if ($.trim(response.comments) === "") {
                $("#atsauksmes-rewiew-container").html("<h2>Nav nevienas atsaukmes!</h2>");
                $(".atsauksmes-button-container").html("");
            } else {
                $("#atsauksmes-rewiew-container").html(response.comments);
                AtsaukmesRenderPagination(response.totalPages, page);
            }
        },
        error: function(xhr) {
            $("#atsauksmes-rewiew-container").html("<h1>Kļūda: " + xhr.statusText + "</h1>");
        }
    });
}

function AtsaukmesRenderPagination(totalPages, currentPage) {
    let html = '';
    let maxButtons = 5;
    let start = Math.max(1, currentPage - 2);
    let end = Math.min(totalPages, start + maxButtons - 1);

    if (end - start < maxButtons - 1) { start = Math.max(1, end - maxButtons + 1); }
    for (let i = start; i <= end; i++) { html += `<button class="page-btn ${i === currentPage ? 'active' : ''}" data-page="${i}">${i}</button>`; }
    if (totalPages > end) { html += `<span>...</span><button class="page-btn" data-page="${totalPages}">${totalPages}</button>`;}

    $(".atsauksmes-button-container").html(html);
}

$(document).on("click", ".page-btn", function() {
    const page = $(this).data("page");
    atsaukmesIzvade(page);
});

$(document).ready(function() {
    atsaukmesIzvade(1);
});

//----------------------------------------------------Report izvade 

$(document).ready(function() {

    reportIzvade();

})

function reportIzvade(page = 1) {
    $.ajax({
        type: "POST",
        url: "./database_admin/report_izvade.php",
        data: { page: page },
        dataType: "json",
        success: function(response) {
            if ($.trim(response.comments) === "") {
                $("#report-rewiew-container").html("<h2>Nav nevienas atsaukmes!</h2>");
                $(".report-button-container").html("");
            } else {
                $("#report-rewiew-container").html(response.comments);
                reportRenderPagination(response.totalPages, page);
            }
        },
        error: function(xhr) {
            $("#report-rewiew-container").html("<h1>Kļūda: " + xhr.statusText + "</h1>");
        }
    });
}

function reportRenderPagination(totalPages, currentPage) {
    let html = '';
    let maxButtons = 5;
    let start = Math.max(1, currentPage - 2);
    let end = Math.min(totalPages, start + maxButtons - 1);

    if (end - start < maxButtons - 1) { start = Math.max(1, end - maxButtons + 1); }
    for (let i = start; i <= end; i++) { html += `<button class="page-btn ${i === currentPage ? 'active' : ''}" data-page="${i}">${i}</button>`; }
    if (totalPages > end) { html += `<span>...</span><button class="page-btn" data-page="${totalPages}">${totalPages}</button>`;}

    $(".report-button-container").html(html);
}

$(document).on("click", ".page-btn", function() {
    const page = $(this).data("page");
    reportIzvade(page);
});

$(document).ready(function() {
    reportIzvade(1);
});
