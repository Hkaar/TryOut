<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <meta name="author" content="Dimensi Pelajar">
  <meta name="description" content="Website ujian online untuk Dimensi Pelajar">
  <meta name="keywords" content="exam, online, online exam, ujian, ujian online, dimensi pelajar">
  <meta name="language" content="id">

  <meta property="og:title" content="Dimensi Pelajar">
  <meta property="og:description" content="Website ujian online untuk Dimensi Pelajar">
  <meta property="og:image" content="https://github.com/Hkaar/TryOut/blob/dev/.github/images/cover.png?raw=true">
  <meta property="og:url" content="https://dimensipelajar.com">
  <meta property="og:type" content="website">

  @yield('meta')

  <title>@yield('title')</title>

  @vite(['resources/css/app.css'])
  @stack('css')
</head>
<body class="overflow-x-hidden overflow-y-auto">

  @yield('content')

  @vite(['resources/js/app.js'])
  @stack('js')
</body>
</html>