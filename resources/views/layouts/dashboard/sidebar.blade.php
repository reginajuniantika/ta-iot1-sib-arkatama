<div class="iq-sidebar">
    <div class="iq-sidebar-logo d-flex justify-content-between">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('images/logo-iot.png') }}" alt="Logo" width="150" height="150">
        </div>

        </a>
        <div class="iq-menu-bt align-self-center">
            <div class="wrapper-menu">
                <div class="line-menu half start"></div>
                <div class="line-menu"></div>
                <div class="line-menu half end"></div>
            </div>
        </div>
    </div>
    <div id="sidebar-scrollbar">
        <nav class="iq-sidebar-menu">
            <ul id="iq-sidebar-toggle" class="iq-menu">
                <li class="
                @if (request()->url() == route('dashboard'))
                    active
                @endif
                ">
                    <a href="{{ route('dashboard') }}" class="iq-waves-effect"><i class="ri-home-4-line"></i><span>Dashboard</span></a>
                </li>

                <li class="
                @if (request()->url() == route('sensor'))
                    active
                @endif
                ">
                    <a href="{{ route('sensor') }}" class="iq-waves-effect"><i class="ri-temp-cold-line"></i><span>Sensor</span></a>
                </li>

                <li class="
                @if (request()->url() == route('ledcontrol'))
                    active
                @endif
                ">
                    <a href="{{ route('ledcontrol') }}" class="iq-waves-effect"><i class="ri-lightbulb-line"></i><span>LED Control</span></a>
                </li>

                <li class="
                @if (request()->url() == route('users.index'))
                    active
                @endif
                ">
                    <a href="{{ route('users.index') }}" class="iq-waves-effect"><i
                            class="ri-user-2-line"></i><span>Pengguna</span></a>
                </li>
            </ul>
        </nav>
        <div class="p-3"></div>
    </div>
</div>
