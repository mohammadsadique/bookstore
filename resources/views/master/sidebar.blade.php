<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link text-center">
      <span class="brand-text font-weight-light">Bookstore</span>
    </a>
    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item ">
                <a href="{{ route('manage-book.index') }}" class="nav-link {{ (Request::segment(2) == 'manage-book') ? 'active' : ''}}">
                  <i class="nav-icon fas fa-book"></i>
                  <p>Manage Books</p>
                </a>
            </li>
          </ul>
      </nav>

    </div>
</aside>