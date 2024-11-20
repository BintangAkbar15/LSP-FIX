function openTab(evt, tabName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none"; // Menyembunyikan semua konten tab
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", ""); // Menghapus kelas aktif dari semua tab
    }
    document.getElementById(tabName).style.display = "block"; // Menampilkan konten tab yang dipilih
    evt.currentTarget.className += " active"; // Menambahkan kelas aktif pada tab yang dipilih
}