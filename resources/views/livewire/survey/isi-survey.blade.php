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
                  <a class="text-decoration-underline">Unduh Hasil Survey Anda</a>
                  <a class="badge bg-success badge-pill" style="cursor: pointer" href="{{ route('download.pdf', $survey_id) }}"><i class="fas fa-cloud-download"></i></a>
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
                  <span class="px-2 fw-bold">Anda sudah pernah mengisi survey ini sebanyak <span class="text-danger">{{ auth()->user()->surveyCount() }}</span>.</span>
                  <span class="px-2 mt-2 d-block">Apakah anda ingin mengisi kembali survey ini? <br>Jika anda mengisi kembali survey ini, maka data pengisian yang sebelumnya akan <span
                        class="fw-bold text-danger">dihapus</span>.</span>
                  <button class="btn btn-primary mt-3" id="releaseSurvey">
                     <i class="fas fa-check-double me-2"></i>Ya, saya ingin mengisi kembali survey ini.
                  </button>
               </div>
            @endif
         @endauth
         {{-- <div id="surveyContainer"></div> --}}
      </div>
      <!--end::Card body-->
   </div>

   <div id="surveyContainer"></div>

</div>

@push('scripts')
   {{-- <script src="{{ asset('assets/js/survey/konfigurasi.js') }}"></script> --}}
   @include('livewire.survey.js.konfigurasi-survey')
@endpush
