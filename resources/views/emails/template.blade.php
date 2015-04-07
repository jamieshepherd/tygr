<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>@yield('title')</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
            font-size: 100%;
            line-height: 1.6;
        }
        body {
            -webkit-font-smoothing: antialiased;
            -webkit-text-size-adjust: none;
            width: 100%!important;
            height: 100%;
            padding: 20px;
        }
        h1 {
            font-size: 36px;
        }
        h2 {
            font-size: 28px;
        }
        p, ul, li {
            font-weight: normal;
            font-size: 14px;
        }
        ul {
            padding: 20px;
        }
        table.body-wrap {
            width: 100%;
        }
    </style>
</head>

<table class="body-wrap">
    @yield('body')
</table>

</body>
</html>
