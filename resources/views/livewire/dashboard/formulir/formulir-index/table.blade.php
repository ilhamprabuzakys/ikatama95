 <!--begin::Table-->
 <div class="table-responsive">
    <table class="table border-left align-middle table-row-dashed border-right" id="kt_table_formulirs">
       <thead class="bg-secondary-subtle">
          <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
             <th class="w-10px ps-3">
                <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                   <input class="form-check-input" type="checkbox" data-kt-check="true"
                      wire:click='setAllTarget()' wire:model='allTarget'
                      data-kt-check-target="#kt_table_formulirs .form-check-input" value="1" />
                </div>
             </th>
             <th class="min-w-125px">No</th>
             <th class="min-w-125px">Foto</th>
             <th class="min-w-125px">Nama</th>
             <th class="min-w-125px">NRP</th>
             <th class="min-w-125px">Pangkat</th>
             <th class="min-w-125px">Timestamp</th>
             <th class="text-center min-w-100px">Aksi</th>
          </tr>
       </thead>
       <tbody class="text-gray-600 fw-semibold">
          @forelse ($surveys as $survey)
             <tr class="">
                <td class="ps-3">
                   <div class="form-check form-check-sm form-check-custom form-check-solid">
                      <input class="form-check-input" type="checkbox" wire:model.live='downloadTarget' value="{{ $survey->id }}" />
                   </div>
                </td>
                <td scope="row">{{ $loop->iteration + $paginate * ($surveys->currentPage() - 1) }}</td>

                <td>
                   <div class="symbol symbol-50px symbol-circle">
                      @if ($survey->foto_terkini)
                         @if (Str::startsWith($survey->foto_terkini, 'https://drive.google.com'))
                            <?php
                            $id = Str::after($survey->foto_terkini, 'https://drive.google.com/open?id=');
                            $driveURL = 'https://drive.google.com/uc?export=view&id=' . $id;
                            ?>
                            <div class="symbol-label" style="background-image:url({{ $driveURL }})"></div>
                         @else
                            <div class="symbol-label" style="background-image:url({{ asset($survey->foto_terkini) }})"></div>
                         @endif
                      @else
                         {{-- Tampilkan sesuatu jika tidak ada foto, atau biarkan kosong jika tidak ada yang perlu ditampilkan --}}
                      @endif
                      {{-- <div class="symbol-label" style="background-image:url({{ asset($survey->foto_terkini) }})"></div> --}}
                   </div>
                </td>
                <td>{{ $survey->nama }}</td>
                <td>{{ $survey->nrp }}</td>
                <td class="fw-bold">{{ $survey->pangkat }}</td>
                <td>{{ Carbon\Carbon::parse($survey->timestamp)->format('d/m/Y H:i:s') }}</td>
                <td class="text-center">
                   <a href="{{ route('download.pdf', $survey->id) }}" class="btn btn-sm btn-primary btn-clean btn-icon btn-icon-md">
                      <i class="fa-solid fa-print"></i>
                   </a>
                   <a href="{{ route('preview.formulir', $survey->id) }}" target="_blank" class="btn btn-sm btn-light-success btn-clean btn-icon btn-icon-md mx-1">
                      <i class="fa fa-eye"></i>
                   </a>
                   <a href="javascript:void(0);" wire:click="deleteConfirmation({{ $survey->id }})" class="btn btn-sm btn-danger btn-clean btn-icon btn-icon-md">
                      <i class="fas fa-trash-alt"></i>
                   </a>
                </td>
             </tr>
          @empty
             <tr class="">
                <td colspan="8" class="text-center">
                   <h5 class="text-gray-700 my-3">Data pengisian masih kosong atau tidak ditemukan..</h5>
                </td>
             </tr>
          @endforelse
       </tbody>
    </table>
 </div>
 <!--end::Table-->
 <x-dashboard.table.pagination-detail :collection="$surveys" :paginate="$paginate" />
