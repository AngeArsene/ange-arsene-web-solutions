<!DOCTYPE html>
<html lang="en">

{{head}}

<body class="starter-page-page">

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="/#hero" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="sitename">A.A.W.S</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="/#hero">Home</a></li>
          <li><a href="/#about">About</a></li>
          <li><a href="/#skills">Skills</a></li>
          <li><a href="/#services">Services</a></li>
          <li><a href="/#contact">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" href="#about">Get Started</a>

    </div>
  </header>

  <main class="main">

    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
      <div class="container">
        <nav class="breadcrumbs">
          <ol>
            <li><a href="/">Home</a></li>
            <li class="current">Error Page</li>
          </ol>
        </nav>
        <h1><?= $label ?></h1>
      </div>
    </div><!-- End Page Title -->

    {{content}}

  </main>

  {{footer}}

  {{foot}}

</body>

</html>