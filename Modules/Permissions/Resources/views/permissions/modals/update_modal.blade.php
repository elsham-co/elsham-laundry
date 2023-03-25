<div class="modal fade" id="edit_permission">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('update Permission')}}</h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <form action="" method="POST" id="update_permission">
                @method('PUT')
                @csrf
                <div class="modal-body">
                    <!-- BEGIN Form Group -->
                    <div class="form-group">
                        <label for="edit_name_ar">{{__('Name Ar')}}</label>
                        <input type="text" id="edit_name_ar"  class="form-control" name="name_ar" required>
                    </div>

                    <!-- END Form Group -->
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary mr-2"
                    >{{__('Update')}}</button>
                    <button class="btn btn-outline-danger" data-dismiss="modal">{{__('Cancel')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@push('js')
    <script>
        $(document).ready(function () {
            $(document).on('click','#update_per',function(e){
                e.preventDefault();
                var id = $(this).data('permission_id')
                var name = $(this).data('permission_name_ar')
                var url = '{{route('permissions.update','id')}}';
                url = url.replace('id',id)
                $("#edit_permission").find($("#update_permission")).attr('action',url)
                $("#edit_permission").find($("#edit_name_ar")).val(name)
            })
        })
    </script>
@endpush
