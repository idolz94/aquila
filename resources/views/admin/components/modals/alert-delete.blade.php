<div class="modal fade" id="modal-danger" style="display: none;" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">{{ $headerText ?? '' }}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      {{-- <div class="modal-body">
        <p>One fine body…</p>
      </div> --}}
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Huỷ bỏ</button>
        <button type="button" class="btn btn-secondary yes-confirm"><i class="fas fa-save"></i> Đồng ý</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>