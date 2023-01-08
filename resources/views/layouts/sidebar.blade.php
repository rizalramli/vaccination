<ul class="nav nav-aside">
    <li class="nav-item"><a href="../beranda/index-admin.html" class="nav-link"><i data-feather="home"></i> <span>Beranda</span></a></li>
    <li class="nav-label mg-t-15">Kelola</li>
    <li class="nav-item"><a href="{{ route('schedule.index') }}" class="nav-link {{ (request()->is('schedule') || request()->is('schedule/*') || request()->is('vaccination/*/edit')) ? 'active' : '' }}"><i data-feather="calendar"></i> <span>Jadwal Vaksinasi</span></a></li>
    <li class="nav-item"><a href="{{ route('vaccination.index') }}" class="nav-link {{ (request()->is('vaccination')) ? 'active' : '' }}"><i data-feather="clipboard"></i> <span>Laporan</span></a></li>
    <li class="nav-label mg-t-15">Data</li>
    <li class="nav-item"><a href="{{ route('employee.index') }}" class="nav-link {{ (request()->is('employee') || request()->is('employee/*')) ? 'active' : '' }}"><i data-feather="user"></i> <span>Pegawai</span></a></li>
    <li class="nav-item"><a href="{{ route('vaccinator.index') }}" class="nav-link {{ (request()->is('vaccinator')) ? 'active' : '' }}"><i data-feather="users"></i> <span>Vaksinator</span></a></li>
    <li class="nav-item"><a href="{{ route('vaccine-type.index') }}" class="nav-link {{ (request()->is('vaccine-type')) ? 'active' : '' }}"><i data-feather="copy"></i> <span>Jenis Vaksin</span></a></li>
</ul>