<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funcionário - Beauty Salon</title>

    <!--Boostrap-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Favicon -->
    <link rel="shortcut icon" href="./Logo/Letra.svg" type="image/x-icon">

    <!-- Custom styles -->
    <link rel="stylesheet" href="./Home/css/style.min.css">
    <link rel="stylesheet" href="./Paginas/cssPagina.css">

    <link href="https://fonts.googleapis.com/css?family=Crimson+Text:400,400i,600|Montserrat:200,300,400" rel="stylesheet">

</head>

<body>
    <div class="layer"></div>
    <!-- ! Body -->
    <a class="skip-link sr-only" href="#skip-target">Skip to content</a>
    <div class="page-flex">
        <!-- ! Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-start">
                <div class="sidebar-head">
                    <a href="/" class="logo-wrapper" title="Home">
                        <span class="sr-only">Home</span>
                        <span class="icon logo"> <img src="Logo/LogoBranca.svg" alt=""></span>
                        <div class="logo-text">
                            <span class="logo-title">Beauty</span>
                            <span class="logo-subtitle">Beauty Salon</span>
                        </div>

                    </a>
                    <button class="sidebar-toggle transparent-btn" title="Menu" type="button">
                        <span class="sr-only">Toggle menu</span>
                        <span class="icon menu-toggle" aria-hidden="true"></span>
                    </button>
                </div>
                <div class="sidebar-body">
                    <ul class="sidebar-body-menu">

                        <li>
                            <a class="active" href="index.html"><span class="icon home" aria-hidden="true"></span>Início</a>
                        </li>




                    </ul>

                </div>
            </div>
        </aside>
        <div class="main-wrapper">


            <!-- ! Main nav -->
            <nav class="main-nav--bg">
                <div class="container main-nav">
                    <div class="main-nav-start">

                    </div>
                    <div class="main-nav-end">
                        <button class="sidebar-toggle transparent-btn" title="Menu" type="button">
                            <span class="sr-only">Toggle menu</span>
                            <span class="icon menu-toggle--gray" aria-hidden="true"></span>
                        </button>

                        <div class="nav-user-wrapper">
                            <button href="##" class="nav-user-btn dropdown-btn" title="My profile" type="button">
                                <span class="sr-only">My profile</span>
                                <span class="nav-user-img">
                                    <picture>
                                        <source srcset="./Home/img/avatar/avatar-illustrated-02.webp" type="image/webp">
                                        <img src="./Home/img/avatar/avatar-illustrated-02.png" alt="User name">
                                    </picture>
                                </span>
                            </button>
                            <ul class="users-item-dropdown nav-user-dropdown dropdown">
                                <li>
                                    <a href="##">
                                        <i data-feather="user" aria-hidden="true"></i>
                                        <span>Profile</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>


            <!-- ! Main -->
            <main class="main users chart-page" id="skip-target">
                <div class="container">
                    <h2 class="main-title">Horário</h2>

                    <div class="row">
                        <div class="col-lg-12">
                            <article class="stat-cards-item" id="tamanho">
                                <div class="stat-cards-info" id="tamanho">

                                    <h5>Listagem de Funcionários</h2>
                                        <hr>
                                        <div class="col-lg-16">
                                            <article class="stat-cards-item ">
                                                <div class="stat-cards-info" id="tamanho">

                                                    <?php include("./Paginas/VerHorarios.php"); ?>
                                                </div>
                                            </article>
                                        </div>
                                </div>

                                <br>

                        </div>
                        </article>
                    </div>

                </div>
            </main>
            <!-- ! Footer -->
            <footer class="footer">
                <div class="container footer--flex">
                    <div class="footer-start">
                        <p>2021 © Elegant Dashboard - <a href="elegant-dashboard.com" target="_blank" rel="noopener noreferrer">elegant-dashboard.com</a></p>
                    </div>
                    <ul class="footer-end">
                        <li><a href="##">About</a></li>
                        <li><a href="##">Support</a></li>
                        <li><a href="##">Puchase</a></li>
                    </ul>
                </div>
            </footer>
        </div>
    </div>
    <!-- Chart library -->
    <script src="./Home/plugins/chart.min.js"></script>
    <!-- Icons library -->
    <script src="./Home/plugins/feather.min.js"></script>
    <!-- Custom scripts -->
    <script src="./Home/js/script.js"></script>
</body>

</html>