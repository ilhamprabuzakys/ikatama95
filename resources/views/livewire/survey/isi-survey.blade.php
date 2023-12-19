<div>
   <div class="card" id="cardInformation">
      <!--begin::Card body-->
      <div class="card-body">
         <div id="hasilSurvey">
            <h4>Terimakasih telah mengisi Survey Ini.</h4>
            <hr class="mt-1 mb-2">
            <span class="px-2">Berikut hasil pengisian survey anda.</span>
            <ul class="list-group mt-3">
               <li class="list-group-item d-flex justify-content-between align-items-center">
                  <a class="text-decoration-underline" href="{{ $link_pdf ?? 'javascript:;' }}">Unduh Hasil Survey Anda</a>
                  <div wire:loading wire:target='generatePDF'>
                     <span class="spinner-border" role="status" aria-hidden="true"></span>
                     <span class="visually-hidden">Loading...</span>
                  </div>

                  {{-- <a class="badge bg-success badge-pill" id="text-loading" style="cursor: pointer" href="{{ 'javascript:;' }}">
                     <span class="me-2">Sedang mengkonversi hasil survey</span>
                  </a> --}}
                  <a class="badge bg-success badge-pill" id="text-hasil" style="cursor: pointer" href="{{ $link_pdf ?? 'javascript:;' }}">
                     <i class="fas fa-cloud-download"></i></a>

               </li>
            </ul>
         </div>
         @auth
            @if (auth()->user()->surveyCount() > 0 && $sudah_mengisi == false)
               <script>
                  $(document).ready(function() {
                     $("#surveyContainer").addClass('d-none');
                     $('#releaseSurvey').on('click', function() {
                        $("#surveyContainer").removeClass('d-none');
                        $("#pemberitahuanSurvey").addClass('d-none');
                        $("#cardInformation").addClass('d-none');
                     });
                  });
               </script>
               <div id="pemberitahuanSurvey">
                  <h4>Peringatan.</h4>
                  <hr class="mt-1 mb-2">
                  <div class="row d-flex justify-content-center align-items-start">
                     <div class="col-lg-8 col-sm-12">
                        <span class="px-2 fw-bold">Anda sudah pernah mengisi survey ini sebanyak <span class="text-danger">{{ auth()->user()->surveyCount() }}</span>.</span>
                        <span class="px-2 mt-2 d-block">Apakah anda ingin mengisi kembali survey ini? <br>Jika anda mengisi kembali survey ini, maka data pengisian yang sebelumnya akan <span
                              class="fw-bold text-danger">dihapus</span>.</span>
                        <button class="btn btn-primary mt-3" id="releaseSurvey">
                           <i class="fas fa-check-double me-2"></i>Ya, saya ingin mengisi kembali survey ini.
                        </button>
                     </div>
                     <div class="col-lg-4 col-sm-12">
                        <div class="text-lg-end text-sm-start">
                           <a class="btn btn-success mt-3" target="_blank" id="downloadHasil" href="{{ asset($link_pdf) ?? 'javascript:;' }}">
                              <i class="fas fa-file-download me-2"></i>Unduh Hasil Sebelumnya.
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
            @else
               <script>
                  $("#cardInformation").addClass('d-none');
               </script>
            @endif
         @else
            <script>
               $('#cardInformation').addClass('d-none');
            </script>
         @endauth
         {{-- <div id="surveyContainer"></div> --}}
      </div>
      <!--end::Card body-->
   </div>

   <div id="surveyContainer"></div>

</div>

@push('scripts')
   <script>
      $(document).ready(function() {

         
         Livewire.on('generating', () => {
            // Swal.fire({
            //    title: 'Mencetak Buku',
            //    html: 'Sedang mencoba mencetak buku anda...',
            //    allowOutsideClick: false,
            //    didOpen: () => {
            //       Swal.showLoading();
            //    }
            // }).then((result) => {
            //    if (result.dismiss === Swal.DismissReason.timer) {
            //       // console.log('Modal ditutup oleh timer');
            //    }
            // });
            $('#text-loading').removeClass('d-none');
            $('#text-hasil').addClass('d-none');
            console.log('generating pdf..');
         });
         Livewire.on('generated', () => {
            $('#text-loading').addClass('d-none');
            $('#text-hasil').removeClass('d-none');
            console.log('pdf was generated..');

            Swal.fire({
               title: "Berhasil!",
               text: "Buku alumni berhasil dicetak!",
               icon: "success"
            });
         });
      });
   </script>
   @include('livewire.survey.js.konfigurasi-survey')
@endpush
