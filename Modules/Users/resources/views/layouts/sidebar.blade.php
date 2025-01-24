<div class="sidebar p-3" style="position: fixed; top: 0; left: 0; height: 100vh; width: 250px; overflow-y: auto; background-color: #f8f9fa;">
    <h5 class="mb-3 text-primary">Abjad Online</h5>
    <button class="btn btn-outline-primary mb-3">Preview</button>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link text-dark" href="#"><i class="fas fa-home me-2"></i> Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-dark" href="#"><i class="fas fa-book me-2"></i> Courses</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-dark" href="#"><i class="fas fa-globe me-2"></i> Website</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-dark d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
                href="#usersMenu" role="button" aria-expanded="false" aria-controls="usersMenu">
                <span><i class="fas fa-users me-2"></i> Users</span>
                <i class="fas fa-chevron-down"></i>
            </a>
            <div class="collapse" id="usersMenu">
                <ul class="list-unstyled ps-4 submenu">
                    <li><a class="nav-link text-dark" href="{{ route('auth.AllUsers') }}">All users</a></li>
                    <li><a class="nav-link text-dark" href="#">User roles</a></li>
                    <li><a class="nav-link text-dark" href="#">User groups</a></li>
                    <li><a class="nav-link text-dark" href="#">Multiple seats</a></li>
                    <li><a class="nav-link text-dark" href="#">Tags</a></li>
                    <li><a class="nav-link text-dark" href="#">Approvals</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link text-dark" href="#"><i class="fas fa-envelope me-2"></i> Communication</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-dark" href="#"><i class="fas fa-chart-bar me-2"></i> Reports</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-dark d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
                href="#settingsMenu" role="button" aria-expanded="false" aria-controls="settingsMenu">
                <span><i class="fas fa-cog me-2"></i> Settings</span>
                <i class="fas fa-chevron-down"></i>
            </a>
            <div class="collapse" id="settingsMenu">
                <ul class="list-unstyled ps-4 submenu">
                    <li><a class="nav-link text-dark" href="{{ route('settings.countries.index') }}">Countries</a></li>
                    <li><a class="nav-link text-dark" href="{{ route('settings.financial') }}">Finance</a></li>
                    <li><a class="nav-link text-dark" href="{{ route('settings.authentication.general') }}">Authentication</li>

                </ul>
            </div>
        </li>
    </ul>
    <div id="footer" class="position-absolute" style="bottom: 20px; left: 30px; w-100">
        <div class="mt-4 bottom-links">
            <a class="nav-link text-dark" href="#"><i class="fas fa-search me-2"></i> Search</a>
            <a class="nav-link text-dark" href="#"><i class="fas fa-user me-2"></i> My Account</a>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const links = document.querySelectorAll('.nav-link');
        links.forEach(link => {
            link.addEventListener('click', function () {
                links.forEach(item => item.classList.remove('active'));
                this.classList.add('active');
            });
        });
    });
</script>
