document.addEventListener("DOMContentLoaded", function () {
    const settingsBtn = document.getElementById("settingsToggle");
    const settingsDropdown = document.getElementById("settingsDropdown");
    const toggleNavbarFixed = document.getElementById("toggleNavbarFixed");
    const navbar = document.querySelector("nav[navbar-main]");

    // DEBUG cek elemen
    console.log({ toggleNavbarFixed, navbar });

    // Amanin kalau checkbox belum ada
    if (!toggleNavbarFixed || !navbar) return;

    // Toggle dropdown settings
    settingsBtn?.addEventListener("click", () => {
        settingsDropdown?.classList.toggle("hidden");
    });

    document.addEventListener("click", function (e) {
        if (
            !settingsBtn?.contains(e.target) &&
            !settingsDropdown?.contains(e.target)
        ) {
            settingsDropdown?.classList.add("hidden");
        }
    });

    const savedFixed = localStorage.getItem("navbarFixed");
    if (savedFixed === "true") {
        toggleNavbarFixed.checked = true;
        applyNavbarFixed(true);
    }

    toggleNavbarFixed.addEventListener("change", function (e) {
        const isChecked = e.target.checked;
        localStorage.setItem("navbarFixed", isChecked);
        applyNavbarFixed(isChecked);
    });

    function applyNavbarFixed(enable) {
        console.log("applyNavbarFixed jalan:", enable);
        if (enable) {
            navbar.classList.add(
                "fixed",
                "top-0",
                "left-0",
                "right-0",
                "z-50",
                "bg-white/80",
                "backdrop-blur-md",
                "dark:bg-slate-800/80"
            );
        } else {
            navbar.classList.remove(
                "fixed",
                "top-0",
                "left-0",
                "right-0",
                "z-50",
                "bg-white/80",
                "backdrop-blur-md",
                "dark:bg-slate-800/80"
            );
        }
    }
});
