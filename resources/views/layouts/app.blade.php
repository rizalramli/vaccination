<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Twitter -->
    <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="DashForge">
    <meta name="twitter:description" content="Responsive Bootstrap 4 Dashboard Template">
    <meta name="twitter:image" content="http://themepixels.me/dashforge/img/dashforge-social.png">

    <!-- Facebook -->
    <meta property="og:url" content="http://themepixels.me/dashforge">
    <meta property="og:title" content="DashForge">
    <meta property="og:description" content="Responsive Bootstrap 4 Dashboard Template">

    <meta property="og:image" content="http://themepixels.me/dashforge/img/dashforge-social.png">
    <meta property="og:image:secure_url" content="http://themepixels.me/dashforge/img/dashforge-social.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content="Responsive Bootstrap 4 Dashboard Template">
    <meta name="author" content="ThemePixels">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('template/img/favicon.png') }}">

    <title>myITS Vaksin</title>

    @include('layouts.css')

  </head>
  <body>

    <aside class="aside aside-fixed">
              <div class="aside-header">
            <a href="{{ asset('template/index.html" class="tx-montserrat tx-semibold tx-18 aside-logo">myITS Vaksin</a>
            <a href="" class="aside-menu-link">
                <i data-feather="menu"></i>
                <i data-feather="x"></i>
            </a>
        </div>
        <div class="aside-body">
            @include('layouts.sidebar')
        </div>
    </aside>

    <div class="content ht-100v pd-0" style="position: relative">
            <div class="content-header align-items-center justify-content-start pos-fixed wd-100p z-index-10">
          <div>
              <a href="{{ asset('template/index.html" class="tx-montserrat tx-semibold tx-18 d-lg-none">myITS Vaksin</a>
          </div>
          <nav class="nav r-25 pos-fixed z-index-10">
              <div class="dropdown dropdown-profile allow-focus">
                <a href="" class="dropdown-link" data-toggle="dropdown" data-display="static" aria-expanded="false">
                  <div class="avatar avatar-sm"><img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" class="rounded-circle" alt=""></div>
                </a>
                <div class="dropdown-menu dropdown-menu-right allow-focus">
                  <h5 class="tx-medium tx-montserrat mg-b-5">Nama</h5>
                  <p class="mg-b-25 tx-13 tx-color-03">NRP/NIP</p>
                  <a href="" class="dropdown-item" data-toggle="modal" data-target="#chgRoleUser" data-animation="effect-scale">
                    <i data-feather="users"></i>Ganti hak akses
                  </a>
                  <a href="" class="dropdown-item  ht-30"><i data-feather="home"></i>myITS SSO</a>
                  <a href="../dashboard/login-mhs.html" class="dropdown-item ht-30"><i data-feather="log-out"></i>Keluar</a>
                </div>
              </div>
          </nav>
      </div>

      <div class="modal fade effect-scale" id="chgRoleUser" tabindex="-1" role="dialog" aria-labelledby="chgRoleUserLabel" aria-modal="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content bg-white">
            <div class="modal-body">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
              <h5 class="tx-montserrat tx-medium" id="chgRoleUserLabel">Hak Akses</h5>
              <p class="tx-color-02">Hak akses Anda saat ini: <b>User </b>.</p>
              <select class="form-control" id="menu">
                <option selected="selected">Select One</option>
                <option value="../beranda/index.html">Pegawai</option>
                <option value="../beranda/index-admin.html">Admin</option>
              </select>
              <div class="mg-t-20 d-flex justify-content-end">
                <button type="button" class="btn btn-white tx-montserrat tx-semibold" data-dismiss="modal">Batal</button>
                <input class="btn btn-its tx-montserrat tx-semibold mg-l-5 mg-lg-l-10" type="button" id="goBtn" value="Ganti">
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="content-body ht-100p pd-t-80">
        <div class="container pd-x-0" id="content">

          <div class="row row-xs">

            @yield('content')

          </div><!-- row -->
        </div><!-- container -->
      </div>
    </div>

    <div class="modal fade effect-scale" id="photoprofil" tabindex="-1" role="dialog" aria-labelledby="photoprofil" aria-hidden="true">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content tx-14 bg-white pd-10">
          <img src="https://i-invdn-com.akamaized.net/content/pic583d7c53b21af8b691aac70a6994c4c9.jpg" class="rounded-its2 wd-100p mg-b-10" alt="">
          <a href="https://my.its.ac.id/sso/account" class="btn btn-white tx-montserrat tx-semibold" target="_blank"><i data-feather="edit" class="wd-10 mg-r-5"></i> Sunting</a>
        </div>
      </div>
    </div>
    
    @include('layouts.js')

  </body>
</html>
