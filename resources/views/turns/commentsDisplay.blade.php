@foreach ($comments as $comment)
    <div class="card bg-light mb-3">
        <div class="card-body" @if ($comment->parent_id != null) style="margin-left:40px;" @endif>
            <div class="col">
                <p><strong>{{ $comment->user->name }}</strong> {{$comment->created_at->diffForHumans()}} </p>

            </div>
            <p>{{ $comment->text }}</p>
            @if ($comment->file)
                <div class="col text-end">
                    <a class="card-link btn btn-secondary" href="{{ asset("pdfs/{$comment->file->path}") }}"
                        target="_blank">{{ $comment->file->name }} <i class="far fa-file-pdf"></i></a>

                </div>
            @endif

            <a href="#collapse{{ $comment->id }}" data-bs-toggle="collapse" aria-expanded="false"
                aria-controls="collapse{{ $comment->id }}" id="reply">Responder</a>
            <div class="collapse" id="collapse{{ $comment->id }}">
                <form method="post" action="{{ route('comments.store') }}">
                    @csrf
                    <div class="form-group">
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Añadir comentario:" name="text" id="floatingTextarea">{{ old('text') }}</textarea>
                            <label for="floatingTextarea">Añadir comentario:</label>
                        </div>
                        <input type="hidden" name="turn_id" value="{{ $turn->id }}" />
                        <input type="hidden" name="parent_id" value="{{ $comment->id }}" />
                    </div>
                    <div class="form-group mb-3">
                        <input type="submit" class="btn btn-warning" value="Comentar" />
                    </div>
                </form>
            </div>
            @include('turns.commentsDisplay', ['comments' => $comment->replies])
        </div>
    </div>
@endforeach
