<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= PAGE_PATH; ?>">Dous Asionos Interview</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?php if($page == 'home'): echo 'active'; endif; ?>" href="<?= PAGE_PATH; ?>">Home</a>
                </li>
                <?php if(isset($_SESSION['user']) && !empty($_SESSION['user'])): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if($page == 'logout'): echo 'active'; endif; ?>" href="<?= PAGE_PATH .'logout'; ?>">Logout</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if($page == 'login'): echo 'active'; endif; ?>" href="<?= PAGE_PATH .'login'; ?>">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if($page == 'register'): echo 'active'; endif; ?>" href="<?= PAGE_PATH .'register'; ?>">Register</a>
                    </li>
                <?php endif; ?>
            </ul>
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-primary" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>