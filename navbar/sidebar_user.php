<?php 
    validasi();
?>

<div class="sidebar" id="side_nav">
    <div class="content-side">
        <!--PROFIL-->
        <div class="profil pt-4">
            <span class="text-white ms-4 fs-5">
                <?= $user['nama']; ?>
            </span>

            <div class="ms-4 mt-2">
                <a class="text-decoration-none text-secondary" href="">Profil</a>
            </div>
        </div>
        <!--PROFIL SELESAI-->

        <!-- menu -->
        <div class="">
            <ul class="list-unstyled pt-4 fw-medium">
                <li class="">
                    <a href="../diagnosa" class="text-decoration-none d-block">
                        <span>Diagnosa</span>
                    </a>
                </li>
                <li class="">
                    <a href="../menu/riwayat" class="text-decoration-none d-block">
                        <span>Riwayat</span>
                    </a>
                </li>
            </ul>
        </div>
        <hr class="hr-color">

        <ul class="list-unstyled fw-medium pb-5">
            <li>
                <a href="../logout.php" class="text-decoration-none d-block">
                    <i class="bi bi-box-arrow-right fs-5"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </div>
</div>