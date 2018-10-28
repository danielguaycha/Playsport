<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>AppSport</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 3rem;
                color: #00748e;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Admin</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                       {{-- @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif--}}
                    @endauth
                </div>
            @endif

            <div class="content">
                <img width="200rem" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDUxMiA1MTIiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUxMiA1MTI7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iNTEycHgiIGhlaWdodD0iNTEycHgiPgo8cG9seWdvbiBzdHlsZT0iZmlsbDojMDA3NDhFOyIgcG9pbnRzPSIzNzguNTc5LDUwMiAyMjQuOTk3LDUwMiAyMjQuOTk3LDQzNC4wNjcgMzc4LjU3OSw0MzQuMDY3IDM3OC41NzksNDM0LjA2NyAiLz4KPHBhdGggZD0iTTMzNi40OTcsNDc4LjAzYy0wLjY1LDAtMS4zMS0wLjA2MS0xLjk1LTAuMTljLTAuNjQtMC4xMy0xLjI3LTAuMzItMS44Ny0wLjU3Yy0wLjYxLTAuMjUtMS4xOS0wLjU1OS0xLjczLTAuOTIgIGMtMC41NS0wLjM3LTEuMDYtMC43OS0xLjUyLTEuMjVzLTAuODgtMC45Ny0xLjI0LTEuNTJjLTAuMzYtMC41NC0wLjY3LTEuMTItMC45Mi0xLjcyMWMtMC4yNS0wLjYwOS0wLjQ1LTEuMjI5LTAuNTctMS44NjkgIGMtMC4xMy0wLjY1LTAuMi0xLjMwMS0wLjItMS45NmMwLTAuNjUsMC4wNy0xLjMxMSwwLjItMS45NWMwLjEyLTAuNjQxLDAuMzItMS4yNzEsMC41Ny0xLjg3YzAuMjUtMC42MSwwLjU2LTEuMTkxLDAuOTItMS43MyAgYzAuMzYtMC41NSwwLjc4LTEuMDYsMS4yNC0xLjUyczAuOTctMC44OCwxLjUyLTEuMjRjMC41NC0wLjM2LDEuMTItMC42NywxLjcyLTAuOTJjMC42MS0wLjI1LDEuMjQtMC40NCwxLjg4LTAuNTcgIGMxLjI4LTAuMjYsMi42MS0wLjI2LDMuOSwwYzAuNjQsMC4xMywxLjI3LDAuMzIsMS44NywwLjU3YzAuNjEsMC4yNSwxLjE5LDAuNTYsMS43MywwLjkyYzAuNTUsMC4zNiwxLjA2LDAuNzgsMS41MiwxLjI0ICBzMC44OCwwLjk3LDEuMjQsMS41MmMwLjM2LDAuNTQsMC42NywxLjEyLDAuOTIsMS43M2MwLjI1LDAuNiwwLjQ1LDEuMjI5LDAuNTcsMS44N2MwLjEzLDAuNjQsMC4yLDEuMywwLjIsMS45NSAgYzAsMC42NTktMC4wNywxLjMxLTAuMiwxLjk2Yy0wLjEyLDAuNjQtMC4zMiwxLjI2LTAuNTcsMS44NjljLTAuMjUsMC42MDEtMC41NiwxLjE4MS0wLjkyLDEuNzIxYy0wLjM2LDAuNTUtMC43OCwxLjA2LTEuMjQsMS41MiAgcy0wLjk3LDAuODgtMS41MiwxLjI1Yy0wLjU0LDAuMzYtMS4xMiwwLjY3LTEuNzMsMC45MmMtMC42LDAuMjUtMS4yMywwLjQ0MS0xLjg3LDAuNTdTMzM3LjE0Nyw0NzguMDMsMzM2LjQ5Nyw0NzguMDN6Ii8+Cjxwb2x5Z29uIHN0eWxlPSJmaWxsOiNGQ0I2NTM7IiBwb2ludHM9IjI1Mi40MzQsMzA4LjkxMyAyNTIuNDM0LDM4NyAyODUuODkyLDM4NyAyODUuODkyLDMwMi44NSAiLz4KPHBhdGggc3R5bGU9ImZpbGw6I0U4Mjg1MjsiIGQ9Ik00MDMuNjQ3LDIwNS43NjdsLTM2LjQ4My02NC42ODZMMTgyLjEwNywyNDUuNDU1bDM1LjkwNiw2My42NjFjMC4wMDEsMCwwLjAwMiwwLDAuMDA0LDAgIGMzMy42OTEtMC4yNzEsNzAuMTc1LTcuNzIxLDEwNi4yNTctMjguMDcyQzM2MC41NTcsMjYwLjU4LDM4NS45MjEsMjMzLjc2NCw0MDMuNjQ3LDIwNS43Njd6Ii8+CjxwYXRoIHN0eWxlPSJmaWxsOiNGMDUxNEQ7IiBkPSJNMjEwLjYyNCw3OC44NTNjLTM2LjE3NSwyMC40MDMtNjEuNDY1LDQ3LjYyOS03OS4xNTEsNzYuMTMybC0wLjAwMiwwLjAwM2wzMi4xNDMsNTYuOTkxICBsMTgzLjU2My0xMDMuNTMxbDEuNC0wLjc4OUwzMTYuMjY2LDUwLjM3QzI4Mi45MDgsNTAuODY0LDI0Ni43MDksNTguNTAxLDIxMC42MjQsNzguODUzeiIvPgo8Zz4KCTxwYXRoIHN0eWxlPSJmaWxsOiNEQUU5RUM7IiBkPSJNOTEuOTg1LDI3OS4zMzRjMTkuNTY4LDkuMzg3LDQ5LjYxNiwyMS4yNTIsODUuMjAzLDI2Ljc0N2wtNjQuMzQ3LTExNC4wOSAgIEM5OS4wNDQsMjI1LjcwNSw5My44NzUsMjU3Ljg1MSw5MS45ODUsMjc5LjMzNHoiLz4KCTxwYXRoIHN0eWxlPSJmaWxsOiNEQUU5RUM7IiBkPSJNNDQzLjQzOCw4Mi41MjNjLTE4LjU2LTkuNDkxLTQ5LjEzNi0yMi41NzQtODYuMTY5LTI4LjgwMWw2NS4yNDgsMTE1LjY4NiAgIEM0MzYuNDM4LDEzNi4xNTgsNDQxLjYwMiwxMDQuMzQ2LDQ0My40MzgsODIuNTIzeiIvPgo8L2c+CjxnPgoJPHBhdGggc3R5bGU9ImZpbGw6IzVCRTVFRjsiIGQ9Ik00MDMuNjQ1LDIwNS4zMDJsLTg2LjMxLTE1My4wMzFjMTMuNDQ4LTEuNDcxLDI2LjI4NS0xLjgxNSwzOC4zMzktMS4zNjlsNjkuMDY4LDEyMi40NTkgICBDNDE4Ljg3MywxODMuODQ3LDQxMS45MDUsMTk0LjU5Niw0MDMuNjQ1LDIwNS4zMDJ6Ii8+Cgk8cGF0aCBzdHlsZT0iZmlsbDojNUJFNUVGOyIgZD0iTTIxNy44NzYsMzA4Ljg2N2MtMTMuNDAzLDEuNDk4LTI2LjIxOCwxLjg5Ny0zOC4yNSwxLjUyN2wtNjcuMTU2LTExOS4wNyAgIGM1LjkxMy0xMC40NjEsMTIuODkzLTIxLjE4OSwyMS4xMzktMzEuODY1TDIxNy44NzYsMzA4Ljg2N3oiLz4KCTxyZWN0IHg9IjIzNC42NiIgeT0iMzg3IiBzdHlsZT0iZmlsbDojNUJFNUVGOyIgd2lkdGg9Ijk4LjMzIiBoZWlnaHQ9IjQ3LjA3Ii8+CjwvZz4KPHBhdGggZD0iTTQzMS43NCwxNzMuMjcxYzI1LjgxLTYxLjY0NiwyMi42MTUtMTE3LjgyNSwyMi40NjctMTIwLjE4N2MtMC4xOTUtMy4xLTEuODE5LTUuOTMzLTQuMzk1LTcuNjY3ICBjLTEuOTI4LTEuMjk5LTQ3LjUyNC0zMS42MTEtMTExLjk5Mi00MS44NTljLTAuNjY1LTAuMjU1LTEuMzYyLTAuNDQyLTIuMDgtMC41NTFjLTE0LjI1Ni0yLjE2Ny0yOC41MDctMy4xNzMtNDIuMzY5LTIuOTg1ICBjLTAuNzc2LDAuMDEtMS41MzksMC4xMTEtMi4yNzUsMC4yOTNjLTM4LjUxNiwwLjg5LTc0Ljk2OSwxMC44ODktMTA4LjM4NCwyOS43MzZjLTMzLjM2OCwxOC44MTktNjAuNzY0LDQ0LjktODEuNDYyLDc3LjU0ICBjLTAuNTMzLDAuNTMxLTEuMDA5LDEuMTI3LTEuNDE1LDEuNzgxYy03LjI5OCwxMS43NjQtMTMuNzk5LDI0LjQ5OS0xOS4zMjMsMzcuODUzYy0wLjI3OCwwLjY3Mi0wLjQ3OCwxLjM2NS0wLjYwMywyLjA2NyAgYy0yNC40NzUsNjAuMzQ1LTIyLjMzMSwxMTQuOTM1LTIyLjIyNywxMTcuMjUyYzAuMTQ1LDMuMjA1LDEuODE3LDYuMTQ2LDQuNDk5LDcuOTA3YzEuOTQ5LDEuMjgsNDguNDgxLDMxLjQ3OCwxMTMuNDgyLDQxLjUxNCAgYzAuNTExLDAuMDc5LDEuMDIsMC4xMTcsMS41MjcsMC4xMTdjMC4yMTUsMCwwLjQyOS0wLjAwNywwLjY0Mi0wLjAyMWMxMi43OTksMS44NjUsMjUuNTU4LDIuODEsMzcuOTk0LDIuODE1ICBjMC4wOTEsMC4wMiwwLjE4MywwLjA0LDAuMjc1LDAuMDU3VjM3N2gtMzcuMTA0Yy01LjUyMywwLTEwLDQuNDc4LTEwLDEwdjM3LjA2N2gtMzUuNTgzYy01LjUyMywwLTEwLDQuNDc4LTEwLDEwVjUwMiAgYzAsNS41MjMsNC40NzcsMTAsMTAsMTBIMzc4LjU4YzUuNTIzLDAsMTAtNC40NzcsMTAtMTB2LTY3LjkzM2MwLTUuNTIyLTQuNDc3LTEwLTEwLTEwaC0zNS41ODJWMzg3YzAtNS41MjItNC40NzctMTAtMTAtMTBoLTM3LjEwNCAgdi03MS44MzJjMTEuNDE3LTQuMTk5LDIyLjUyNi05LjMzOSwzMy4yOTQtMTUuNDEzYzM0LjI1Mi0xOS4zMTgsNjIuMTg4LTQ1Ljg0LDgzLjAzNC03OC44MzFjMC40MjctMC42NjksMC43NjctMS4zNzgsMS4wMi0yLjExICBjNi41NC0xMC41ODIsMTIuMzk5LTIxLjg3NywxNy40NDUtMzMuNjM1QzQzMS4wOTksMTc0LjU5LDQzMS40NTUsMTczLjk1Miw0MzEuNzQsMTczLjI3MXogTTQzNC4zOCw1OS4zNTkgIGMwLjEwNiwxMi41MzItMC45NTUsNDcuMDE4LTEzLjc0Miw4Ni4zNjRMMzUzLjcxNywyNy4wNjlDMzkzLjU1NCwzNi40NDYsNDIzLjY1LDUyLjk0NSw0MzQuMzgsNTkuMzU5eiBNMzEwLjg2NywyMC40NDIgIGM1LjY2MiwwLjM0OCwxMS4zNjUsMC45MDEsMTcuMDgyLDEuNjU4bDgzLjI4MSwxNDcuNjZjLTIuMzIsNS4yNDYtNC44MTQsMTAuMzg0LTcuNDY3LDE1LjM4OEwzMTAuODY3LDIwLjQ0MnogTTE5Mi41MzcsNDcuNDcxICBjMjkuNDU3LTE2LjYxNSw2MS41MTEtMjUuNzAyLDk1LjM1NS0yNy4wNDdsNDcuMDYsODMuNDM5bC0zMy4wNjEsMTguNjQ3bC03Ljc1My0xMy43NDZjLTIuNzEyLTQuODEtOC44MS02LjUxMS0xMy42MjMtMy43OTcgIGMtNC44MTEsMi43MTMtNi41MTEsOC44MTMtMy43OTcsMTMuNjIzbDcuNzUyLDEzLjc0NWwtMjQuNzI0LDEzLjk0NWwtNy43NTItMTMuNzQ1Yy0yLjcxMy00LjgxMi04LjgxMi02LjUxMy0xMy42MjMtMy43OTggIGMtNC44MSwyLjcxMy02LjUxMSw4LjgxMy0zLjc5NywxMy42MjJsNy43NTMsMTMuNzQ2bC0yNC43MjUsMTMuOTQ1bC03Ljc1My0xMy43NDVjLTIuNzEzLTQuODEzLTguODEyLTYuNTEzLTEzLjYyMi0zLjc5OCAgYy00LjgxMSwyLjcxMy02LjUxMSw4LjgxMy0zLjc5NywxMy42MjJsNy43NTMsMTMuNzQ2bC0zMy4wNjEsMTguNjQ3bC00Ni45ODYtODMuMzA5QzEzOC44MDEsODYuODI1LDE2My4xMzMsNjQuMDU1LDE5Mi41MzcsNDcuNDcxeiAgIE0xODMuMzQ5LDI5Ni42MzlsLTgyLjQ2Ny0xNDYuMjE2YzIuMzA5LTUuMjk1LDQuNzgxLTEwLjQ3LDcuNDA0LTE1LjVsOTIuMTgsMTYzLjQzOSAgQzE5NC43OTgsMjk3Ljk4OSwxODkuMDgyLDI5Ny40MTUsMTgzLjM0OSwyOTYuNjM5eiBNNzcuNjE5LDI2MC40MzhjMC4xMTctMTIuNjM3LDEuNzA5LTQ2LjcwNiwxNC4xOTUtODUuMzc0bDY2LjAxNywxMTcuMDUgIEMxMTguNDU3LDI4Mi44MTUsODguNTA2LDI2Ni43ODksNzcuNjE5LDI2MC40Mzh6IE0zNjguNTc5LDQ5MkgxNDMuNDE0di0xMy45NjdoMTU2Ljc1YzUuNTIzLDAsMTAtNC40NzgsMTAtMTBzLTQuNDc3LTEwLTEwLTEwICBoLTE1Ni43NXYtMTMuOTY2aDIyNS4xNjVMMzY4LjU3OSw0OTJMMzY4LjU3OSw0OTJ6IE0zMjIuOTk3LDQyNC4wNjdoLTEzNFYzOTdoMTM0VjQyNC4wNjd6IE0yNzUuODkyLDM3N2gtMzkuNzkxdi01OC42OTYgIGMxMy41ODQtMS4xMjQsMjYuODYyLTMuNDAzLDM5Ljc5MS02LjgyNlYzNzd6IE0zMTkuMzYxLDI3Mi4zMzVjLTI4Ljc5NywxNi4yNDEtNjAuMjk2LDI1LjE3MS05My42NzcsMjYuNTg3ICBjLTAuMDQsMC4wMDItMC4wOCwwLjAwMy0wLjEyMSwwLjAwNWMtMC41OTEsMC4wMjUtMS4xODMsMC4wNDctMS43NzUsMC4wNjdsLTQ2Ljg0Mi04My4wNTNsMzMuMDYxLTE4LjY0N2w3Ljc1MywxMy43NDYgIGMxLjgzNywzLjI1OSw1LjIyOCw1LjA5LDguNzE5LDUuMDljMS42NjQsMCwzLjM1MS0wLjQxNiw0LjkwMy0xLjI5MmM0LjgxMS0yLjcxMyw2LjUxMS04LjgxMywzLjc5Ny0xMy42MjJsLTcuNzUzLTEzLjc0NiAgbDI0LjcyNS0xMy45NDVsNy43NTMsMTMuNzQ2YzEuODM3LDMuMjU5LDUuMjI4LDUuMDksOC43MTksNS4wOWMxLjY2NCwwLDMuMzUtMC40MTYsNC45MDMtMS4yOTIgIGM0LjgxLTIuNzEzLDYuNTExLTguODEzLDMuNzk3LTEzLjYyMkwyNjkuNTcsMTYzLjdsMjQuNzI1LTEzLjk0NWw3Ljc1MywxMy43NDZjMS44MzcsMy4yNTgsNS4yMjgsNS4wODksOC43MTksNS4wODkgIGMxLjY2NCwwLDMuMzUxLTAuNDE2LDQuOTAzLTEuMjkyYzQuODExLTIuNzEzLDYuNTExLTguODEzLDMuNzk3LTEzLjYyM2wtNy43NTMtMTMuNzQ1bDMzLjA2MS0xOC42NDdsNDcuMzE5LDgzLjg5OSAgQzM3My40MTQsMjMzLjA2MiwzNDguOTcsMjU1LjYzNSwzMTkuMzYxLDI3Mi4zMzV6Ii8+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo=" />
                <div class="title m-b-md">
                    Sitio en Costrucción
                </div>
            </div>
        </div>
    </body>
</html>
