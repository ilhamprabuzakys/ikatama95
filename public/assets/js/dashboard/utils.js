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

// Utils Swal2
Livewire.on('swal:modal', data => {
   Swal.fire({
      title: data[0].title,
      html: data[0].text ?? data[0].message,
      icon: data[0].icon ?? data[0].type,
      confirmButtonText: 'Ok',
      timer: data[0].duration ?? 2500,
   })
});