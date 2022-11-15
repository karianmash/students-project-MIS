<?php
require_once 'notifications.php';

$x = new Notification($conn, $student);

$notifications = $x->get($student);
$notArray = [];
foreach ($notifications as $notification) {
    //    print_r($notification);
    switch ($notification['notifications'][0]['type']) {
        case 'upload.new':
            $x1 = new NewUploadNotification($conn, $student);
            $tempArr = $x1->messageForNotifications($notification['notifications']);
            $tempArr['recipient'] = $notification['notifications'][0]['recipient_id'];
            $tempArr['reference_id'] = $notification['notifications'][0]['reference_id'];
            $tempArr['type'] = $notification['notifications'][0]['type'];
            $notArray[] = $tempArr;
            break;
        case 'category.new':
            $x1 = new NewCategoryNotification($conn, $student);
            $tempArr = $x1->messageForNotifications($notification['notifications']);
            $tempArr['recipient'] = $notification['notifications'][0]['recipient_id'];
            $tempArr['reference_id'] = $notification['notifications'][0]['reference_id'];
            $tempArr['type'] = $notification['notifications'][0]['type'];
            $notArray[] = $tempArr;
            break;
        case 'upload.status':
            $x1 = new NewUpdateNotification($conn, $student);
            $tempArr = $x1->messageForNotifications($notification['notifications']);
            $tempArr['recipient'] = $notification['notifications'][0]['recipient_id'];
            $tempArr['reference_id'] = $notification['notifications'][0]['reference_id'];
            $tempArr['type'] = $notification['notifications'][0]['type'];
            $notArray[] = $tempArr;
            break;
        case 'project.status':
            $x1 = new ProjectUpdateNotification($conn, $student);
            $tempArr = $x1->messageForNotifications($notification['notifications']);
            $tempArr['recipient'] = $notification['notifications'][0]['recipient_id'];
            $tempArr['reference_id'] = $notification['notifications'][0]['reference_id'];
            $tempArr['type'] = $notification['notifications'][0]['type'];
            $notArray[] = $tempArr;
            break;
        case 'message.new':
            $x1 = new NewMessageNotification($conn, $student);
            $tempArr = $x1->messageForNotifications($notification['notifications']);
            $tempArr['recipient'] = $notification['notifications'][0]['recipient_id'];
            $tempArr['reference_id'] = $notification['notifications'][0]['reference_id'];
            $tempArr['type'] = $notification['notifications'][0]['type'];
            $notArray[] = $tempArr;
            break;
    }
}
?>
<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="index.html" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="assets/images/logo-sm.png" alt="" height="30">
                    </span>
                    <span class="logo-lg">
                        <img src="assets/images/logo-dark.png" alt="" height="70">
                    </span>
                </a>
                <a href="index.html" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="assets/images/logo-sm.png" alt="" height="30">
                    </span>
                    <span class="logo-lg">
                        <img src="assets/images/logo-light.png" alt="" height="60" width="70">
                    </span>
                </a>
            </div>
            <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                <i class="mdi mdi-menu"></i>
            </button>
        </div>

        <?php
        $uploadDir = 'assets/images/users/';
        $image = empty($studentDetails['profile']) ? $uploadDir . 'avatar-st.png' : $uploadDir . $studentDetails['profile'];
        if (!file_exists($image)) {
            $image = $uploadDir . 'avatar-st.png';
        }

        ?>
        <div class="dropdown d-inline-block">
            <button type="button" class="btn header-item waves-effect fs-15 text-primary text-bold" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family: 'Open Sans', sans-serif;">
                <?php
                echo ucfirst(explode(' ', $studentDetails['full_name'])[0]);
                ?>
                <img class="rounded-circle header-profile-user m-l-4" src="<?= $image ?>" alt="Header Avatar">
            </button>
            <div class="dropdown-menu dropdown-menu-right d-menu">
                <!-- item-->
                <a class="dropdown-item" href="change-password.php"><i class="mdi mdi-lock-open-outline font-size-17 align-middle mr-1"></i> Change Password</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-danger" href="logout.php"><i class="bx bx-power-off font-size-17 align-middle mr-1 text-danger"></i> Logout</a>
            </div>
        </div>

    </div>
    </div>
</header>