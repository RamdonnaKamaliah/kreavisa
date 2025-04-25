document.addEventListener("DOMContentLoaded", function () {
    const icon = document.getElementById("darkIcon");
    const root = document.documentElement;
    const toggle = document.getElementById("toggleDark");

    // Set tema awal dari localStorage
    const savedTheme = localStorage.getItem("theme");
    if (savedTheme === "dark") {
        root.classList.add("dark");
        icon.classList.replace("bx-sun", "bx-moon"); // Ganti ke sun untuk dark mode
    } else {
        root.classList.remove("dark");
        icon.classList.replace("bx-moon", "bx-sun"); // Ganti ke moon untuk light mode
    }

    toggle.addEventListener("click", () => {
        root.classList.toggle("dark");
        const isDark = root.classList.contains("dark");

        // Ganti ikon sesuai tema
        if (isDark) {
            icon.classList.replace("bx-sun", "bx-moon"); // Set sun untuk dark mode
            localStorage.setItem("theme", "dark");
        } else {
            icon.classList.replace("bx-moon", "bx-sun"); // Set moon untuk light mode
            localStorage.setItem("theme", "light");
        }
    });
});
