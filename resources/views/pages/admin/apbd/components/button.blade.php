<div class="dropdown d-inline-block">
    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        Aksi
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" href="{{ route('apbd.edit', $apbd->id) }}">Edit</a>
        <a class="dropdown-item" href="{{ route('apbd.show', $apbd->id) }}">View</a>
        <a class="dropdown-item" href="#" onclick="deleteApbd('{{ $apbd->id }}')">Delete</a>
    </div>
</div>
