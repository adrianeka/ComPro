<style>
    .navbar-logo {
        width: 256px;
    }
    @media (max-width: 991.98px) {
        .navbar-logo {
            width: 150px;
        }
    }
</style>

<nav class="navbar navbar-expand-lg shadow-sm" style="background-color: white;">
    <div class="container-fluid">
        <div class="navbar-logo">
            <img class="mx-auto d-block" src="{{ asset('assets/images/logo.svg') }}" alt="logo-labbis" style="height: 40px; width: 130px;">
        </div>
        <button class="btn btn-outline-dark toggler-btn d-lg-none me-3"><i class="bi bi-list"></i></button>
        <div class="d-flex align-items-center">
            <i class="bi bi-person-circle fs-4"></i> 
            <p class="ms-2 mb-0 d-none d-lg-block"> Admin </p> 
        </div>
    </div>
</nav>
