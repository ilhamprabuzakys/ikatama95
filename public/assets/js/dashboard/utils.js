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

$(document).ready(function () {
   $('#print_profile_pdf').click(function (e) {
      e.preventDefault();

      $.ajax({
         url: '/cetak-dashboard-profile',
         method: 'GET',
         success: function (response) {
            if (response.status === 'success') {
               alert('PDF berhasil dicetak!');
            }
         },
         error: function (error) {
            console.error('Ada masalah:', error);
         }
      });
   });
});


if ($.fn.modal && $.fn.modal.Constructor && $.fn.modal.Constructor.prototype.show) {
   var originalModalShow = $.fn.modal.Constructor.prototype.show;
   $.fn.modal.Constructor.prototype.show = function () {
      // Panggil fungsi asli
      originalModalShow.apply(this, arguments);
   
      // Setelah modal terbuka, hapus elemen berlebih
      var modalBackdrops = $('.modal-backdrop.fade.show');
      for (var i = 1; i < modalBackdrops.length; i++) {
         $(modalBackdrops[i]).remove();
      }
   };
} 


document.querySelectorAll('label.required').forEach(function (label) {
   label.innerHTML += '<sup class="ms-1 text-danger">*</sup>';
});

document.querySelectorAll('label.optional').forEach(function (label) {
   label.innerHTML += '<span>(Opsional)</span>';
});

$('.modal').on('hidden.bs.modal', function () {
   Livewire.dispatch('closedModal');
   // console.log('====================================');
   // console.log('Modal closed');
   // console.log('====================================');
});
