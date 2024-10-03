<span class="text-gray-400">
  @if ($items->currentPage() === 1)
    Menunjukkan {{ $items->count() === 0 ? '0' : '1' }} sampai {{ count($items) }} baris dari {{ $items->total() }} baris
  @else
    Menunjukkan {{ ($items->currentPage() - 1) * $items->perPage() + 1 }} sampai
    {{ min($items->currentPage() * $items->perPage(), $items->total()) }} baris dari {{ $items->total() }} baris
  @endif
</span>