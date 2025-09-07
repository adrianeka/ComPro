@extends('admin.layouts')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit News</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <div class="fw-bold mb-2">Please fix the following errors:</div>
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @php
        $thumb = $news->thumbnail ? asset('storage/'.$news->thumbnail) : null;
        $publishedVal = old('published_at');
        if (!$publishedVal && $news->published_at) {
            try {
                $publishedVal = \Illuminate\Support\Carbon::parse($news->published_at)->format('Y-m-d\TH:i');
            } catch (\Exception $e) {
                $publishedVal = '';
            }
        }
    @endphp

    <form action="{{ route('admin.news.update', $news->id) }}" method="POST" enctype="multipart/form-data" class="card p-4">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Title <span class="text-danger">*</span></label>
            <input type="text" name="title" id="titleInput" class="form-control @error('title') is-invalid @enderror"
                   value="{{ old('title', $news->title) }}" required>
            @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
            <small class="text-muted d-block mt-1">
                Current slug: <code>{{ $news->slug }}</code>
                <span class="ms-2">Preview new slug: <code id="slugPreview">{{ \Illuminate\Support\Str::slug(old('title', $news->title)) }}</code></span>
            </small>
        </div>

        <div class="mb-3">
            <label class="form-label">Thumbnail</label>
            <input type="file" name="thumbnail" accept=".jpg,.jpeg,.png"
                   class="form-control @error('thumbnail') is-invalid @enderror" id="thumbInput">
            @error('thumbnail') <div class="invalid-feedback">{{ $message }}</div> @enderror
            <div class="mt-2 d-flex align-items-center gap-3">
                @if($thumb)
                    <div>
                        <div class="text-muted small mb-1">Current</div>
                        <img src="{{ $thumb }}" class="img-thumbnail" style="width: 160px; height: 160px; object-fit: cover;" alt="Current Thumbnail">
                    </div>
                @endif
                <div>
                    <div class="text-muted small mb-1">New (preview)</div>
                    <img id="thumbPreview" class="img-thumbnail d-none" style="width: 160px; height: 160px; object-fit: cover;" alt="New Preview">
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Excerpt</label>
            <textarea name="excerpt" rows="3" class="form-control @error('excerpt') is-invalid @enderror">{{ old('excerpt', $news->excerpt) }}</textarea>
            @error('excerpt') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Content <span class="text-danger">*</span></label>
            <textarea name="content" id="contentEditor" rows="10" class="form-control @error('content') is-invalid @enderror">{{ old('content', $news->content) }}</textarea>
            @error('content') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Published At</label>
                <input type="datetime-local" name="published_at" class="form-control @error('published_at') is-invalid @enderror"
                       value="{{ $publishedVal }}">
                @error('published_at') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="mt-4 d-flex gap-2">
            <a href="{{ route('admin.news.index') }}" class="btn btn-outline-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
// Slug preview from title
function slugify(str) {
    return str
        .toString()
        .normalize('NFD').replace(/[\u0300-\u036f]/g, '')
        .toLowerCase()
        .replace(/[^a-z0-9\s-]/g, '')
        .trim()
        .replace(/\s+/g, '-')
        .replace(/-+/g, '-');
}
document.getElementById('titleInput').addEventListener('input', function() {
    document.getElementById('slugPreview').textContent = slugify(this.value);
});

// New thumbnail preview
document.getElementById('thumbInput').addEventListener('change', function(e) {
    const file = e.target.files?.[0];
    const img = document.getElementById('thumbPreview');
    if (file) {
        img.src = URL.createObjectURL(file);
        img.classList.remove('d-none');
    } else {
        img.src = '';
        img.classList.add('d-none');
    }
});
</script>
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
<script>
ClassicEditor.create(document.querySelector('#contentEditor'), {
    toolbar: {
        items: [
            'heading','|','bold','italic','link','bulletedList','numberedList','blockQuote','insertImage','insertTable','undo','redo'
        ]
    },
    ckfinder: {
        uploadUrl: '{{ route("admin.ckeditor.upload") }}?_token={{ csrf_token() }}'
    },
    image: {
        toolbar: ['imageStyle:inline','imageStyle:block','imageStyle:side','|','toggleImageCaption','imageTextAlternative']
    }
}).catch(console.error);
</script>
@endpush