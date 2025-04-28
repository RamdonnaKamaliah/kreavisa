<footer class="mt-10 py-6 text-center text-sm text-gray-600 dark:text-gray-400">
  <p class="mb-2">
      &copy; {{ date('Y') }} <span class="font-semibold text-blue-600 dark:text-blue-400">Kreavisa</span>. All
      rights reserved.
  </p>
  <div class="flex justify-center space-x-4 text-sm">
      <a href="#" class="hover:underline hover:text-blue-500 dark:hover:text-blue-300 transition">Privacy
          Policy</a>
      <a href="#" class="hover:underline hover:text-blue-500 dark:hover:text-blue-300 transition">Terms</a>
      <a href="#" class="hover:underline hover:text-blue-500 dark:hover:text-blue-300 transition">Contact</a>
  </div>
</footer>


<!-- Tombol Back to Top -->
<button id="backToTop" class="hidden fixed bottom-4 right-4 bg-blue-500 text-white p-3 rounded-full shadow-lg hover:bg-blue-700 transition duration-200 z-50">
    <i class="bx bx-chevron-up text-2xl"></i>
</button>


<style>
/* Ini opsional kalau mau pastiin tombol hidden awalnya */
#backToTop {
    display: none;
}

</style>

<script>
    const backToTopBtn = document.getElementById("backToTop");

// Muncul setelah scroll 100px (2 kali scroll mouse kira-kira)
window.addEventListener("scroll", () => {
    if (window.scrollY > 100) {
        backToTopBtn.style.display = "block";
    } else {
        backToTopBtn.style.display = "none";
    }
});

// Scroll smooth ke atas saat tombol diklik
backToTopBtn.addEventListener("click", () => {
    window.scrollTo({
        top: 0,
        behavior: "smooth"
    });
});


</script>


