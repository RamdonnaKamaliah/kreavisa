document.addEventListener("DOMContentLoaded", function () {
    const settingsBtn = document.getElementById("settingsToggle");
    const settingsDropdown = document.getElementById("settingsDropdown");
    const toggleNavbarFixed = document.getElementById("toggleNavbarFixed");
    const navbar = document.querySelector("nav[navbar-main]");

    if (!toggleNavbarFixed || !navbar) return;

    // Toggle dropdown settings
    settingsBtn.addEventListener("click", () => {
        settingsDropdown.classList.toggle("hidden");
    });

    // Sembunyikan dropdown saat klik di luar area
    document.addEventListener("click", function (e) {
        if (
            !settingsBtn.contains(e.target) &&
            !settingsDropdown.contains(e.target)
        ) {
            settingsDropdown.classList.add("hidden");
        }
    });

    // Cek localStorage apakah fixed aktif sebelumnya
    const savedFixed = localStorage.getItem("navbarFixed");
    if (savedFixed === "true") {
        toggleNavbarFixed.checked = true;
        navbar.classList.add("navbar-bg");
        handleScroll(); // Langsung aktifkan scroll handler
        window.addEventListener("scroll", handleScroll);
    }

    // Ketika toggle diubah
    toggleNavbarFixed.addEventListener("change", function (e) {
        const isChecked = e.target.checked;
        localStorage.setItem("navbarFixed", isChecked);
        if (isChecked) {
            navbar.classList.add("navbar-bg");
            handleScroll();
            window.addEventListener("scroll", handleScroll);
        } else {
            navbar.classList.remove("navbar-fixed-dashboard");
            navbar.classList.remove("navbar-bg");
            window.removeEventListener("scroll", handleScroll);
        }
    });

    // Fungsi menangani scroll behavior
    function handleScroll() {
        if (!toggleNavbarFixed.checked) return;

        if (window.scrollY > 10) {
            navbar.classList.add("navbar-fixed-dashboard");
        } else {
            navbar.classList.remove("navbar-fixed-dashboard");
        }
    }
});
