const darkToggle = document.querySelector('#dark-toggle');
const darkIcon = document.querySelector('#dark-icon');
const html = document.querySelector('html');

darkToggle.addEventListener("click", function() {
    if (darkToggle.checked) {
        html.classList.add('dark');
        localStorage.theme = 'dark';
        darkIcon.classList.replace('bx-sun', 'bx-moon');
    } else {
        html.classList.remove('dark');
        localStorage.theme = 'light';
        darkIcon.classList.replace('bx-moon', 'bx-sun');
    }
});

// Move Toggle Mode
if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia(
        '(prefers-color-scheme: dark)').matches)) {
    darkToggle.checked = true;
    darkIcon.classList.replace('bx-sun', 'bx-moon');
} else {
    darkToggle.checked = false;
    darkIcon.classList.replace('bx-moon', 'bx-sun');
}