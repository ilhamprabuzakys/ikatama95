<!--begin::Table-->
<div class="table-responsive">
   <table class="table  align-middle table-row-dashed border-right" id="kt_table_users" style="border: 1px solid #f1f1f1">
      <thead class="bg-secondary-subtle">
         <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
            <th class="w-10px ps-3">
               <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                  <input class="form-check-input" type="checkbox" data-kt-check="true" wire:click='setAllTarget()' wire:model='allTarget'
                     data-kt-check-target="#kt_table_users .form-check-input" value="1" />
               </div>
            </th>
            <th class="min-w-125px">No</th>
            <th class="min-w-125px">Nama</th>
            <th class="min-w-125px">Nama Pengguna</th>
            <th class="min-w-125px">Peranan</th>
            <th class="min-w-125px">Status</th>
            <th class="min-w-125px">Bergabung Pada</th>
            <th class="text-center min-w-100px">Aksi</th>
         </tr>
      </thead>
      <tbody class="text-gray-600 fw-semibold">
         @if ($users)
            @forelse ($users as $user)
               <tr class="">
                  <td class="ps-3">
                     <div class="form-check form-check-sm form-check-custom form-check-solid">
                        <input class="form-check-input" type="checkbox" wire:model.live='deleteTarget' value="{{ $user->id }}" />
                     </div>
                  </td>
                  <td scope="row">{{ $loop->iteration + $paginate * ($users->currentPage() - 1) }}</td>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->username }}</td>
                  <td>
                     <span class="badge badge-{{ getUserRoleBG($user->role) }}">{{ getUserRoleDetail($user->role) }}</span>
                  </td>
                  <td>
                     <span class="badge badge-light-{{ getUserStatusBG($user->is_active) }}">{{ getUserStatus($user->is_active) }}</span>
                  </td>
                  <td>{{ $user->created_at->diffForHumans() }}</td>
                  <td class="  text-center">
                     <a href="javascript:void(0);" class="btn btn-sm btn-success btn-clean btn-icon btn-md"
                        data-bs-toggle="modal"
                        data-bs-target="#editUserModal" wire:click="editUser({{ $user->id }})">
                        <i class="fas fa-edit"></i>
                     </a>
                    {{--  <a href="details/{{ $user->id }}" class="btn btn-sm btn-primary btn-clean btn-icon btn-icon-md">
                        <i class="fa-solid fa-circle-info"></i>
                     </a> --}}
                     @if ($user->id != auth()->id())
                        <a href="javascript:void(0);" wire:click="deleteConfirmation({{ $user->id }})" class="btn btn-sm btn-danger btn-clean btn-icon btn-icon-md">
                           <i class="fas fa-trash-alt"></i>
                        </a>
                     @endif
                  </td>
               </tr>
            @empty
               <tr class="">
                  <td colspan="8" class="text-center">
                     <h5 class="text-gray-700 my-3">Data tidak ditemukan atau data masih kosong..</h5>
                  </td>
               </tr>
            @endforelse
         @endif
      </tbody>
   </table>
</div>
<x-dashboard.table.pagination-detail :collection="$users" :paginate="$paginate" />
<!--end::Table-->
