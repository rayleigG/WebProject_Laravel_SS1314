<nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
    <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
        <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
    </a>
    <a href="#" class="sidebar-toggler flex-shrink-0">
        <i class="fa fa-bars"></i>
    </a>
    <form class="d-none d-md-flex ms-4">
        <input class="form-control border-0" type="search" placeholder="Search">
    </form>
    <div class="navbar-nav align-items-center ms-auto">
        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <i class="fa fa-envelope me-lg-2"></i>
                <span class="d-none d-lg-inline-flex">Message</span>
            </a>
            <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                <a href="#" class="dropdown-item">
                    <div class="d-flex align-items-center">
                        <img class="rounded-circle" src={{ url('admin/img/user.jpg') }} alt=""
                            style="width: 40px; height: 40px;">
                        <div class="ms-2">
                            <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                            <small>15 minutes ago</small>
                        </div>
                    </div>
                </a>
                <hr class="dropdown-divider">
                <a href="#" class="dropdown-item">
                    <div class="d-flex align-items-center">
                        <img class="rounded-circle" src={{ url('admin/img/user.jpg') }} alt=""
                            style="width: 40px; height: 40px;">
                        <div class="ms-2">
                            <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                            <small>15 minutes ago</small>
                        </div>
                    </div>
                </a>
                <hr class="dropdown-divider">
                <a href="#" class="dropdown-item">
                    <div class="d-flex align-items-center">
                        <img class="rounded-circle" src={{ url('admin/img/user.jpg') }} alt=""
                            style="width: 40px; height: 40px;">
                        <div class="ms-2">
                            <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                            <small>15 minutes ago</small>
                        </div>
                    </div>
                </a>
                <hr class="dropdown-divider">
                <a href="#" class="dropdown-item text-center">See all message</a>
            </div>
        </div>
        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <i class="fa fa-bell me-lg-2"></i>
                <span class="d-none d-lg-inline-flex">Notificatin</span>
            </a>
            <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                <a href="#" class="dropdown-item">
                    <h6 class="fw-normal mb-0">Profile updated</h6>
                    <small>15 minutes ago</small>
                </a>
                <hr class="dropdown-divider">
                <a href="#" class="dropdown-item">
                    <h6 class="fw-normal mb-0">New user added</h6>
                    <small>15 minutes ago</small>
                </a>
                <hr class="dropdown-divider">
                <a href="#" class="dropdown-item">
                    <h6 class="fw-normal mb-0">Password changed</h6>
                    <small>15 minutes ago</small>
                </a>
                <hr class="dropdown-divider">
                <a href="#" class="dropdown-item text-center">See all notifications</a>
            </div>
        </div>
        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <img class="rounded-circle me-lg-2" src={{ url('admin/img/user.jpg') }} alt=""
                    style="width: 40px; height: 40px;">
                <span class="d-none d-lg-inline-flex">{{ Auth::user()->name }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal">My Profile</a>
                <a href="/wp-admin/register" class="dropdown-item">Add New user</a>
                <a href="/wp-admin/logout" class="dropdown-item" role="button" type="submit">Log Out</a>
            </div>
        </div>
    </div>
</nav>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">User Profile</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container mt-5">
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-7">
                            <div class="card p-3 py-4">
                                <div class="text-center">
                                    <img src={{ url('admin/img/me.jpg') }} width="100" class="rounded-circle">
                                </div>
                                <div class="text-center mt-3">
                                    <span class="bg-secondary p-1 px-4 rounded text-white">Pro</span>
                                    <h5 class="mt-2 mb-0">Alexender Schidmt</h5>
                                    <span>UI/UX Designer</span>
                                    <div class="px-4 mt-1">
                                        <p class="fonts">Consectetur adipiscing elit, sed do eiusmod tempor incididunt
                                            ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                            exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
                                    </div>
                                    <ul class="social-list">
                                        <li><i class="fa fa-facebook"></i></li>
                                        <li><i class="fa fa-dribbble"></i></li>
                                        <li><i class="fa fa-instagram"></i></li>
                                        <li><i class="fa fa-linkedin"></i></li>
                                        <li><i class="fa fa-google"></i></li>
                                    </ul>
                                    <div class="buttons">
                                        <button class="btn btn-outline-primary px-4">Message</button>
                                        <button class="btn btn-primary px-4 ms-3">Contact</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <br>
                <br>
            </div>
        </div>
    </div>
</div>
