<div class="sidebar" data-background-color="dark">
  <div class="sidebar-logo">
      <!-- Logo Header -->
      <div class="logo-header" data-background-color="dark">
          <a href="" class="logo">
              <h1 class="">FISHY</h1>
          </a>
          <div class="nav-toggle">
              <button class="btn btn-toggle toggle-sidebar">
                  <i class="gg-menu-right"></i>
              </button>
              <button class="btn btn-toggle sidenav-toggler">
                  <i class="gg-menu-left"></i>
              </button>
          </div>
          <button class="topbar-toggler more">
              <i class="gg-more-vertical-alt"></i>
          </button>
      </div>
      <!-- End Logo Header -->
  </div>
  <div class="sidebar-wrapper scrollbar scrollbar-inner">
      <div class="sidebar-content">
          <ul class="nav nav-secondary">
              <li class="nav-item">
                  <a href="{{ route('dashboard.index') }}">
                      <i class="fas fa-chart-bar"></i>
                      <p>Dashboard</p>
                  </a>
              </li>
              <li class="nav-section">
                  <span class="sidebar-mini-icon">
                      <i class="fa fa-ellipsis-h"></i>
                  </span>
                  <h4 class="text-section">MENU</h4>
              </li>
              <li class="nav-item">
                  <a href="{{ route('settings.index') }}">
                      <i class="fas fa-cog"></i>
                      <p>Settings Tools</p>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('device.index') }}">
                      <i class="fas fa-cogs"></i>
                      <p>Device</p>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('feedSchedules.index') }}">
                      <i class="fas fa-calendar-alt"></i>
                      <p>Feed Schedules</p>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('report.index') }}">
                      <i class="fas fa-file-alt"></i>
                      <p>Report</p>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('notifications.index') }}" class="notification">
                      <i class="fas fa-bell"></i>
                      <p>Notifikasi</p>
                      <span id="notification-indicator" style="display: none;">
                          <i class="fas text-danger fa-solid fa-exclamation"></i>
                      </span>
                  </a>
              </li>
          </ul>
      </div>
  </div>
</div>