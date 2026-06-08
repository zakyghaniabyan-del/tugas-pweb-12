// assets/js/script.js
// === VALIDASI FORM REGISTER ===
function validasiRegister() {
 const nama = document.getElementById('name').value.trim();
 const email = document.getElementById('email').value.trim();
 const alamat = document.getElementById('address').value.trim();
 if (nama === '') {
 tampilkanError('nameError', 'Nama tidak boleh kosong!');
 return false;
 }
 if (!validEmail(email)) {
 tampilkanError('emailError', 'Format email tidak valid!');
 return false;
 }
 if (alamat.length < 10) {
 tampilkanError('addressError', 'Alamat minimal 10 karakter!');
 return false;
 }
 return true; // form boleh dikirim
}
// === VALIDASI EMAIL ===
function validEmail(email) {
 const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
 return re.test(email);
}
// === TAMPILKAN PESAN ERROR ===
function tampilkanError(idElemen, pesan) {
 const el = document.getElementById(idElemen);
 if (el) {
 el.textContent = pesan;
 el.style.display = 'block';
 }
}
// === KONFIRMASI HAPUS ===
function konfirmasiHapus(id) {
 if (confirm('Yakin ingin menghapus data ini?')) {
 window.location.href = 'hapus.php?id=' + id;
}
}
// === TOGGLE PASSWORD VISIBILITY ===
function togglePassword(idInput, idIcon) {
 const input = document.getElementById(idInput);
 const icon = document.getElementById(idIcon);
 if (input.type === 'password') {
 input.type = 'text';
 icon.textContent = '🙈';
 } else {
    input.type = 'password';
 icon.textContent = '👁️';
 }
}
// === AUTO HILANGKAN ALERT SETELAH 4 DETIK ===
document.addEventListener('DOMContentLoaded', function() {
 const alerts = document.querySelectorAll('.alert');
 alerts.forEach(function(alert) {
 setTimeout(function() {
 alert.style.opacity = '0';
 alert.style.transition = 'opacity 0.5s';
 setTimeout(() => alert.remove(), 500);
 }, 4000);
 });
});