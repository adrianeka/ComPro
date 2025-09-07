<div class="btn-group btn-group-sm" role="group" aria-label="Actions">
    <a href="{{ route('admin.news.edit', $post->id) }}" class="btn btn-outline-warning">
        Edit
    </a>
    <button type="button"
            class="btn btn-outline-danger"
            data-delete-url="{{ route('admin.news.destroy', $post->id) }}"
            onclick="submitDelete(this)">
        Delete
    </button>
</div>