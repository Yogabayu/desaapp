<div class="dropdown d-inline-block">
    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        Aksi
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" href="{{ route('articles.edit', $article->slug) }}">Edit</a>
        <a class="dropdown-item" href="{{ route('articles.show', $article->slug) }}">View</a>
        <a class="dropdown-item" href="#" onclick="deleteArticle('{{ $article->slug }}')">Delete</a>
    </div>
</div>
