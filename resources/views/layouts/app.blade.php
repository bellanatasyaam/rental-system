<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title','Company Facilities')</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">

    <style>
        .dropdown-menu {
            max-height: 300px;
            overflow-y: auto;
        }
    </style>

    @stack('styles')
</head>
<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">🏠 Rental System</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav ms-auto">

                    <!-- NOTIFICATION DROPDOWN -->
                    @php
                        $admin = \App\Models\User::first();
                        $notifications = $admin ? $admin->notifications->take(5) : collect();
                        $unreadCount = $admin ? $admin->unreadNotifications->count() : 0;
                    @endphp

                    <li class="nav-item dropdown me-3">
                        <a class="nav-link position-relative" href="#" id="notifDropdown" role="button" data-bs-toggle="dropdown">
                            🔔
                            @if($unreadCount > 0)
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ $unreadCount }}
                                </span>
                            @endif
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notifDropdown">
                            @forelse($notifications as $notif)
                                <li class="dropdown-item">
                                    <strong>{{ $notif->data['title'] }}</strong><br>
                                    <small>{{ $notif->data['message'] }}</small>
                                </li>
                            @empty
                                <li class="dropdown-item text-muted">Tidak ada notifikasi</li>
                            @endforelse
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('notifications.read') }}" method="POST" class="text-center">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-primary w-100">
                                        Tandai semua dibaca
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <!-- CONTENT -->
    <div class="container py-4">
        @yield('content')
    </div>

    <!-- SCRIPTS -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });
    </script>

    @stack('scripts')
</body>
</html>
