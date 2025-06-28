  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav mr-auto">
          <li class="nav-item d-flex align-items-center">
              <span style="color: #c00; font-weight: bold;">
                  <i class="fas fa-user-circle"></i>
                  Logged in as :
              </span>
              <span style="color: #c00; margin-left: 4px; font-weight: bold;"></span>
          </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto align-items-center">
          <li class="nav-item">
              <a class="nav-link" href="/" target="_blank">
                  <i class="far fa-window-restore"></i> Visit Site
              </a>
          </li>
          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="langDropdown" role="button" data-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-globe"></i> English
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="langDropdown">
                  <a class="dropdown-item" href="#">English</a>
                  <a class="dropdown-item" href="#">Spanish</a>
                  <!-- Add more languages as needed -->
              </div>
          </li>
          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-user"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                  <a class="dropdown-item" href="/logout">Logout</a>
                  <!-- Add more user actions as needed -->
              </div>
          </li>
      </ul>
  </nav>
