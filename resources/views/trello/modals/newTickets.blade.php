<div class="modal" id="createTickestModel" data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4>Create Tickets</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body"></div>
            <div id="container" class="container">
                <form id="multi-step-form">
                    @csrf
                    <div class="mb-3">
                        <label for="ticketsName" class="form-label">Tickets Name:</label>
                        <input type="hidden" name="created_by" name="created_by" value=" {{Auth::user()->id}}">
                        <input type=" text" class="form-control @error('ticketsName') is-invalid @enderror" id="ticketsName" name="ticketsName">
                        @if ($errors->has('ticketsName'))
                        <small class="text-danger">{{ $errors->first('ticketsName')}}</small>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="decription" class="form-label">Ticket Description:</label>
                        <input type=" text" class="form-control @error('decription') is-invalid @enderror" id="decription" name="decription">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-info">Submit </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>