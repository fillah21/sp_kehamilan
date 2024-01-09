<?php 
    require_once 'controller/main.php';

    if(isset($_COOKIE['SPKehamilan'])) {
        echo "
                <script>
                    document.location.href='user/index.php';
                </script>
        ";
    } else {
        echo "
                <script>
                    document.location.href='logout.php';
                </script>
            ";
    }
?>