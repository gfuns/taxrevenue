<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Forum</title>

    <link href="https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('proforum/assets/common/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('proforum/assets/admin/css/bootstrap-toggle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('proforum/assets/common/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('proforum/assets/common/css/line-awesome.min.css') }}">


    <link rel="stylesheet" href="{{ asset('proforum/assets/admin/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('proforum/assets/admin/css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('proforum/assets/admin/css/custom-style.css') }}">


    <link rel="stylesheet" href="{{ asset('proforum/assets/admin/css/auth.css') }}">
    <style>
        .ball {
            position: absolute;
            border-radius: 100%;
            opacity: 0.7;
        }
    </style>
</head>

<body>
    <div class="login_area">
        <div class="login">
            <div class="login__header">
                <h2>Admin Login</h2>
                <p>ProForum Dashboard</p>
            </div>
            <div class="login__body">
                <!-- <h4>user login</h4> -->
                <form action="https://preview.wstacks.com/proforum/admin" method="POST">
                    @csrf
                    <div class="field">
                        <input type="text" name="username" placeholder="Username">
                        <span class="show-pass"><i class="fas fa-user"></i></span>
                    </div>
                    <div class="field">
                        <input type="password" name="password" placeholder="Password">
                        <span class="show-pass"><i class="fas fa-lock"></i></span>
                    </div>
                    <div class="login__footer">
                        <div class="field_remember">
                            <div class="remember_wrapper">
                                <input type="checkbox" name="remember" id="remember">
                                <label class="remember" for="remember">Remember</label>
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <button type="submit" class="sign-in">Sign in</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset("proforum/assets/common/js/jquery-3.7.1.min.js") }}"></script>
    <script src="{{ asset("proforum/assets/common/js/bootstrap.bundle.min.js") }}"></script>
    <script src="{{ asset("proforum/assets/admin/js/bootstrap-toggle.min.js") }}"></script>

    <script src="{{ asset("proforum/assets/admin/js/jquery.slimscroll.min.js") }}"></script>

    <script src="{{ asset("proforum/assets/admin/js/apexcharts.min.js") }}"></script>
    <script src="{{ asset("proforum/assets/common/js/sweetalert2.min.js") }}"></script>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-right',
            customClass: {
                popup: 'colored-toast'
            },
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
    </script>





    <script src="{{ asset('proforum/assets/admin/js/select2.min.js') }}"></script>
    <script src="{{ asset('proforum/assets/admin/js/admin.js') }}"></script>
    <script src="{{ asset('proforum/assets/common/js/ckeditor.js') }}"></script>

    <script>
        "use strict";
        if ($(".trumEdit")[0]) {
            ClassicEditor
                .create(document.querySelector('.trumEdit'))
                .then(editor => {
                    window.editor = editor;
                });
        }
    </script>

    <script>
        "use strict";
        // Some random colors
        const colors = ["#00adad", "#e3e3e3", "red", "green", "blue"];

        const numBalls = 50;
        const balls = [];

        for (let i = 0; i < numBalls; i++) {
            let ball = document.createElement("div");
            ball.classList.add("ball");
            ball.style.background = colors[Math.floor(Math.random() * colors.length)];
            ball.style.left = `${Math.floor(Math.random() * 80)}vw`;
            ball.style.top = `${Math.floor(Math.random() * 80)}vh`;
            ball.style.transform = `scale(${Math.random()})`;
            ball.style.width = `${Math.random()}em`;
            ball.style.height = ball.style.width;

            balls.push(ball);
            document.body.append(ball);
        }

        // Keyframes
        balls.forEach((el, i, ra) => {
            let to = {
                x: Math.random() * (i % 2 === 0 ? -11 : 11),
                y: Math.random() * 12
            };

            let anim = el.animate(
                [{
                        transform: "translate(0, 0)"
                    },
                    {
                        transform: `translate(${to.x}rem, ${to.y}rem)`
                    }
                ], {
                    duration: (Math.random() + 1) * 2000, // random duration
                    direction: "alternate",
                    fill: "both",
                    iterations: Infinity,
                    easing: "ease-in-out"
                }
            );
        });
    </script>

</body>

</html>
