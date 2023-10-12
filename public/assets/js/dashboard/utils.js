Livewire.on('reloadSurvey', () => {
   console.log('menginisaliasi survey kembali..')
   const elemen = document.querySelector('[routeName="formulir.create"]');
   // Menambahkan aksi klik ke elemen
   elemen.addEventListener('click', function () {
      // Lakukan sesuatu ketika elemen diklik
      console.log('Elemen diklik');
      // Anda dapat menambahkan kode lain di sini sesuai kebutuhan
   });
});