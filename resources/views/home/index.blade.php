<x-app-layout>

    @auth
    <div class="container-xl p-4">
        <div class="row g-4 mb-3">
            <div class="col-sm">
                <input type="text" class="form-control" id="search_todo" placeholder="Search Your Notes">
            </div>
            <div class="col-sm-auto">
                <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#createTodoModal">
                    New Todo
                    <i class="fa fa-plus-circle fa-fw"></i>
                </button>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="d-flex justify-content-between mb-2">
                    <p class="mb-0 fw-bold">Your Todos</p>
                    <p class="mb-0 fw-bold">Todo Lists: {{ count($todoLists) }}</p>
                </div>
            </div>
        </div>

        <div class="todo-wrapper">
            <div class="row">
                @forelse($todoLists as $todo)
                <div class="col-lg-3">
                    <div class="card mt-4">
                        <div class="card-header d-flex justify-content-between">
                            <button type="button" class="edit-btn btn btn-sm btn-outline-dark me-2" data-edit-btn="{{ $todo->id }}">
                                Edit
                                <i class="fa fa-pencil fa-fw"></i>
                            </button>
                            <button type="button" class="delete-btn btn btn-sm btn-outline-dark p-1 fs12" data-delete-btn="{{ $todo->id }}">
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
                                <input class="form-check-input todo-check" type="checkbox" id="todo_check" {{ $task->status == 'completed' ? 'checked' : '' }} data-todo-id={{ $task->id }}>
                                <label class="form-check-label fs14 {{ $task->status == 'completed' ? 'strike' : '' }}" for="todo_check">
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
                                <p>You don't have created any todo list.</p>
                                <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#newTaskModal">
                                    Create New Todo
                                    <i class="fa fa-plus-circle fa-fw"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </div>
    @else
    <div class="container-xl p-4">
        <div class="row cflex">
            <div class="col-lg-6 col-md-6">
                <h1 class="fw-bold">TO-DO LIST</h1>
                <p>
                    Welcome to a to-do list website which provides a user-friendly interface that
                    enables individuals to efficiently manage their tasks and deadlines. The website
                    should allow users to easily add, edit, and delete tasks.
                </p>
                <a href="{{ route('login') }}" type="button" class="create-btn btn btn-sm me-2">
                    Start creating now
                </a>
            </div>
            <div class="col-lg-6 col-md-6 cflex">
                <div class="bg-wrapper">
                    <img src="{{ asset('assets/images/bg.png') }}" alt="Todo">
                </div>
            </div>
        </div>
    </div>
    @endauth

    @push('scripts')
    <script>
        $(document).ready(function() {
            $('body').on('click', '.edit-btn', function(event) {
                let todoListId = $(this).attr('data-edit-btn');
                let url = "{{ route('todo-list.index', 'todoListId') }}";
                url = url.replace('todoListId', todoListId);
                $.ajax({
                    url: url,
                    method: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        $('#editTaskModal, #title').val(response[0].title);
                        $('#editTaskModal, #task').val(response[0].todo_task[0].task);
                        $('.todo-tasks-wrapper').empty();
                        let updateUrl = "{{ route('todo-list.update', 'todoListId') }}";
                        updateUrl = url.replace('todoListId', response[0].id);
                        $('#edit_todo').attr('action', updateUrl);
                        $('#todo_list_id').val(response[0].id)
                        $.each(response[0].todo_task.slice(1), function(index, value) {
                            let newDiv = `
                            <div class="mt-3">
                                <input type="text" name="task[]" value="${value.task}" class="form-control" id="title" placeholder="Enter Task">
                                <div class="d-flex justify-content-end mt-2">
                                    <button type="button" class="add-more-btn btn btn-sm btn-outline-dark p-1 fs12 me-2">
                                        Add More
                                        <i class="fa fa-plus-circle fa-fw"></i>
                                    </button>
                                    <button type="button" class="delete-todo-btn btn btn-sm btn-outline-dark p-1 fs12">
                                        Delete
                                        <i class="fa fa-trash fa-fw"></i>
                                    </button>
                                </div>
                            </div>`;
                            $('.todo-tasks-wrapper').append(newDiv);
                        });
                        $('#editTodoModal').modal('show');
                    }
                });
            });

            $('body').on('click', '.delete-btn', function(event) {
                event.preventDefault();
                let todoListId = $(this).attr('data-delete-btn');
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        let url = "{{ route('todo-list.destroy', 'todoListId') }}";
                        url = url.replace('todoListId', todoListId);
                        $.ajax({
                            url: url,
                            type: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            dataType: 'json',
                            success: function(data) {
                                if(data.status == 'success'){
                                    Swal.fire({
                                        title: "Deleted!",
                                        text: "Todo list has been deleted.",
                                        icon: "success"
                                    });
                                }else{
                                    Swal.fire({
                                        title: "Error!",
                                        text: "Something went wrong.",
                                        icon: "error"
                                    });
                                }
                                setTimeout(function() {
                                    window.location.reload();
                                }, 1500);
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                if (jqXHR.status == 404) {
                                    toastr.error(jqXHR.responseText, {
                                        timeOut: 4000
                                    });
                                }
                            }
                        });
                    }
                });
            });

            $('body').on('change', '.todo-check', function(event) {
                event.preventDefault();
                let todoId = $(this).attr('data-todo-id');
                let label = $(this).next('label');
                let checkboxStatus = this.checked;
                if(checkboxStatus){
                    label.addClass('strike');
                }else{
                    label.removeClass('strike');
                }
                let url = "{{ route('todo-task.update', 'todoId') }}";
                url = url.replace('todoId', todoId);
                $.ajax({
                    url: url,
                    type: 'PATCH',
                    data: {
                        _token: '{{ csrf_token() }}',
                        status: checkboxStatus ? 'completed' : 'pending'
                    },
                    success: function(response) {
                        console.log(response);
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });

            $('body').on('input', '#search_todo', function(event) {
                let searchValue = $(this).val();
                $.ajax({
                    url: "{{ route('todo-search') }}?query=" + searchValue,
                    method: 'GET',
                    beforeSend: function() {},
                    success: function(response) {
                        $('.todo-wrapper').html(response);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    },
                    complete: function() {}
                });
            });
        });
    </script>
    @endpush

</x-app-layout>
