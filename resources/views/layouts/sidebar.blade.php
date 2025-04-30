<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">
    <div class="slimscroll-menu" id="remove-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            
            <!-- Left Menu Start -->
            <ul class="metismenu" id="side-menu">
                <li class="menu-title">Main</li>
                <li class="">
                    <a href="{{route('admin')}}" class="waves-effect {{ request()->is("admin") || request()->is("admin/*") ? "mm active" : "" }}">
                        <i class="ti-home"></i><span class="badge badge-primary badge-pill float-right">2</span> <span> Dashboard </span>
                    </a>
                </li>

                <li class="menu-title">Management</li>

                {{-- ================================================================= --}}
                <li class="">
                    <a href="{{ route('admin.perusahaan.index') }}" class="waves-effect {{ request()->is("perusahaans") || request()->is("perusahaans/*") ? "mm active" : "" }}">
                        <i class="dripicons-to-do"></i> <span> Perusahaan </span>
                    </a>
                </li>
                
                <li class="">
                    <a href="{{ route('admin.karyawan.index') }}" class="waves-effect {{ request()->is("karyawans") || request()->is("karyawans/*") ? "mm active" : "" }}">
                        <i class="ti-user"></i> <span> Karyawan </span>
                    </a>
                </li>
                
                <li class="">
                    <a href="{{ route('admin.keterangan_gaji.index') }}" class="waves-effect {{ request()->is("keterangan_gajis") || request()->is("keterangan_gajis/*") ? "mm active" : "" }}">
                        <i class="ti-wallet"></i> <span> Keterangan Gaji </span>
                    </a>
                </li>

                <li class="">
                    <a href="{{ route('admin.slip_gaji.index') }}" class="waves-effect {{ request()->is("slip_gajis") || request()->is("slip_gajis/*") ? "mm active" : "" }}">
                        <i class="ti-money"></i> <span> Transaksi Penggajian </span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->
