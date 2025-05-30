document.addEventListener("DOMContentLoaded", function () {
    const checkboxes = document.querySelectorAll('input[type="checkbox"][id^="feature-"]');

    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            const label = document.querySelector(`label[for="${checkbox.id}"]`);
            if (label) {
                if (checkbox.checked) {
                    label.classList.add('active');
                } else {
                    label.classList.remove('active');
                }
            }
        });
    });
});


const maxChars = 5000;

function handleInput() {
    const editableDiv = document.getElementById("car-description");
    const placeholder = document.getElementById("placeholder");
    const counter = document.getElementById("char-count");

    let text = editableDiv.innerText || editableDiv.textContent;
    text = text.trim();

    if (text.length > maxChars) {
        const selection = window.getSelection();
        const range = document.createRange();

        editableDiv.innerText = text.slice(0, maxChars);

        range.selectNodeContents(editableDiv);
        range.collapse(false);
        selection.removeAllRanges();
        selection.addRange(range);
    }

    const updatedText = editableDiv.innerText.trim();
    counter.textContent = `${updatedText.length} / ${maxChars}`;
    counter.style.color = updatedText.length >= maxChars ? "red" : "black";

    placeholder.style.display = updatedText.length === 0 ? "block" : "none";
}

document.addEventListener("DOMContentLoaded", handleInput);

function toggleFormat(command) {
    document.execCommand(command);
}

function toggleHeading(tag) {
    const selection = window.getSelection();
    if (!selection.rangeCount) return;

    const range = selection.getRangeAt(0);
    let parent = range.commonAncestorContainer;

    while (parent && parent.nodeType !== 1) {
        parent = parent.parentNode;
    }

    if (parent && parent.tagName && parent.tagName.toLowerCase() === tag.toLowerCase()) {
        document.execCommand('formatBlock', false, 'p');
    } else {
        document.execCommand('formatBlock', false, `<${tag}>`);
    }
}

