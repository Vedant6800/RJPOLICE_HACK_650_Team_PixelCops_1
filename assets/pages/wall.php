<?php
// Global variables
global $user;
global $posts;
global $follow_suggestions;
?>
<!-- Main container -->
<div class="container col-md-10 col-sm-12 col-lg-9 rounded-0 d-flex flex-wrap justify-content-between">
    <div class="col-md-8 col-sm-12" style="max-width:93vw">
        <?php
        // Display error message for post image
        showError('post_img');

        // Check if there are no posts
        if (count($posts) < 1) {
            echo "<p style='width:93vw' class='p-2 bg-white border rounded text-center my-3 col-12'>Follow Someone or Add a new post</p>";
        }

        // Variable to track post count
        $postCount = 0;

        // Loop through posts
        foreach ($posts as $post) {
            // Increment post count
            $postCount++;

            // Get likes and comments for each post
            $likes = getLikes($post['id']);
            $comments = getComments($post['id']);
        ?>
            <!-- Post card -->
            <div class="card mt-4">
                <div class="card-title d-flex justify-content-between align-items-center">
                    <!-- User information and post options -->
                    <div class="d-flex align-items-center p-2">
                        <a href='?u=<?= $post['username'] ?>' class="text-decoration-none text-dark"><img src="assets/images/profile/<?= $post['profile_pic'] ?>" alt="" height="30" width="30" class="rounded-circle border">&nbsp;&nbsp;<?= $post['first_name'] ?> <?= $post['last_name'] ?></a>
                    </div>
                    <div class="p-2">
                        <?php
                        // Display post options for the post owner
                        if ($post['uid'] == $user['id']) {
                        ?>
                            <div class="dropdown">
                                <i class="bi bi-three-dots-vertical" id="option<?= $post['id'] ?>" data-bs-toggle="dropdown" aria-expanded="false"></i>
                                <ul class="dropdown-menu" aria-labelledby="option<?= $post['id'] ?>">
                                    <li><a class="dropdown-item" href="assets/php/actions.php?deletepost=<?= $post['id'] ?>"><i class="bi bi-trash-fill"></i> Delete Post</a></li>
                                </ul>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <!-- post text -->
                <?php
                // Display post text if available
                if ($post['post_text']) {
                ?>
                    <div class="card-body">
                        <?= $post['post_text'] ?><br>
                        <span style="font-size:small" class="text-muted">Posted</span> <?= show_time($post['created_at']) ?><br>
                    </div>
                <?php
                }
                ?>
                <!-- Post image -->
                <img src="assets/images/posts/<?= $post['post_img'] ?>" loading="lazy" class="border border-dark img-fluid rounded" style="aspect-ratio: 1/1; object-fit: contain; max-width: 100%;" alt="...">

                <!-- Post information and actions -->
                <h4 style="font-size: x-larger" class="p-2 border-bottom d-flex">
                    <span>
                        <?php
                        // Display like/unlike buttons based on like status
                        if (checkLikeStatus($post['id'])) {
                            $like_btn_display = 'none';
                            $unlike_btn_display = '';
                        } else {
                            $like_btn_display = '';
                            $unlike_btn_display = 'none';
                        }
                        ?>
                        <i class="bi bi-heart-fill unlike_btn text-danger" style="display:<?= $unlike_btn_display ?>" data-post-id='<?= $post['id'] ?>'></i>
                        <i class="bi bi-heart like_btn" style="display:<?= $like_btn_display ?>" data-post-id='<?= $post['id'] ?>'></i>
                    </span>
                    &nbsp;&nbsp;<i class="bi bi-chat-left d-flex align-items-center"><span class="p-1 mx-2 text-small" style="font-size:small" data-bs-toggle="modal" data-bs-target="#postview<?= $post['id'] ?>"><?= count($comments) ?> comments</span></i>
                </h4>

                <!-- likes count -->
                <div>
                    <span class="p-1 mx-2" data-bs-toggle="modal" data-bs-target="#likes<?= $post['id'] ?>"><span id="likecount<?= $post['id'] ?>"><?= count($likes) ?></span> likes</span>
                </div>

                <!-- Comment input section -->
                <div class="input-group p-2 <?= $post['post_text'] ? 'border-top' : '' ?>">
                    <input type="text" class="form-control rounded-0 border-0 comment-input" placeholder="say something.." aria-label="Recipient's username" aria-describedby="button-addon2">
                    <button class="btn btn-outline-primary rounded-0 border-0 add-comment" data-page='wall' data-cs="comment-section<?= $post['id'] ?>" data-post-id="<?= $post['id'] ?>" type="button" id="button-addon2">Post</button>
                </div>
            </div>

            <!-- Post view modal -->
            <div class="modal fade" id="postview<?= $post['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <!-- Modal content -->
                <div class="modal-dialog modal-xl modal-dialog-centered">
                    <div class="modal-content">
                        <!-- Modal body -->
                        <div class="modal-body d-md-flex p-0">
                            <!-- Left column - Post image -->
                            <div class="col-md-8 col-sm-12">
                                <img src="assets/images/posts/<?= $post['post_img'] ?>" style="max-height:90vh" class="w-100 overflow:hidden">
                            </div>

                            <!-- Right column - User details and comments -->
                            <div class="col-md-4 col-sm-12 d-flex flex-column">
                                <!-- User details -->
                                <div class="d-flex align-items-center p-2 border-bottom">
                                    <!-- User profile picture -->
                                    <div><img src="assets/images/profile/<?= $post['profile_pic'] ?>" alt="" height="50" width="50" class="rounded-circle border"></div>
                                    <div>&nbsp;&nbsp;&nbsp;</div>
                                    <div class="d-flex flex-column justify-content-start">
                                        <!-- User name and username -->
                                        <h6 style="margin: 0px;"><?= $post['first_name'] ?> <?= $post['last_name'] ?></h6>
                                        <p style="margin:0px;" class="text-muted">@<?= $post['username'] ?></p>
                                    </div>
                                    <div class="d-flex flex-column align-items-end flex-fill">
                                        <div class=""></div>
                                        <!-- Likes dropdown and post timestamp -->
                                        <div class="dropdown">
                                            <span class="<?= count($likes) < 1 ? 'disabled' : '' ?>" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                <?= count($likes) ?> likes
                                            </span>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                <?php
                                                // Display users who liked the post
                                                foreach ($likes as $like) {
                                                    $lu = getUser($like['user_id']);
                                                ?>
                                                    <li><a class="dropdown-item" href="?u=<?= $lu['username'] ?>"><?= $lu['first_name'] . ' ' . $lu['last_name'] ?> (@<?= $lu['username'] ?>)</a></li>
                                                <?php
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                        <div style="font-size:small" class="text-muted">Posted <?= show_time($post['created_at']) ?> </div>
                                    </div>
                                </div>

                                <!-- Comments section -->
                                <div class="flex-fill align-self-stretch overflow-auto" id="comment-section<?= $post['id'] ?>" style="height: 100px;">
                                    <?php
                                    // Display comments
                                    if (count($comments) < 1) {
                                    ?>
                                        <p class="p-3 text-center my-2 nce">no comments</p>
                                    <?php
                                    }
                                    foreach ($comments as $comment) {
                                        $cuser = getUser($comment['user_id']);
                                    ?>
                                        <div class="d-flex align-items-center p-2">
                                            <div><img src="assets/images/profile/<?= $cuser['profile_pic'] ?>" alt="" height="40" width="40" class="rounded-circle border"></div>
                                            <div>&nbsp;&nbsp;&nbsp;</div>
                                            <div class="d-flex flex-column justify-content-start align-items-start">
                                                <h6 style="margin: 0px;"><a href="?u=<?= $cuser['username'] ?>" class="text-decoration-none text-dark text-small text-muted">@<?= $cuser['username'] ?></a> - <?= $comment['comment'] ?></h6>
                                                <p style="margin:0px;" class="text-muted">(<?= show_time($comment['created_at']) ?>)</p>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>

                                <!-- Comment input section -->
                                <div class="input-group p-2 border-top">
                                    <input type="text" class="form-control rounded-0 border-0 comment-input" placeholder="say something.." aria-label="Recipient's username" aria-describedby="button-addon2">
                                    <button class="btn btn-outline-primary rounded-0 border-0 add-comment" data-cs="comment-section<?= $post['id'] ?>" data-post-id="<?= $post['id'] ?>" type="button" id="button-addon2">Post</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Likes modal -->
            <div class="modal fade" id="likes<?= $post['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Likes</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <?php
                            // Display users who liked the post
                            if (count($likes) < 1) {
                            ?>
                                <p>Currently No Likes</p>
                            <?php
                            }
                            foreach ($likes as $f) {
                                $fuser = getUser($f['user_id']);
                                $fbtn = '';

                                // Check if the user is blocked
                                if (checkBS($f['user_id'])) {
                                    continue;
                                } else if (checkFollowStatus($f['user_id'])) {
                                    $fbtn = '<button class="btn btn-sm btn-danger unfollowbtn" data-user-id=' . $fuser['id'] . ' >Unfollow</button>';
                                } else if ($user['id'] == $f['user_id']) {
                                    $fbtn = '';
                                } else {
                                    $fbtn = '<button class="btn btn-sm btn-primary followbtn" data-user-id=' . $fuser['id'] . ' >Follow</button>';
                                }
                            ?>
                                <!-- Display users who liked the post -->
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex align-items-center p-2">
                                        <div><img src="assets/images/profile/<?= $fuser['profile_pic'] ?>" alt="" height="40" width="40" class="rounded-circle border"></div>
                                        <div>&nbsp;&nbsp;</div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <a href='?u=<?= $fuser['username'] ?>' class="text-decoration-none text-dark">
                                                <h6 style="margin: 0px;font-size: small;"><?= $fuser['first_name'] ?> <?= $fuser['last_name'] ?></h6>
                                            </a>
                                            <p style="margin:0px;font-size:small" class="text-muted">@<?= $fuser['username'] ?></p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <?= $fbtn ?>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Check if it's the 2nd post and display follow suggestions -->
            <!-- Follow suggestions (if not shown after 2 posts) -->
            <?php if ($postCount < 2 && count($follow_suggestions) > 0) { ?>
                <div class="col-12 mt-4">
                    <h6 class="text-muted p-2">You Can Follow Them</h6>
                    <div class="row flex-nowrap overflow-auto">
                        <?php foreach ($follow_suggestions as $suser) { ?>
                            <div class="col-md-3 col-sm-6">
                                <div class="card text-center">
                                    <img src="assets/images/profile/<?= $suser['profile_pic'] ?>" alt="" class="card-img-top rounded-circle border img-fluid" style="width: 150px; height: 150px; object-fit: cover; margin: 10px auto;">
                                    <div class="card-body">
                                        <h6 class="card-title"><a href='?u=<?= $suser['username'] ?>' class="text-decoration-none text-dark"><?= $suser['first_name'] ?> <?= $suser['last_name'] ?></a></h6>
                                        <p class="card-text text-muted">@<?= $suser['username'] ?></p>
                                        <button class="btn btn-sm btn-primary followbtn" data-user-id='<?= $suser['id'] ?>'>Follow</button>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>


        <?php } ?>
    </div>

    <!-- Sidebar -->
    <div class="col-lg-4 col-sm-12 overflow-hidden mt-4 p-sm-0 p-md-3 bg-white">
        <!-- User details -->
        <div class="d-flex align-items-center p-2">
            <div><img src="assets/images/profile/<?= $user['profile_pic'] ?>" alt="" height="60" width="60" class="rounded-circle border"></div>
            <div>&nbsp;&nbsp;&nbsp;</div>
            <div class="d-flex flex-column justify-content-center">
                <a href='?u=<?= $user['username'] ?>' class="text-decoration-none text-dark">
                    <h6 style="margin: 0px;"><?= $user['first_name'] ?> <?= $user['last_name'] ?></h6>
                </a>
                <p style="margin:0px;" class="text-muted">@<?= $user['username'] ?></p>
            </div>
        </div>

        <!-- Follow suggestions (if not shown after 2 posts) -->
        <?php if ($postCount < 2 && count($follow_suggestions) > 0) { ?>
            <div class="col-12 mt-4">
                <h6 class="text-muted p-2">You Can Follow Them</h6>
                <?php foreach ($follow_suggestions as $suser) { ?>
                    <div class="d-flex justify-content-between">
                        <div class="d-flex align-items-center p-2">
                            <div><img src="assets/images/profile/<?= $suser['profile_pic'] ?>" alt="" height="40" width="40" class="rounded-circle border"></div>
                            <div>&nbsp;&nbsp;</div>
                            <div class="d-flex flex-column justify-content-center">
                                <a href='?u=<?= $suser['username'] ?>' class="text-decoration-none text-dark">
                                    <h6 style="margin: 0px; font-size: small;"><?= $suser['first_name'] ?> <?= $suser['last_name'] ?></h6>
                                </a>
                                <p style="margin:0px; font-size: small;" class="text-muted">@<?= $suser['username'] ?></p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <button class="btn btn-sm btn-primary followbtn" data-user-id='<?= $suser['id'] ?>'>Follow</button>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</div>