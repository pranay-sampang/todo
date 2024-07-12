<div class="row">
    @forelse($todoLists as $todo)
        <div class="col-lg-3">
            <div class="card mt-4">
                <div class="card-header d-flex justify-content-between">
                    <button type="button" class="edit-btn btn btn-sm btn-outline-dark me-2"
                        data-edit-btn="{{ $todo->id }}">
                        Edit
                        <i class="fa fa-pencil fa-fw"></i>
                    </button>
                    <button type="button" class="delete-btn btn btn-sm btn-outline-dark p-1 fs12"
                        data-delete-btn="{{ $todo->id }}">
                        Delete
                        <i class="fa fa-trash fa-fw"></i>
                    </button>
                </div>
                <div class="card-body text-wrap">
                    <div class="d-flex flex-row flex-nowrap justify-content-between align-items-center">
                        <h6 class="card-subtitle mb-2 text-muted fw-bold">{{ $todo->title }}</h6>
                        <p class="fs12 fw-light">{{ $todo->updated_at->format('F j, Y, h:i A') }}</p>
                    </div>
                    @foreach ($todo->todoTask as $task)
                        <div class="form-check">
                            <input class="form-check-input todo-check" type="checkbox" id="todo_check"
                                {{ $task->status == 'completed' ? 'checked' : '' }} data-todo-id={{ $task->id }}>
                            <label class="form-check-label fs14 {{ $task->status == 'completed' ? 'strike' : '' }}"
                                for="todo_check">
                                {{ $task->task }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @empty
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="text-center p-5 m-5">
                        <p>We did not find any result matched for you search.</p>
                    </div>
                </div>
            </div>
        </div>
    @endforelse
</div>
