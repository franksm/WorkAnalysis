<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ route('user.saveWork') }}">
                    工作分析
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link @yield('nav_list')" href="{{ route('analysis.list') }}">列表分析</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @yield('nav_detail')" href="{{ route('analysis.detail') }}">細項分析</a>
                        </li> 
                        <li class="nav-item">
                            <a class="nav-link @yield('nav_suitable')" href="{{ route('analysis.suitable') }}">合適分析</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>