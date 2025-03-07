function toggleTheme() {
    const html = document.documentElement;
    const isDark = html.classList.toggle("dark"); // Toggle kelas "dark" di <html>

    // Simpan preferensi ke localStorage
    localStorage.setItem("theme", isDark ? "dark" : "light");
}

// Terapkan tema yang tersimpan saat halaman dimuat
document.addEventListener("DOMContentLoaded", () => {
    const savedTheme = localStorage.getItem("theme") || "light";

    if (savedTheme === "dark") {
        document.documentElement.classList.add("dark");
    } else {
        document.documentElement.classList.remove("dark");
    }
});
