<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.title-meta', ['title' => 'Login'])
    @include('layouts.head-css')
    <link rel="stylesheet" href="{{ asset('assets/css/demo1/style.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="hold-transition login-page">
    <div class="main-wrapper">
        <div class="page-wrapper full-page">
            <div class="page-content d-flex align-items-center justify-content-center">
                <div class="row w-100 mx-0 auth-page">
                    <div class="col-md-8 col-xl-6 mx-auto">
                        <div class="card">
                            <div class="row justify-content-center">
                                <div class="col-md-8 ps-md-0">
                                    <div class="auth-form-wrapper px-4 py-5">
                                        <a href="#"
                                            class="noble-ui-logo logo-light d-block mb-2">{{ env('APP_NAME') }}</a>
                                        <h5 class="text-muted fw-normal mb-4">Welcome back! Log in to your account.</h5>
                                        <form id="login-form" method="POST" action="{{ route('login') }}"
                                            class="forms-sample">
                                            @csrf
                                            <input type="hidden" name="fcm_token" id="fcm_token" value="">
                                            <div class="mb-3">
                                                <label class="form-label">Email</label>
                                                <input type="text" name="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    placeholder="Email" value="{{ old('email') }}" required
                                                    autocomplete="email" autofocus>
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Password</label>
                                                <input type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password" required autocomplete="current-password"
                                                    placeholder="Password">
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div>
                                                <button type="submit"
                                                    class="btn btn-outline-primary btn-icon-text btn-xs mb-2 mb-md-0">
                                                    <i class="btn-icon-prepend" data-feather="log-in"></i>
                                                    Login
                                                </button>
                                            </div>
                                            <a href="{{ route('register') }}" class="d-block mt-3 text-muted">Not a
                                                user? Sign up</a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer-script')

    <script type="module">
        import { initializeApp } from "https://www.gstatic.com/firebasejs/9.6.1/firebase-app.js";
        import { getMessaging, getToken, onMessage } from "https://www.gstatic.com/firebasejs/9.6.1/firebase-messaging.js";

        const firebaseConfig = {
            apiKey: "{{ env('FIREBASE_API_KEY') }}",
            authDomain: "{{ env('FIREBASE_AUTH_DOMAIN') }}",
            projectId: "{{ env('FIREBASE_PROJECT_ID') }}",
            storageBucket: "{{ env('FIREBASE_STORAGE_BUCKET') }}",
            messagingSenderId: "{{ env('FIREBASE_MESSAGING_SENDER_ID') }}",
            appId: "{{ env('FIREBASE_APP_ID') }}",
            measurementId: "{{ env('FIREBASE_MEASUREMENT_ID') }}"
        };

        const app = initializeApp(firebaseConfig);
        const messaging = getMessaging(app);

        // Register Service Worker
        navigator.serviceWorker.register('/firebase-messaging-sw.js')
            .then((registration) => {
                console.log('Service Worker registered with scope:', registration.scope);

                Notification.requestPermission().then(permission => {
                    if (permission === 'granted') {
                        getToken(messaging, {
                            serviceWorkerRegistration: registration,
                            vapidKey: 'BJyDZx3fz4DMcmB2L3tcvcfclPW5oFhJldp9-zC2IvZZEdnDP46lZe8pMBOiXfVvmglB1hQLyPJI21NavW4Fxuo'
                        }).then((currentToken) => {
                            if (currentToken) {
                                document.getElementById('fcm_token').value = currentToken;
                                localStorage.setItem('fcm_token', currentToken);
                            } else {
                                console.log('No registration token available. Request permission to generate one.');
                            }
                        }).catch((err) => {
                            console.error('An error occurred while retrieving token. ', err);
                        });
                    } else {
                        console.warn('Notification permission denied.');
                    }
                });
            })
            .catch((error) => {
                console.error('Service Worker registration failed:', error);
            });

        // Handle incoming messages
        onMessage(messaging, (payload) => {
            console.log('Message received. ', payload);
            const notificationTitle = payload.notification.title || 'Foreground Message Title';
            const notificationOptions = {
                body: payload.notification.body || 'Foreground Message body.',
                icon: payload.notification.icon || '/firebase-logo.png'
            };

            if (Notification.permission === 'granted') {
                new Notification(notificationTitle, notificationOptions);
            }
        });
    </script>

</body>

</html>
