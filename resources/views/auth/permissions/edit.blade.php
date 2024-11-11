<div class="modal fade" id="modal-edit{{ $permission->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ url('permissions/' . $permission->id) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PATCH')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Permission</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name" class="col-sm-4 mb-2 control-label">Permission</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control @error('name') is-inv    alid @enderror"
                                    name="name" value="{{ $permission->name }}" autocomplete="name" autofocus>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
