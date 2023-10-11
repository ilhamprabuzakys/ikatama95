Livewire.on('swal:modal', data => {
   Swal.fire({
      title: data[0].title,
      html: data[0].text,
      icon: data[0].icon,
      showConfirmButton: true,
      // confirmButtonText: 'Okay',
      timer: data[0].duration ?? 2500,
      timerProgressBar: true,
      allowOutsideClick: false,
   })
});