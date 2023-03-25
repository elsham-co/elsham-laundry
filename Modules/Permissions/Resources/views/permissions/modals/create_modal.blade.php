<div class="modal fade" id="create_permission">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('Create Permission')}}</h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <form action="{{route('permissions.store')}}" method="POST" id="create_permission" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <!-- BEGIN Form Group -->

                    <div class="form-group mt-2">
                        <label for="name">{{__('Name En')}}</label>
                        <input type="text" id="name" class="form-control" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="name_ar">{{__('Name Ar')}}</label>
                        <input type="text" id="name_ar" class="form-control" name="name_ar" required autocomplete="off">
                    </div>


                    <!-- END Form Group -->
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary mr-2"
                            >{{__('Create')}}</button>
                    <button class="btn btn-outline-danger" data-dismiss="modal">{{__('Cancel')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@push('js')
<script>
//    $(document).ready(function () {
    $("#create_permission").attr("autocomplete", "off");
// })
</script>
 @endpush