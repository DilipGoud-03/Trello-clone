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
                <form id="multi-step-form" action="{{ route('ticketsStore')}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <input type="hidden" name="created_by" name="created_by" value=" {{Auth::user()->id}}">
                        <label for="ticketsName" class="form-label">Tickets Name:</label>
                        <input type=" text" class="form-control @error('ticketsName') is-invalid @enderror" id="ticketsName" name="ticketsName" value="">
                        @if ($errors->has('ticketsName'))
                        <small class="text-danger">{{ $errors->first('ticketsName')}}</small>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="decription" class="form-label">Ticket Description:</label>
                        <input type=" text" class="form-control @error('decription') is-invalid @enderror" id="decription" name="decription" value="">
                    </div>
                    <div class="mb-3">
                        <label for="assinee" class="form-label">Assign user:</label>
                        <input type=" text" class="form-control" id="assinee" name="assinee" value="">
                    </div>
                    <div class="mb-3">
                        <button type="submit" onclick="$('#createTickestModel').modal({'data-bs-backdrop': 'static'});" class="btn btn-info">Submit </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>