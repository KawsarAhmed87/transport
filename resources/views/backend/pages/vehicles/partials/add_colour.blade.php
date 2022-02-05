<!-- Modal -->
<div class="modal fade" id="ColourModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add colour</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="storeColour" method="POST">
        @csrf
        <div class="modal-body">
          <input type="text" class="form-control" id="name" name="name"/>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="addColour">Submit</button>
        </form>
        </div>
      </div>
    </div>
  </div>