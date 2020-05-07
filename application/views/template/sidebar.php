  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link navbar-primary">
      <img src="<?=base_url('assets/')?>a.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light"><b>Laundry</b></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?=base_url('assets/dist/img/'.$user['gambar'])?>" class="" style="height: 40px;width: 40px;border-radius: 50%" alt="User Image">
        </div>
        <div class="info">
          <a class="d-block"><?=$user['nama_user'] ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-compact nav-child-indent text-sm" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview <?= ($this->uri->segment(2) == 'home') ? 'menu-open' : '' ?>">
            <a href="#" class="nav-link <?=($this->uri->segment(2) == 'home') ? 'active' : ''?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=base_url('master/home')?>" class="nav-link <?=($this->uri->segment(2) == 'home') ? 'active' : ''?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview <?= ($this->uri->segment(2) == 'user' || $this->uri->segment(2) == 'outlet' || $this->uri->segment(2) == 'paket' || $this->uri->segment(2) == 'pelanggan') ? 'menu-open' : '' ?>">
            <a href="#" class="nav-link <?=($this->uri->segment(2) == 'user' || $this->uri->segment(2) == 'outlet' || $this->uri->segment(2) == 'paket' || $this->uri->segment(2) == 'pelanggan') ? 'active' : ''?>">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Master
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=base_url('master/user')?>" class="nav-link <?=($this->uri->segment(2) == 'user') ? 'active' : ''?> ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url('master/outlet')?>" class="nav-link <?=($this->uri->segment(2) == 'outlet') ? 'active' : ''?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Outlet</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url('master/paket')?>" class="nav-link <?=($this->uri->segment(2) == 'paket') ? 'active' : ''?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Paket Cucian</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url('master/pelanggan')?>" class="nav-link <?=($this->uri->segment(2) == 'pelanggan') ? 'active' : ''?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pelanggan</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview <?=($this->uri->segment(2) == 'jenis_paket' || $this->uri->segment(2) == 'tambahan') ? 'menu-open' : ''?>">
            <a href="#" class="nav-link <?=($this->uri->segment(2) == 'jenis_paket' || $this->uri->segment(2) == 'tambahan') ? 'active' : ''?>">
              <i class="nav-icon fa fa-gear"></i>
              <p>
                Setting
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=base_url('setting/tambahan')?>" class="nav-link <?=($this->uri->segment(2) == 'tambahan') ? 'active' : ''?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pajak dan Diskon</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=base_url('setting/jenis_paket')?>" class="nav-link <?=($this->uri->segment(2) == 'jenis_paket') ? 'active' : ''?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Jenis Paket</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview <?=($this->uri->segment(2) == 'transaksi') ? 'menu-open' : '' ?>">
            <a href="#" class="nav-link <?=($this->uri->segment(2) == 'transaksi') ? 'active' : '' ?>">
              <i class="nav-icon fa fa-money"></i>
              <p>
                Transaksi
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=base_url('master/transaksi/tambah')?>" class="nav-link <?=($this->uri->segment(3) == 'tambah') ? 'active' : '' ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Entri Transaksi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url('master/transaksi')?>" class="nav-link <?=($this->uri->segment(3) == 'transaksi') ? 'active' : '' ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Transaksi</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>