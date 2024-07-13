<!-- Modal -->
<div class="modal fade" id="createTodoModal" tabindex="-1" aria-labelledby="createTodoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createTodoModalLabel">Add Todo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form id="create_todo" action="{{ route('todo.store') }}" method="POST">
                    @csrf
                    <div class="mt-3 input-wrapper">
                        <x-input-label for="title" :value="__('Enter Title')" />
                        <x-text-input id="title" type="text" name="title" :value="old('title')" placeholder="Enter Title" />
                    </div>
                    <span class="text-danger" id="err_title"></span>
                    <div class="mt-3 input-wrapper">
                        <x-input-label for="task" :value="__('Enter Todo Tasks')" />
                        <x-text-input id="task" type="text" name="task[]" :value="old('task')" placeholder="Enter Task" />
                    </div>
                    <span class="text-danger" id="err_task.0"></span>
                    <div class="mt-3">
                        <div class="d-flex justify-content-end mt-2">
                            <button type="button" class="add-more-btn btn btn-sm btn-outline-dark p-1 fs12">
                                Add More
                                <i class="fa fa-plus-circle fa-fw"></i>
                            </button>
                        </div>
                    </div>
                    <div class="todo-tasks-wrapper"></div>
                    <hr>
                    <div class="d-grid">
                        <x-primary-button>
                            {{ __('Add Todo List') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editTodoModal" tabindex="-1" aria-labelledby="editTodoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTodoModalLabel">Edit Todo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form id="edit_todo" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="mt-3 input-wrapper">
                        <x-input-label for="title" :value="__('Enter Title')" />
                        <x-text-input id="title" type="text" name="title" :value="old('title')" placeholder="Enter Title" />
                    </div>
                    <span class="text-danger" id="err_title"></span>
                    <div class="mt-3">
                        <x-input-label for="task" :value="__('Enter Todo Tasks')" />
                        <x-text-input id="task" type="text" name="task[]" :value="old('task')" placeholder="Enter Task" />
                    </div>
                    <span class="text-danger" id="err_task.0"></span>
                    <div class="mt-3">
                        <div class="d-flex justify-content-end mt-2">
                            <button type="button" class="add-more-btn btn btn-sm btn-outline-dark p-1 fs12">
                                Add More
                                <i class="fa fa-plus-circle fa-fw"></i>
                            </button>
                        </div>
                    </div>
                    <div class="todo-tasks-wrapper"></div>
                    <hr>
                    <div class="d-grid">
                        <x-primary-button>
                            {{ __('Update Todo List') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.all.min.js"></script>
<script src="{{ asset('assets/js/toastr.min.js') }}"></script>

<script>
    $(document).ready(function() {
        window.toastr = toastr;

        const processFormData = (url, formData, formId, modalName, reload = true) => {
            $.ajax({
                url: url,
                method: 'POST',
                data: formData,
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    $("span.text-danger").each(function(index, element) {
                        $(element).html('');
                    });
                },
                success: function(response) {
                    $('#' + modalName).modal('hide');
                    toastr.success(response.message, {
                        timeOut: 500
                    });
                    if (reload == true) {
                        setTimeout(function() {
                            window.location.reload();
                        }, 500);
                    }
                    $('#' + formId).trigger('reset');
                },
                error: function(response) {
                    let inputErrors = $(':input');
                    $.each(inputErrors, function(index, field) {
                        $(field).removeClass('border-red');
                    });
                    $.each(response.responseJSON.errors, function(field, error) {
                        console.log(field);
                        const errorDiv = $('#' + formId + ' #err_' + field.replace(/\./g, '\\.'));
                        const errorInput = $(errorDiv).prev('.input-wrapper').find('input');
                        if (errorDiv.length > 0) {
                            errorDiv.html(error);
                        }
                        if (errorInput.length > 0) {
                            errorInput.addClass('border-red');
                        }
                    });
                },
                complete: function(response) {
                }
            });
        }

        $('.add-more-btn').click(function() {
            const taskIndex = $('.todo-tasks-wrapper .input-wrapper').length;
            const newDiv = `
            <div class="mt-3">
                <div class="mt-3 input-wrapper">
                    <x-text-input id="task" type="text" name="task[]" :value="old('task')" placeholder="Enter Task" />
                </div>
                <span class="text-danger" id="err_task.${taskIndex}"></span>
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

        $('.todo-tasks-wrapper').on('click', '.add-more-btn', function() {
            const taskIndex = $('.todo-tasks-wrapper .input-wrapper').length;
            const newDiv = `
            <div class="mt-3">
                <div class="mt-3 input-wrapper">
                    <x-text-input id="task" type="text" name="task[]" :value="old('task')" placeholder="Enter Task" />
                </div>
                <span class="text-danger" id="err_task.${taskIndex}"></span>
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
            $(this).closest('.mt-3').after(newDiv);
        });

        $('.todo-tasks-wrapper').on('click', '.delete-todo-btn', function() {
            $(this).closest('.mt-3').remove();
        });

        $('body').on('submit', '#create_todo', function(event) {
            event.preventDefault();
            const url = $(this).attr('action');
            const formData = new FormData(this);
            const formId = $(this).attr('id');
            const modalName = 'createTodoModal';
            processFormData(url, formData, formId, modalName);
        });

        $('body').on('submit', '#edit_todo', function(event) {
            event.preventDefault();
            const url = $(this).attr('action');
            const formData = new FormData(this);
            const formId = $(this).attr('id');
            const modalName = 'editTodoModal';
            processFormData(url, formData, formId, modalName);
        });

    });
</script>
