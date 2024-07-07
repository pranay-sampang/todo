<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Todo</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Figtree:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-0 py-3">
        <div class="container-xl">
            <a class="navbar-brand" href="#">
                Laravel Todo
            </a>
            <div class="navbar-nav ms-lg-auto">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 profile-menu">
                    <li class="nav-item dropdown">
                        <div class="d-flex justify-content-between">
                            <a href="#" type="button" class="login-btn btn btn-sm me-2">
                                Login
                            </a>
                            <a href="#" type="button" class="register-btn btn btn-sm p-1">
                                Register
                            </a>
                        </div>
                        {{-- <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <img class="rounded-circle header-profile-user" src="{{ asset('assets/images/admin.jpg') }}"
                                alt="Admin Image">
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="profileDropdown">
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="fa fa-user-o fa-fw"></i>
                                    Profile
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="fa fa-sign-out fa-fw"></i>
                                    Log Out
                                </a>
                            </li>
                        </ul> --}}
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-xl p-4">
        <div class="row g-4 mb-3">
            <div class="col-sm">
                <input type="text" class="form-control" placeholder="Search Your Notes">
            </div>
            <div class="col-sm-auto">
                <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#newTaskModal">
                    New Task
                    <i class="fa fa-plus-circle fa-fw"></i>
                </button>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="d-flex justify-content-between mb-2">
                    <p class="mb-0">Your Todo List</p>
                    <p class="mb-0">12 Todo Lists Found</p>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card mt-2">
                    <div class="card-header d-flex justify-content-between">
                        <button type="button" class="edit-btn btn btn-sm btn-outline-dark me-2">
                            Edit
                            <i class="fa fa-pencil fa-fw"></i>
                        </button>
                        <button type="button" class="delete-btn btn btn-sm btn-outline-dark p-1 fs12">
                            Delete
                            <i class="fa fa-trash fa-fw"></i>
                        </button>
                    </div>
                    <div class="card-body text-wrap">
                        <div class="d-flex flex-row flex-nowrap justify-content-between align-items-center">
                            <h6 class="card-subtitle mb-2 text-muted fw-bold">My Routine</h6>
                            <p class="fs12 fw-light">12 July, 2024</p>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="flexCheckDefault">
                            <label class="form-check-label fs14" for="flexCheckDefault">
                                Research
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="flexCheckDefault">
                            <label class="form-check-label fs14" for="flexCheckDefault">
                                Study
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="flexCheckDefault">
                            <label class="form-check-label fs14" for="flexCheckDefault">
                                Workout
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="flexCheckDefault">
                            <label class="form-check-label fs14" for="flexCheckDefault">
                                Brainstorming
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="flexCheckDefault">
                            <label class="form-check-label fs14" for="flexCheckDefault">
                                Tea Break
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="flexCheckDefault">
                            <label class="form-check-label fs14" for="flexCheckDefault">
                                Restart
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card mt-2">
                    <div class="card-header d-flex justify-content-between">
                        <button type="button" class="edit-btn btn btn-sm btn-outline-dark p-1 fs12 me-2">
                            Edit
                            <i class="fa fa-pencil fa-fw"></i>
                        </button>
                        <button type="button" class="delete-btn btn btn-sm btn-outline-dark p-1 fs12">
                            Delete
                            <i class="fa fa-trash fa-fw"></i>
                        </button>
                    </div>
                    <div class="card-body text-wrap">
                        <div class="d-flex flex-row flex-nowrap justify-content-between align-items-center">
                            <h6 class="card-subtitle mb-2 text-muted fw-bold">My Routine</h6>
                            <p class="fs12 fw-light">12 July, 2024</p>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="flexCheckDefault">
                            <label class="form-check-label fs14" for="flexCheckDefault">
                                Research
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="flexCheckDefault">
                            <label class="form-check-label fs14" for="flexCheckDefault">
                                Study
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="flexCheckDefault">
                            <label class="form-check-label fs14" for="flexCheckDefault">
                                Workout
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="flexCheckDefault">
                            <label class="form-check-label fs14" for="flexCheckDefault">
                                Brainstorming
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="flexCheckDefault">
                            <label class="form-check-label fs14" for="flexCheckDefault">
                                Tea Break
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="newTaskModal" tabindex="-1" aria-labelledby="newTaskModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newTaskModalLabel">Add Todo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label for="title" class="form-label">Enter Title</label>
                        <input type="email" class="form-control" id="title" placeholder="Enter Title">
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Enter Todo Tasks</label>
                        <input type="email" class="form-control" id="title" placeholder="Enter Task">
                        <div class="d-flex justify-content-end mt-2">
                            <button type="button" class="add-more-btn btn btn-sm btn-outline-dark p-1 fs12">
                                Add More
                                <i class="fa fa-plus-circle fa-fw"></i>
                            </button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <input type="email" class="form-control" id="title" placeholder="Enter Task">
                        <div class="d-flex justify-content-end mt-2">
                            <button type="button" class="delete-todo-btn btn btn-sm btn-outline-dark p-1 fs12">
                                Delete
                                <i class="fa fa-trash fa-fw"></i>
                            </button>
                        </div>
                    </div>
                    <hr>
                    <div class="mt-4">
                        <div class="d-flex justify-content-start">
                            <div class="col-sm-auto">
                                <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                                    data-bs-target="#newTaskModal">
                                    Add Todo List
                                    <i class="fa fa-plus-circle fa-fw"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
