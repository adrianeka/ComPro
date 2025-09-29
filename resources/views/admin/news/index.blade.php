@extends('admin.layouts')
@section('content')
<div class="container">
    <h2>Manage News</h2>
    <a href="{{ route('admin.news.create') }}" class="btn btn-primary mb-3">Add News</a>
    <div class="table-responsive">
        <table class="table table-bordered w-100" id="posts-table">
            <thead>
                <tr>
                    <th>Thumbnail</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Excerpt</th>
                    <th>Author</th>
                    <th>Published At</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<form id="deleteForm" method="POST" class="d-none">
    @csrf
    @method('DELETE')
</form>
@endsection

@push('styles')
<style>
    /* Hindari patah baris di kolom Actions */
    td.dt-actions {
        white-space: nowrap;
    }
    /* Sedikit rapikan gambar */
    #posts-table td img.img-thumbnail {
        width: 80px; height: 80px; object-fit: cover;
    }
</style>
@endpush

@push('scripts')
<script>
$(function() {
    $('#posts-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("admin.news.index") }}',
        columns: [
            { data: 'thumbnail', name: 'thumbnail', render: function(data) {
                return data ? `<img src="/${data}" width="80" class="img-thumbnail">` : '-';
            }},
            { data: 'title', name: 'title' },
            { data: 'slug', name: 'slug' },
            { data: 'excerpt', name: 'excerpt', render: function(data) {
                return data ? data.substring(0, 60) + (data.length > 60 ? "..." : "") : "-";
            }},
            { data: 'author', name: 'author' },
            { data: 'published_at', name: 'published_at' },
            { data: 'created_at', name: 'created_at' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });
});

function submitDelete(btn) {
    if (confirm('Hapus data ini?')) {
        const form = document.getElementById('deleteForm');
        form.action = btn.getAttribute('data-delete-url');
        form.submit();
    }
}
</script>
@endpush