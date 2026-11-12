<!DOCTYPE html>
<html lang="tk">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Admin Panel')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    @stack('styles')
</head>

<body class="bg-light">

    <div class="container-fluid">
        <div class="row min-vh-100">

            {{-- Sidebar --}}
            <aside class="col-md-3 col-lg-2 bg-dark text-white p-3">

                <h4 class="text-center mb-4">SMS Admin</h4>

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

                <header class="bg-white shadow-sm p-3">
                    <h4 class="mb-0">@yield('page-title', 'Dashboard')</h4>
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

    @stack('scripts')

</body>

</html>