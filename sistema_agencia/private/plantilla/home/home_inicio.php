
<?php

class BodyHome
{
    public function render()
    {
        echo '<body class="d-flex flex-column h-100 bg-light">';
        $this->renderLoader(); // Añadimos el loader antes de cualquier contenido
        $this->renderHeader();
        $this->renderAboutSection();
        $this->renderTeamSection();
        $this->renderBlogSection();
        $this->renderHabboPlatesSection();
        $this->renderEventsSection();
        echo '</body>';
    }
    
    // Nuevo método para renderizar el loader
    private function renderLoader()
    {
        echo '<div id="preloader" class="preloader">
            <div class="triangle-loader">
                <div class="triangle">
                    <div class="led led-1"></div>
                    <div class="led led-2"></div>
                    <div class="led led-3"></div>
                    <div class="led led-4"></div>
                    <div class="led led-5"></div>
                    <div class="led led-6"></div>
                    <div class="led led-7"></div>
                    <div class="led led-8"></div>
                    <div class="led led-9"></div>
                </div>
                <div class="loading-text">Bienvenido a Agencia Shein</div>
            </div>
        </div>
        
        <style>
        .preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #000000; /* Fondo totalmente negro */
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transition: opacity 0.5s ease-out;
        }
        
        .triangle-loader {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        
        .triangle {
            width: 0;
            height: 0;
            border-left: 80px solid transparent;
            border-right: 80px solid transparent;
            border-bottom: 140px solid #2541b2;
            position: relative;
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }
        
        .led {
            position: absolute;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background-color: #fff;
            box-shadow: 0 0 10px 2px #4a6bff, 0 0 20px 5px rgba(74, 107, 255, 0.5);
            animation: blink 1.5s infinite alternate;
        }
        
        .led-1 { top: 20px; left: -70px; animation-delay: 0s; }
        .led-2 { top: 50px; left: -60px; animation-delay: 0.2s; }
        .led-3 { top: 80px; left: -40px; animation-delay: 0.4s; }
        .led-4 { top: 110px; left: -20px; animation-delay: 0.6s; }
        .led-5 { top: 130px; left: 0; animation-delay: 0.8s; }
        .led-6 { top: 110px; right: -20px; animation-delay: 1s; }
        .led-7 { top: 80px; right: -40px; animation-delay: 1.2s; }
        .led-8 { top: 50px; right: -60px; animation-delay: 1.4s; }
        .led-9 { top: 20px; right: -70px; animation-delay: 1.6s; }
        
        @keyframes blink {
            0% { opacity: 0.3; box-shadow: 0 0 5px 1px #4a6bff, 0 0 10px 2px rgba(74, 107, 255, 0.3); }
            100% { opacity: 1; box-shadow: 0 0 15px 3px #4a6bff, 0 0 30px 8px rgba(74, 107, 255, 0.7); }
        }
        
        .loading-text {
            margin-top: 30px;
            color: #fff;
            font-size: 24px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 3px;
            animation: glow 1.5s infinite alternate;
        }
        
        @keyframes glow {
            0% { text-shadow: 0 0 5px #4a6bff, 0 0 10px #4a6bff; }
            100% { text-shadow: 0 0 10px #4a6bff, 0 0 20px #4a6bff, 0 0 30px #4a6bff; }
        }
        </style>
        
        <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Ocultar el preloader después de que la página se cargue completamente
            setTimeout(function() {
                const preloader = document.getElementById("preloader");
                preloader.style.opacity = "0";
                setTimeout(function() {
                    preloader.style.display = "none";
                }, 500);
            }, 1500); // Ajusta este tiempo según lo desees (1.5 segundos en este caso)
        });
        </script>';
    }
    
    // El resto de los métodos permanecen igual
    private function renderHeader()
    {
        echo '<main class="flex-shrink-0">';
        echo '<header class="bg-gradient-primary text-white py-5">';
        echo '<div class="container text-center">';
        echo '<h1 class="display-4 fw-bold mb-3">';
        echo '<i class="bi bi-stars me-2"></i>Agencia Shein<i class="bi bi-stars ms-2"></i>';
        echo '</h1>';
        echo '<p class="lead mb-4">La mejor comunidad de Habbo Hotel</p>';
        echo '<a href="/login.php" class="btn btn-light btn-lg rounded-pill px-4">¡Únete ahora!</a>';
        echo '</div>';
        echo '</header>';
        echo '</main>';
    }

    private function renderTeamSection()
    {
        $teamMembers = [
            [
                'id' => '1',
                'name' => 'Jo.C',
                'image' => 'https://www.habbo.es/habbo-imaging/avatarimage?user=Jo.C&headonly=1&head_direction=3&size=sl1',
                'rank' => 'Founder',
            ],
            [
                'id' => '2',
                'name' => 'Snotra',
                'image' => 'https://www.habbo.es/habbo-imaging/avatarimage?user=Snotra&headonly=1&head_direction=3&size=sl',
                'rank' => 'Founder',
            ],
            [
                'id' => '4',
                'name' => 'BigBarneyStinso',
                'image' => 'https://www.habbo.es/habbo-imaging/avatarimage?user=BigBarneyStinso&headonly=1&head_direction=3&size=sl',
                'rank' => 'Manager',
            ],
            [
                'id' => '5',
                'name' => 'Nefita',
                'image' => 'https://www.habbo.es/habbo-imaging/avatarimage?user=Nefita&headonly=1&head_direction=3&size=sl',
                'rank' => 'Manager',
            ],
            [
                'id' => '6',
                'name' => 'Keekit08',
                'image' => 'https://www.habbo.es/habbo-imaging/avatarimage?user=Keekit08&headonly=1&head_direction=3&size=sl',
                'rank' => 'Administrador',
            ],
            [
                'id' => '7',
                'name' => 'juancBQ',
                'image' => 'https://www.habbo.es/habbo-imaging/avatarimage?user=juancBQ&headonly=1&head_direction=3&size=sl',
                'rank' => 'Administrador',
            ],
            [
                'id' => '8',
                'name' => 'mutilla_',
                'image' => 'https://www.habbo.es/habbo-imaging/avatarimage?user=mutilla_&headonly=1&head_direction=3&size=sl',
                'rank' => 'Administrador',
            ],
            [
                'id' => '9',
                'name' => 'Vanderlind',
                'image' => 'https://www.habbo.es/habbo-imaging/avatarimage?user=Vanderlind&headonly=1&head_direction=3&size=sl',
                'rank' => 'Administrador',
            ],
            [
                'id' => '10',
                'name' => 'maria51162',
                'image' => 'https://www.habbo.es/habbo-imaging/avatarimage?user=maria51162&headonly=1&head_direction=3&size=sl',
                'rank' => 'Administradora',
            ],
        ];

            echo '<section class="team-section py-3 py-md-5" style="background: #ffffff;">';
            echo '<div class="container">';
            echo '<h2 class="text-center mb-3 mb-md-5" style="color: #2541b2; font-weight: 700; font-size: clamp(1.2rem, 4vw, 1.8rem);">';
            echo '<i class="bi bi-people-fill me-2" style="color: #4a6bff;"></i>';
            echo 'Nuestro Equipo';
            echo '<i class="bi bi-people-fill ms-2" style="color: #4a6bff;"></i>';
            echo '</h2>';
            echo '<div class="row justify-content-center g-2 g-md-3">';

            foreach ($teamMembers as $member) {
                echo '<div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-2 mb-md-3 text-center">';
                echo '<div style="display: inline-block; width: 100%; max-width: 100px;">';
                // Añadido atributo alt descriptivo para el avatar del miembro del equipo
                echo '<img src="' . $member['image'] . '" alt="Avatar de Habbo de ' . htmlspecialchars($member['name']) . '" style="width: 100%; height: auto; aspect-ratio: 1/1; border-radius: 50%; object-fit: cover; border: 2px solid #4a6bff;">';
                echo '<div class="mt-1 mt-md-2">';
                echo '<div style="color: #2541b2; font-weight: 600; font-size: clamp(0.6rem, 2vw, 0.8rem); word-break: break-word;">' . $member['name'] . '</div>';
                echo '<div style="color: #4a6bff; font-size: clamp(0.5rem, 1.8vw, 0.7rem);">' . $member['rank'] . '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            
            echo '</div></div></section>';
    }

    private function renderEventsSection()
    {
        $events = [
            ['title' => 'Fiesta de Bienvenida', 'description' => 'Conoce a todos los miembros de Agencia Shein en nuestra fiesta de bienvenida', 'date' => '15 de Marzo, 2025', 'image' => 'https://api.a0.dev/assets/image?text=Habbo%20party%20room%20with%20lots%20of%20avatars%20dancing&aspect=16:9'],
            ['title' => 'Concurso de Construcción', 'description' => 'Muestra tus habilidades de construcción y gana premios increíbles', 'date' => '22 de Marzo, 2025', 'image' => 'https://api.a0.dev/assets/image?text=Habbo%20building%20competition%20with%20furniture%20and%20decorations&aspect=16:9'],
            ['title' => 'Carrera de Obstáculos', 'description' => 'Supera todos los obstáculos en el menor tiempo posible', 'date' => '29 de Marzo, 2025', 'image' => 'https://api.a0.dev/assets/image?text=Habbo%20obstacle%20course%20with%20traps%20and%20challenges&aspect=16:9'],
        ];

        echo '<section style="background: #f8f9fa; padding: 50px 0;">';
        echo '<div class="container text-center">';
        echo '<h2 style="color: #2541b2; font-weight: 700; margin-bottom: 40px;"><i class="bi bi-calendar-event me-2"></i>Próximos Eventos<i class="bi bi-calendar-event ms-2"></i></h2>';
        echo '<div class="row">';

        foreach ($events as $event) {
            echo '<div class="col-md-4 mb-4">';
            echo '<div style="background: white; padding: 25px; border-radius: 20px; box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05); height: 100%; transition: all 0.3s ease;">';
            // Añadido atributo alt descriptivo para la imagen del evento
            echo '<img src="' . $event['image'] . '" alt="' . htmlspecialchars($event['title']) . '" style="width: 100%; height: 180px; border-radius: 15px; object-fit: cover; margin-bottom: 20px;">';
            echo '<h3 style="color: #2541b2; font-weight: 600;">' . $event['title'] . '</h3>';
            echo '<p style="color: #555; margin: 15px 0;">' . $event['description'] . '</p>';
            echo '<span style="background: linear-gradient(45deg, #4a6bff, #2541b2); color: white; padding: 8px 16px; border-radius: 20px; font-weight: 500;">📅 ' . $event['date'] . '</span>';
            echo '</div>';
            echo '</div>';
        }
        echo '</div>';
        echo '</div>';
        echo '</section>';
    }

    private function renderAboutSection()
    {
        echo '<section style="background: #ffffff; padding: 50px 0;">';
        echo '<div class="container">';
        echo '<h2 style="color: #2541b2; font-weight: 700; margin-bottom: 40px; text-align: center;"><i class="bi bi-info-circle me-2"></i>Sobre Nosotros<i class="bi bi-info-circle ms-2"></i></h2>';
        echo '<div class="row">';
        echo '<div class="col-md-6">';
        echo '<img src="https://i.postimg.cc/267B81Gt/agencia2.webp" alt="Imagen de la comunidad Agencia Shein en Habbo" style="width: 100%; border-radius: 15px;" class="d-none d-md-block">';
        echo '</div>';
        echo '<div class="col-md-6">';
        echo '<h3 style="color: #2541b2; font-weight: 600;">Nuestra Historia</h3>';
        echo '<p style="color: #555;">Agencia Shein es una comunidad vibrante en Habbo Hotel que se dedica a crear experiencias únicas para nuestros usuarios. Desde nuestro inicio en 2025, hemos crecido hasta convertirnos en una de las agencias más reconocidas en el mundo de Habbo.</p>';
        echo '<h3 style="color: #2541b2; font-weight: 600; margin-top: 30px;">Nuestra Misión</h3>';
        echo '<p style="color: #555;">Nuestro objetivo es proporcionar un espacio seguro y divertido donde los usuarios puedan interactuar, participar en eventos emocionantes y desarrollar sus habilidades dentro del juego.</p>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</section>';
    }

    private function renderBlogSection()
    {
        echo '<section style="background: #ffffff; padding: 50px 0;">';
        echo '<div class="container">';
        echo '<h2 style="color: #2541b2; font-weight: 700; margin-bottom: 40px; text-align: center;"><i class="bi bi-newspaper me-2"></i>Blog<i class="bi bi-newspaper ms-2"></i></h2>';
        
        // Sección de Noticias
        echo '<div class="mb-5">';
        echo '<div class="row">';
        
        $noticias = [
            [
                'title' => 'Nuevas Actualizaciones',
                'description' => 'Descubre las últimas novedades en Habbo Hotel',
                'image' => 'https://api.a0.dev/assets/image?text=Habbo%20news&aspect=16:9'
            ],
            [
                'title' => 'Nuevo Sistema de Recompensas',
                'description' => 'Conoce el nuevo sistema de recompensas diarias',
                'image' => 'https://api.a0.dev/assets/image?text=Habbo%20rewards&aspect=16:9'
            ],
            [
                'title' => 'Mejoras en la Comunidad',
                'description' => 'Descubre las mejoras implementadas en la comunidad',
                'image' => 'https://api.a0.dev/assets/image?text=Habbo%20community&aspect=16:9'
            ]
        ];
    
        foreach ($noticias as $noticia) {
            echo '<div class="col-md-4 mb-4">';
            echo '<div style="background: white; padding: 25px; border-radius: 20px; box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05); height: 100%;">';
            // Añadido atributo alt descriptivo para la imagen de la noticia
            echo '<img src="' . $noticia['image'] . '" alt="' . htmlspecialchars($noticia['title']) . '" style="width: 100%; height: 180px; border-radius: 15px; object-fit: cover; margin-bottom: 20px;">';
            echo '<h4 style="color: #2541b2; font-weight: 600;">' . $noticia['title'] . '</h4>';
            echo '<p style="color: #555;">' . $noticia['description'] . '</p>';
            echo '<a href="#" style="background: linear-gradient(45deg, #4a6bff, #2541b2); color: white; padding: 8px 16px; border-radius: 20px; font-weight: 500; text-decoration: none;">Leer más</a>';
            echo '</div>';
            echo '</div>';
        }
        
        echo '</div>';
        echo '</div>';
        echo '</section>';
    }

    private function renderHabboPlatesSection()
    {
        echo '<section style="background: #f8f9fa; padding: 50px 0;">';
        echo '<div class="container">';
        echo '<h2 style="color: #2541b2; font-weight: 700; margin-bottom: 40px; text-align: center;"><i class="bi bi-award me-2"></i>Nuevas Placas de Habbo<i class="bi bi-award ms-2"></i></h2>';
        echo '<div class="row">';
    
        $plates = [
            [
                'name' => 'Placa de Oro',
                'description' => 'La nueva placa de oro para los mejores constructores',
                'release_date' => '10 de Octubre, 2024',
                'image' => 'https://api.a0.dev/assets/image?text=Habbo%20gold%20plate&aspect=16:9'
            ],
            [
                'name' => 'Placa de Plata',
                'description' => 'Placa de plata para los usuarios destacados',
                'release_date' => '15 de Noviembre, 2024',
                'image' => 'https://api.a0.dev/assets/image?text=Habbo%20silver%20plate&aspect=16:9'
            ],
            [
                'name' => 'Placa de Bronce',
                'description' => 'Placa de bronce para los usuarios activos',
                'release_date' => '20 de Diciembre, 2024',
                'image' => 'https://api.a0.dev/assets/image?text=Habbo%20bronze%20plate&aspect=16:9'
            ]
        ];
    
        foreach ($plates as $plate) {
            echo '<div class="col-md-4 mb-4">';
            echo '<div style="background: white; padding: 25px; border-radius: 20px; box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05); height: 100%; transition: all 0.3s ease;">';
            // Añadido atributo alt descriptivo para la imagen de la placa
            echo '<img src="' . $plate['image'] . '" alt="' . htmlspecialchars($plate['name']) . '" style="width: 100%; height: 180px; border-radius: 15px; object-fit: cover; margin-bottom: 20px;">';
            echo '<h3 style="color: #2541b2; font-weight: 600;">' . $plate['name'] . '</h3>';
            echo '<p style="color: #555; margin: 15px 0;">' . $plate['description'] . '</p>';
            echo '<span style="background: linear-gradient(45deg, #4a6bff, #2541b2); color: white; padding: 8px 16px; border-radius: 20px; font-weight: 500;">📅 ' . $plate['release_date'] . '</span>';
            echo '</div>';
            echo '</div>';
        }
    
        echo '</div>';
        echo '</div>';
        echo '</section>';
    }

    // Eliminar la función renderTestimonialsSection()
}

$bodyHome = new BodyHome();
$bodyHome->render();
