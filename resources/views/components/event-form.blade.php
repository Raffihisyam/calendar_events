<x-modal-action action="{{ $action }}">
    @if ($data->id)
        @method('put')
    @endif
    <div class="row">
        <div class="col-6">
            <div class="mb-3">
                <input type="text" name="start_date" value="{{ $data->start_date ?? request()->start_date }}"
                    class="form-control">
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <input type="text" name="end_date" value="{{ $data->end_date ?? request()->end_date }}"
                    class="form-control">
            </div>
        </div>
        <div class="col-12">
            <div class="mb-3">
                <textarea name="title" class="form-control">{{ $data->title }}</textarea>
            </div>
        </div>
        <div class="col-12">
            <div class="mb-3">
                <div class="form-check form-check-inline">
                    <input class="form-check-input"{{ $data->category == 'success' ? 'checked' : null }} type="radio"
                        name="category" id="category-success" value="success">
                    <label class="form-check-label" for="category-success">success</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" {{ $data->category == 'danger' ? 'checked' : null }} type="radio"
                        name="category" id="category-danger" value="danger">
                    <label class="form-check-label" for="category-danger">danger</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input"{{ $data->category == 'warning' ? 'checked' : null }} type="radio"
                        name="category" id="category-warning" value="warning">
                    <label class="form-check-label" for="category-warning">warning</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input"{{ $data->category == 'primary' ? 'checked' : null }} type="radio"
                        name="category" id="category-primary" value="primary">
                    <label class="form-check-label" for="category-primary">primary</label>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="mb-3">
                <button type="submit" name="delete" value="DELETE" class="btn btn-danger">DELETE</button>
            </div>
        </div>
    </div>
</x-modal-action>
