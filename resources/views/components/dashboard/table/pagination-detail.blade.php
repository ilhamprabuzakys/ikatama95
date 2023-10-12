@if ($collection->total() / $paginate > 1)
   <div class="row mt-3 ps-3">
      <div class="col-5">
         @php
            $startData = ($collection->currentPage() - 1) * $collection->perPage() + 1;
            $endData = min($startData + $collection->perPage() - 1, $collection->total());
         @endphp
         <span class="text-gray-600">Menampilkan {{ $startData }} sampai {{ $endData }} data dari total {{ $collection->total() }} data.</span>
      </div>

      <div class="d-flex justify-content-end col-7">
         {{ $collection->links() }}
      </div>
   </div>
@endif
