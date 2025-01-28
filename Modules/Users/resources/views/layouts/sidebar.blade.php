<div class="sidebar p-3" style="position: fixed; top: 0; left: 0; height: 100vh; width: 250px; background-color: #f8f9fa; display: flex; flex-direction: column;">
    <!-- الجزء الرئيسي القابل للتمرير -->
    <div class="flex-grow-1" style="overflow-y: auto; padding-bottom: 80px;">
        <h2 class="mb-3 text-primary">Abjad Online</h2>
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
                        <li><a class="nav-link text-dark" href="{{ route('settings.authentication.general') }}">Authentication</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>

    <!-- الفوتر المثبت -->
    <div id="footer" style="padding: 15px 0; background: linear-gradient(to top, #f8f9fa 20%, rgba(248,249,250,0.7)); position: sticky; bottom: 0; backdrop-filter: blur(5px); border-top: 1px solid rgba(0,0,0,0.05);">
        <div class="bottom-links">
            <a class="nav-link text-dark" href="#"><i class="fas fa-search me-2"></i> Search</a>
            <a class="nav-link text-dark" href="#"><i class="fas fa-user me-2"></i> My Account</a>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const currentPath = window.location.pathname;
    const mainLinks = document.querySelectorAll('.nav-link:not(.bottom-links .nav-link)');
    const homeLink = document.querySelector('.nav-link[href="#"]');
    
    // تجاهل الروابط التي تبدأ ب #
    const filteredLinks = Array.from(mainLinks).filter(link => 
        !link.getAttribute('href').startsWith('#')
    );

    let isAnyLinkActive = false;

    filteredLinks.forEach(link => {
        try {
            const linkUrl = new URL(link.href, window.location.origin);
            if (currentPath === linkUrl.pathname) { // مساواة تامة للمسار
                activateLink(link);
                isAnyLinkActive = true;
            }
        } catch (e) {
            console.log('Invalid URL:', link.href);
        }
    });

    if (!isAnyLinkActive && homeLink) {
        activateLink(homeLink);
    }

    mainLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            deactivateAllLinks();
            activateLink(this);
            window.location.href = this.href;
        });
    });

    document.querySelectorAll('[data-bs-toggle="collapse"]').forEach(button => {
        button.addEventListener('click', function () {
            this.querySelector('.fa-chevron-down').classList.toggle('rotated');
        });
    });

    function activateLink(link) {
        deactivateAllLinks();
        link.classList.add('active');
        const parentCollapse = link.closest('.collapse');
        if (parentCollapse) {
            parentCollapse.classList.add('show');
            const toggleButton = document.querySelector(`[href="#${parentCollapse.id}"]`);
            if (toggleButton) {
                toggleButton.setAttribute('aria-expanded', 'true');
                toggleButton.querySelector('.fa-chevron-down').classList.add('rotated');
            }
        }
    }

    function deactivateAllLinks() {
        mainLinks.forEach(link => {
            link.classList.remove('active');
            const parentCollapse = link.closest('.collapse');
            if (parentCollapse) parentCollapse.classList.remove('show');
        });
        document.querySelectorAll('.fa-chevron-down').forEach(icon => {
            icon.classList.remove('rotated');
        });
    }
});
</script>

<style>
.sidebar {
    box-shadow: 3px 0 15px rgba(0, 0, 0, 0.08);
    z-index: 1000;
}

.nav-link {
    padding: 12px 20px;
    margin: 2px 0;
    border-radius: 6px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    cursor: pointer;
    color: #333 !important;
    background: transparent !important;
}

.nav-link:hover {
    background: #e3f2fd !important;
    color: #1565c0 !important;
    transform: translateX(8px);
}

.nav-link.active {
    background: #1976d2 !important;
    color: white !important;
    font-weight: 500;
    box-shadow: 0 2px 8px rgba(25, 118, 210, 0.25);
    transform: none !important;
}

.nav-link.active::after {
    content: '';
    position: absolute;
    left: -4px;
    top: 50%;
    transform: translateY(-50%);
    height: 70%;
    width: 3px;
    background: #fff;
    border-radius: 0 3px 3px 0;
}

.submenu .nav-link {
    padding-left: 38px !important;
    font-size: 0.93em !important;
    transform: none !important;
}

.collapse.show {
    background: rgba(227, 242, 253, 0.25);
    border-left: 2px solid #1976d2;
    margin: 4px 0;
}

.rotated {
    transform: rotate(180deg) !important;
    transition: transform 0.25s ease-out;
}

.fa-chevron-down {
    transition: transform 0.25s ease-out;
}
</style>