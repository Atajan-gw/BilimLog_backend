<!DOCTYPE html>
<html lang="tk">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Admin Panel')</title>

    <link href="{{ asset('css/bootstrap.min.css') }}"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    <script>
        (function () {
            try {
                var theme = localStorage.getItem('admin-theme');
                if (theme === 'dark' || theme === 'light') {
                    document.documentElement.setAttribute('data-bs-theme', theme);
                }
            } catch (e) {}
        })();
    </script>

    @stack('styles')
</head>

<body>

    <div class="container-fluid">
        <div class="row min-vh-100">

            {{-- Sidebar --}}
            <aside class="col-md-3 col-lg-2 bg-dark text-white p-3">

                <h4 class="text-center mb-4">BilimLog Admin</h4>

                <nav class="nav flex-column gap-2">

                    <a class="nav-link text-white rounded"
                        href="{{ route('admin.dashboard') }}">
                        Dashboard
                    </a>

                    <a class="nav-link text-white rounded"
                        href="{{ route('admin.students.index') }}">
                        Students
                    </a>

                    <a href="{{ route('admin.groups.index') }}"
                        class="nav-link text-white">
                        Groups
                    </a>

                    <a href="{{ route('admin.teachers.index') }}"
                        class="nav-link text-white">
                        Teachers
                    </a>

                </nav>

                <div class="mt-5">
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button class="btn btn-danger w-100" type="submit">
                            Logout
                        </button>
                    </form>
                </div>

            </aside>

            {{-- Main content --}}
            <div class="col-md-9 col-lg-10 p-0">

                <header class="admin-header shadow-sm p-3 d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">@yield('page-title', 'Dashboard')</h4>

                    <button type="button"
                            class="btn btn-outline-secondary btn-sm"
                            id="theme-toggle"
                            aria-pressed="false">
                        Dark mode
                    </button>
                </header>

                <main class="container-fluid p-4">

                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="btn-close"
                            data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    @yield('content')

                </main>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        (function () {
            var root = document.documentElement;
            var button = document.getElementById('theme-toggle');

            function sync() {
                var dark = root.getAttribute('data-bs-theme') === 'dark';
                button.textContent = dark ? 'Light mode' : 'Dark mode';
                button.setAttribute('aria-pressed', dark ? 'true' : 'false');
            }

            button.addEventListener('click', function () {
                var next = root.getAttribute('data-bs-theme') === 'dark' ? 'light' : 'dark';
                root.setAttribute('data-bs-theme', next);
                localStorage.setItem('admin-theme', next);
                sync();
            });

            sync();
        })();
    </script>

    @stack('scripts')

</body>

</html>