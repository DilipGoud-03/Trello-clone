<div class="modal" id="createBoardModel" data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4>Create Board</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body"></div>
            <div id="container" class="container mt-1">
                <form id="multi-step-form" action="{{route('modalData')}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="boardName" class="form-label">Board Name:</label>
                        <input type="hidden" name="created_By" value=" {{Auth::user()->id}}">
                        <input type=" text" class="form-control @error('boardName') is-invalid @enderror" id="boardName" name="boardName">
                        @if ($errors->has('boardName'))
                        <small class="text-danger">{{ $errors->first('boardName')}}</small>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="decription" class="form-label">Board Description:</label>
                        <input type=" text" class="form-control @error('decription') is-invalid @enderror" id="decription" name="decription">
                    </div>
                    <div class="mb-3">
                        <button type="submit" onclick="" class="btn btn-success">Submit </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>