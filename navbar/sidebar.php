<?php 
    require_once '../controller/main.php';

    validasi_admin();
?>

<div class="sidebar" id="side_nav">
    <!--PROFIL-->
    <div class="content-side">
        <div class="profil pt-4">
            <span class="text-white ms-4 fs-5">
                <?= $user['nama']; ?>
            </span>
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
                    <a href="../menu/riwayat.php" class="text-decoration-none d-block">
                        <span>Riwayat</span>
                    </a>
                </li>
                <li class="">
                    <a href="../menu/manaj_pengguna.php" class="text-decoration-none d-block">
                        <span>Manajemen Pengguna</span>
                    </a>
                </li>
                <li class="">
                    <a href="../menu/manaj_penyakit.php" class="text-decoration-none d-block">
                        <span>Manajemen Penyakit</span>
                    </a>
                </li>
                <li class="">
                    <a href="../menu/manaj_gejala.php" class="text-decoration-none d-block">
                        <span>Manajemen Gejala</span>
                    </a>
                </li>
                <li class="">
                    <a href="../menu/manaj_rule.php" class="text-decoration-none d-block">
                        <span>Manajemen Rule</span>
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