<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('order.new_order') }} - MEDIAAV</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/employee.css') }}">
    @stack('styles')
</head>

<body>

    @php
        $userName = auth()->user()->name ?? 'Employee';
        $userEmail = auth()->user()->email ?? 'employee@gmail.com';
        $userUsername = auth()->user()->username ?? 'user';
        $currentResponseClass = match ($myResponse->response ?? null) {
            'yes' => 'yes',
            'maybe' => 'maybe',
            'no' => 'no',
            default => '',
        };

        $currentResponseText = match ($myResponse->response ?? null) {
            'yes' => __('order.yes'),
            'maybe' => __('order.possibly'),
            'no' => __('order.no'),
            default => __('order.no_response_yet'),
        };
    @endphp

    <div class="page-wrap">
        <div class="dashboard-shell">

            <header class="topbar">
                <div class="brand-wrap">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="MEDIAAV" class="brand-logo">
                </div>

                <div class="topbar-right">
                    <div class="lang-switcher">
                        <a href="{{ route('lang.switch', ['locale' => 'de']) }}"
                            class="{{ app()->getLocale() === 'de' ? 'active' : '' }}">
                            DE
                        </a>
                        <a href="{{ route('lang.switch', ['locale' => 'en']) }}"
                            class="{{ app()->getLocale() === 'en' ? 'active' : '' }}">
                            EN
                        </a>
                    </div>

                    <div class="dropdown user-dropdown">
                        <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <div class="avatar-circle">
                                {{ strtoupper(mb_substr($userUsername, 0, 1)) }}
                            </div>
                        </button>

                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-modern">
                            <li>
                                <div class="dropdown-user-head">
                                    <div class="dropdown-user-name">{{ $userName }}</div>
                                    <div class="dropdown-user-email">{{ $userEmail }}</div>
                                </div>
                            </li>
                            <li>
                                <a class="dropdown-item" href="mailto:{{ $userEmail }}">
                                    <i class="fa-regular fa-envelope"></i>
                                    <span>{{ $userEmail }}</span>
                                </a>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" class="dropdown-item m-0">
                                    @csrf
                                    <button type="submit" class="sidebar-logout-btn w-100">
                                        <i class="fa-solid fa-right-from-bracket"></i>
                                        <span>{{ __('order.logout') }}</span>
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </header>

            @yield('content')

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @stack('scripts')
    <script>
        toastr.options = {
            closeButton: true,
            progressBar: true,
            positionClass: "toast-top-right",
            timeOut: 3600,
            extendedTimeOut: 1200,
            preventDuplicates: true,
            newestOnTop: true,
            showDuration: 350,
            hideDuration: 250,
            showMethod: "slideDown",
            hideMethod: "fadeOut",
            showEasing: "swing",
            hideEasing: "linear"
        };

        @if (session('success'))
            toastr.success(@json(session('success')), 'Success');
        @endif

        @if (session('error'))
            toastr.error(@json(session('error')), 'Error');
        @endif

        @if (session('warning'))
            toastr.warning(@json(session('warning')), 'Warning');
        @endif

        @if (session('info'))
            toastr.info(@json(session('info')), 'Info');
        @endif

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error(@json($error), 'Error');
            @endforeach
        @endif
    </script>
</body>

</html>
