<!-- Modal Blur -->
<div id="zoomInModal" class="modal fade zoomIn" tabindex="-1" aria-labelledby="zoomInModalLabel" aria-hidden="true"
  style="display: none;">
  <div class="modal-dialog modal-dialog-centered delete-modal">
      <div class="modal-content delete-modal-content">
          <div class="modal-header border-0 mt-2">
              <h5 class="modal-title" id="zoomInModalLabel">Delete Modal</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form id="deleteForm" method="POST">
              @csrf
              @method('DELETE')
              <div class="modal-body px-4 py-2">
                  <h5 class="fs-16">
                      Are you sure you want to delete <span id="delete_item"></span>?
                  </h5>
                  <p class="text-muted" id="delete_item_description"></p>
                  <input type="hidden" name="item_id" id="delete_item_id">
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-danger ">Delete</button>
              </div>
          </form>
      </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->