<?php global $user; ?>

<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #eeeeee; border-bottom: 1px solid #aaaaaa;">
    <div class="container-fluid">
        <a class="navbar-brand" href="?">
            <img src="assets/images/Rajasthan-Police-RAJ-Police.webp" alt="" height="28" style="filter: brightness(0.8);">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <div class="d-flex ms-lg-5 me-lg-auto">
                <input class="form-control me-2" type="search" id="search" placeholder="Looking for someone..." aria-label="Search" autocomplete="off" style="background-color: #eeeeee; border: 1px solid #aaaaaa;">
                <div class="bg-white text-end rounded border shadow py-3 px-4 mt-5" style="display:none;position:absolute;z-index:+99; background-color: #eeeeee;">
                    <button type="button" class="btn-close" aria-label="Close" id="close_search"></button>
                    <div id="sra" class="text-start">
                        <p class="text-center text-muted">Enter name or username</p>
                    </div>
                </div>
            </div>

            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link text-dark me-lg-3" href="?"><i class="bi bi-house-door-fill"></i> Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark me-lg-3" data-bs-toggle="modal" data-bs-target="#addpost" href="#"><i class="bi bi-plus-square-fill"></i> Add Post</a>
                </li>
                <li class="nav-item">
                    <?php
                    if (getUnreadNotificationsCount() > 0) {
                    ?>
                        <a class="nav-link text-dark position-relative me-lg-3" id="show_not" data-bs-toggle="offcanvas" href="#notification_sidebar" role="button" aria-controls="offcanvasExample">
                            <i class="bi bi-bell-fill"></i>
                            <span class="un-count position-absolute start-10 translate-middle badge p-1 rounded-pill bg-danger">
                                <small><?= getUnreadNotificationsCount() ?></small>
                            </span>
                        </a>
                    <?php
                    } else {
                    ?>
                        <a class="nav-link text-dark me-lg-3" data-bs-toggle="offcanvas" href="#notification_sidebar" role="button" aria-controls="offcanvasExample"><i class="bi bi-bell-fill"></i> Notifications</a>
                    <?php
                    }
                    ?>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark me-lg-3" data-bs-toggle="offcanvas" href="#message_sidebar"><i class="bi bi-chat-right-dots-fill"></i> Messages <span class="un-count position-absolute start-10 translate-middle badge p-1 rounded-pill bg-danger" id="msgcounter"></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark me-lg-3" href="?submitfeedback"><i class="bi bi-chat-square-dots-fill"></i> Submit Feedback</a>
                </li>

                <li class="nav-item dropdown dropstart">
                    <a class="nav-link text-dark me-lg-3" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="assets/images/profile/<?= $user['profile_pic'] ?>" alt="" height="30" width="30" class="rounded-circle border">
                        <span class="d-none d-lg-inline ms-2"><?= $user['username'] ?></span>
                    </a>
                    <ul class="dropdown-menu" style="background-color: #eeeeee; border: 1px solid #aaaaaa;">
                        <li><a class="dropdown-item" href="?u=<?= $user['username'] ?>"><i class="bi bi-person"></i> My Profile</a></li>
                        <li><a class="dropdown-item" href="?editprofile"><i class="bi bi-pencil-square"></i> Edit Profile</a></li>
                        <!-- <li><a class="dropdown-item" href="#"><i class="bi bi-gear"></i> Account Settings</a></li> -->
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="assets/php/actions.php?logout"><i class="bi bi-box-arrow-in-left"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>