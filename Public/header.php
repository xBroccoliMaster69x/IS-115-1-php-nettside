<header>
    <div class="container">
        <!-- Logo -->
        <div class="logo">
            <a href="mainPage.php">Logo</a>
        </div>

        <!-- Navigation Links -->
        <?php
        // sjekker om en session allerede går
        if (session_status() === PHP_SESSION_NONE) {
            session_start(); // Start session hvis ikke
        }
        if (isset($_SESSION['user'] )) { //header redirecter basert på tilstand
            if ($_SESSION['user']['is_admin'] == 1) {
                echo '<p><a href="/phpnettside/public/index.php?url=Admin/index">Admin Dashboard</a></p>';
            } else {
                echo '<p><a href="/phpnettside/public/index.php?url=User/dashboard">Bruker Dashboard</a></p>';
            }
            echo '<p><a href="/phpnettside/public/index.php?url=User/logout">Logout</a></p>'; 
        } else {
            echo '<p><a href="/phpnettside/public/index.php?url=User/login">Login</a></p>';
        }
        ?>
    </div>
</header>
