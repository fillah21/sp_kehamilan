<?php
require_once '../controller/main.php';

if (isset($_COOKIE['SPKehamilan'])) {
    $user = cari_user();
}
?>

<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item">
                    <a href="../user" class="nav-link active text-white fw-semibold" aria-current="page">
                        Sistem Pakar Diagnosis Penyakit Pada Ibu Hamil</a>
                </li>
            </ul>
        </div>
    </div>
</nav>