
/* Livewire.hook('commit', ({
   component,
   commit,
   respond,
   succeed,
   fail
}) => {
   console.log('terjadi');
   // Block ketika request sedang terjadi
   $("[id$='-table']").block({
      message: '<div class="spinner-border text-primary" role="status"></div>',
      css: {
         backgroundColor: "transparent",
         border: "0"
      },
      overlayCSS: {
         backgroundColor: "#fff",
         opacity: 0.8
      }
   });

   // Jangan lupa menambahkan event listener untuk kasus error juga, untuk memastikan bahwa UI dibuka kembali
   // meskipun ada error yang terjadi
   fail(() => {
      $("[id$='-table']").unblock();
   });

   // Lepaskan block ketika request selesai
   respond(() => {
      $("[id$='-table']").unblock();
   });
}); */

Livewire.on('swal:modal', data => {
   if (data[0].duration) {
      if (data[0].duration == 'no') {
         // alert('no');
         Swal.fire({
            title: data[0].title,
            html: data[0].text,
            icon: data[0].icon,
            confirmButtonText: 'Ok',
            allowOutsideClick: false,
         });
      } else {
         Swal.fire({
            title: data[0].title,
            html: data[0].text,
            icon: data[0].icon,
            confirmButtonText: 'Ok',
            timer: data[0].duration ?? 3500,
            allowOutsideClick: false,
         });
      }
   } else {
      Swal.fire({
         title: data[0].title,
         html: data[0].text,
         icon: data[0].icon,
         confirmButtonText: 'Ok',
         timer: 3500,
         allowOutsideClick: false,
      });
   }
});

Livewire.on('swal:loading', data => {
   Swal.fire({
      title: 'Loading',
      html: 'Permintaan anda sedang diproses..',
      timer: 9000,
      timerProgressBar: true,
      allowOutsideClick: false,
      didOpen: () => {
         Swal.showLoading();
      }
   }).then((result) => {
      if (result.dismiss === Swal.DismissReason.timer) {
         // console.log('Modal ditutup oleh timer');
      }
   });
});

Livewire.on('swal:confirmation', data => {
   Swal.fire({
      title: 'Apakah kamu yakin?',
      text: "Data " + data[0].title + " yang dihapus akan dipindahkan ke keranjang sampah!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, saya yakin.',
      cancelButtonText: 'Batalkan.'
   }).then((result) => {
      if (result.isConfirmed) {
         Livewire.dispatch('deleteConfirmed'); // emit event
         Swal.fire(
            'Data Berhasil Dihapus!',
            'Data yang kamu pilih berhasil dihapus.',
            'success'
         )
      }
   });
});

Livewire.on('swal:bulkconfirmation', data => {
   Swal.fire({
      title: 'Apakah kamu yakin?',
      text: data[0].text ?? "Semua Data " + data[0].title + " yang kamu pilih akan dihapus!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, saya yakin.',
      cancelButtonText: 'Batalkan.'
   }).then((result) => {
      if (result.isConfirmed) {
         Livewire.dispatch('deleteConfirmedBulk'); // emit event
         Swal.fire(
            'Data Berhasil Dihapus!',
            'Semua data yang kamu pilih berhasil dihapus.',
            'success'
         )
      }
   });
});

Livewire.on('swal:filepond', data => {
   Swal.fire({
      title: 'Apakah kamu yakin?',
      text: "Data " + data[0].title + " yang dihapus akan benar2 dihapus kamu tidak dapat mengembalikan file tersebut!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, saya yakin.',
      cancelButtonText: 'Batalkan.'
   }).then((result) => {
      if (result.isConfirmed) {
         Livewire.dispatch('filepondDeleteConfirmed'); // emit event
         Swal.fire(
            'File Berhasil Dihapus!',
            'Data yang kamu pilih berhasil dihapus.',
            'success'
         )
      }
   });
});

Livewire.on('swal:postmedia', data => {
   Swal.fire({
      title: 'Apakah kamu yakin?',
      text: "Data " + data[0].title + " yang dihapus akan benar2 dihapus kamu tidak dapat mengembalikan file tersebut!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, saya yakin.',
      cancelButtonText: 'Batalkan.'
   }).then((result) => {
      if (result.isConfirmed) {
         Livewire.dispatch('mediaDeleteConfirmed'); // emit event
         Swal.fire(
            data[0].title + ' Berhasil Dihapus!',
            'Data yang kamu pilih berhasil dihapus.',
            'success'
         )
      }
   });
});

Livewire.on('swal:ebookpdf', data => {
   Swal.fire({
      title: 'Apakah kamu yakin?',
      text: "Data " + data[0].title + " yang dihapus akan benar2 dihapus kamu tidak dapat mengembalikan pdf tersebut!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, saya yakin.',
      cancelButtonText: 'Batalkan.'
   }).then((result) => {
      if (result.isConfirmed) {
         Livewire.dispatch('pdfDeleteConfirmed'); // emit event
         Swal.fire(
            data[0].title + ' Berhasil Dihapus!',
            'Data yang kamu pilih berhasil dihapus.',
            'success'
         )
      }
   });
});

Livewire.on('alert', data => {
   toastr.options = {
      "closeButton": false,
      "progressBar": false,
      "debug": false,
      "newest": true,
      "preventDuplicates": true,
      "positionClass": "toast-top-center",
      "timeOut": 2000,
   };

   // "showMethod": 'bounceIn',
   // "hideMethod": 'bounceOut',
   // "closeMethod": 'bounceOut',
   // "showEasing": 'swing',
   // "hideEasing": 'linear',
   // "closeEasing": 'linear',

   var message = data[0].message ?? data[0].text;
   var type = data[0].icon ?? data[0].type;
   var title = data[0].title;

   toastr[type](message, title);
});
