<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
require_once(TEMPLATES_PATH . 'header.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);

class UserController
{
    private $conn;
    private $userRango;

    public function __construct()
    {
        if (!isset($_SESSION)) {
            session_start();
        }

        if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
            echo "<script>window.location.href = '/login.php';</script>";
            exit;
        }

        require_once(CONFIG_PATH . 'bd.php');
        $database = new Database();
        $this->conn = $database->getConnection();
        $this->loadUserRank();

        if (!isset($_SESSION['interface_selected'])) {
            // Rangos administrativos (mostrar 3 opciones)
            if (in_array($this->userRango, ['Web_master', 'manager', 'Owner', 'Administrador', 'Fundador', 'My_queen'])) {
                $this->showInterfaceSelector(true);
                exit;
            }
            // Rangos operativos (mostrar solo 2 opciones)
            elseif (in_array($this->userRango, ['Agente', 'Seguridad', 'Tecnico', 'Logistica', 'Supervisor', 'Director', 'Presidente', 'Operativo', 'Junta directiva'])) {
                $this->showInterfaceSelector(false);
                exit;
            }
            $_SESSION['interface_selected'] = 'user';
        }

        if ($_SESSION['interface_selected'] === 'admin') {
            header('Location: /usuario/administrativo/index.php');
            exit;
        }

        $this->loadMenu();
    }

    private function loadUserRank()
    {
        try {
            $query = "SELECT a.rango_actual 
                 FROM registro_usuario r
                 JOIN ascensos a ON r.codigo_time = a.codigo_time
                 WHERE r.id = :user_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':user_id', $_SESSION['user_id']);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->userRango = $row['rango_actual'] ?? 'Agente';
            $_SESSION['rango'] = $this->userRango;
        } catch (PDOException $e) {
            error_log("Error al obtener rango: " . $e->getMessage());
            $this->userRango = 'Agente';
            $_SESSION['rango'] = $this->userRango;
        }
    }

    private function loadMenu()
    {
        $menuMap = [
            'Agente' => 'menu_rango_bajos.php',
            'Seguridad' => 'menu_rango_bajos.php',
            'Tecnico' => 'menu_rango_bajos.php',
            'Logistica' => 'menu_rango_bajos.php',
            'Supervisor' => 'menu_rango_medios.php',
            'Director' => 'menu_rango_altos.php',
            'Presidente' => 'menu_rango_altos.php',
            'Operativo' => 'menu_rango_altos.php',
            'Junta directiva' => 'menu_rango_altos.php',
            'My_queen' => 'menu_rango_admin.php',
            'Administrador' => 'menu_rango_admin.php',
            'Manager' => 'menu_rango_admin.php',
            'Owner' => 'menu_rango_admin.php',
            'Fundador' => 'menu_rango_admin.php',
            'Web_master' => 'menu_rango_web.php'
        ];

        $menuFile = $menuMap[$this->userRango] ?? 'menu_rango_bajos.php';
        require_once(MENU_PATH . $menuFile);
    }

    private function showInterfaceSelector($showAdminOption)
    {
        echo '<div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="text-center mb-4">
                        <h2>Bienvenido ' . htmlspecialchars($_SESSION['username']) . '</h2>
                        <p>Por favor selecciona la interfaz que deseas utilizar</p>
                    </div>
                    <div class="row justify-content-center">';

        // Opción de Escritorio (siempre visible)
        echo '<div class="col-md-' . ($showAdminOption ? '4' : '6') . ' mb-3">
                <div class="card interface-card h-100" onclick="selectInterface(\'user\')">
                    <div class="card-body text-center">
                        <div class="icon-container">
                            <i class="bi bi-laptop"></i>
                        </div>
                        <h5 class="card-title">Escritorio</h5>
                        <p class="card-text">Interfaz completa para computadoras</p>
                    </div>
                </div>
              </div>';

        // Opción de Administración (solo para rangos altos)
        if ($showAdminOption) {
            echo '<div class="col-md-4 mb-3">
                <div class="card interface-card h-100" onclick="selectInterface(\'admin\')">
                    <div class="card-body text-center">
                        <div class="icon-container">
                            <i class="bi bi-gear-fill"></i>
                        </div>
                        <h5 class="card-title">Administración</h5>
                        <p class="card-text">Funciones avanzadas de gestión de usuarios, despidos, pagas, cambios de ascensos ect</p>
                    </div>
                </div>
              </div>';
        }

        // Opción de Móvil (siempre visible)
        echo '<div class="col-md-' . ($showAdminOption ? '4' : '6') . ' mb-3">
                <div class="card interface-card h-100" onclick="selectInterface(\'app\')">
                    <div class="card-body text-center">
                        <div class="icon-container">
                            <i class="bi bi-phone"></i>
                        </div>
                        <h5 class="card-title">Aplicación</h5>
                        <p class="card-text">Versión móvil optimizada (estado de pruebas)</p>
                    </div>
                </div>
              </div>';

        echo '</div></div></div>';

        // Estilos y script
        echo '<style>
            .interface-card {
                cursor: pointer;
                transition: transform 0.3s, border-color 0.3s;
                border: 2px solid transparent;
            }
            .interface-card:hover {
                transform: translateY(-5px);
                border-color: #0d6efd;
            }
            .card-body {
                padding: 2rem;
            }
            .icon-container {
                font-size: 3rem;
                color: #0d6efd;
                margin-bottom: 1rem;
            }
        </style>

        <script>
        function selectInterface(type) {
            const formData = new FormData();
            formData.append("interface", type);

            fetch(window.location.href, {
                method: "POST",
                body: formData,
                credentials: "same-origin"
            })
            .then(response => {
                if (type === "admin") {
                    window.location.href = "/usuario/administrativo/index.php";
                } else if (type === "app") {
                    window.location.href = "/usuario/app/index.php";
                } else {
                    window.location.href = "/usuario/index.php";
                }
            })
            .catch(error => {
                console.error("Error:", error);
                alert("Ocurrió un error al seleccionar la interfaz. Por favor, intenta nuevamente.");
            });
        }
        </script>';
    }

    public function handleSearch()
    {
        if (!isset($_GET['q']) || empty($_GET['q'])) {
            return;
        }

        $query = strtolower(trim($_GET['q']));
        $pages = [
            'GSTM.php' => 'gestion_de_tiempo',
            'USR.php' => 'inicio',
            'PRUS.php' => 'ver_perfil',
            'CRSS.php' => 'cerrar_session',
            'RQPG.php' => 'requisitos_paga',
            'GSAS.php' => 'gestion_ascenso',
            'HISA.php' => 'ver_mis_ascensos',
            'HIST.php' => 'ver_mis_tiempos',
            'MEMS.php' => 'membresias',
            'GTPS.php' => 'gestion_de_pagas',
            'VTM.php' => 'ventas_membresias',
            'VTR.php' => 'venta_rangos',
            'GTNT.php' => 'gestion_de_notificaciones',
        ];

        $results = [];
        foreach ($pages as $file => $title) {
            if (file_exists($file)) {
                $content = file_get_contents($file);
                preg_match('/<meta name="keywords" content="([^"]+)"/', $content, $matches);

                if (!empty($matches[1])) {
                    $keywords = explode(',', strtolower($matches[1]));
                    foreach ($keywords as $keyword) {
                        similar_text($query, $keyword, $percentage);
                        if ($percentage > 60 || strpos($keyword, $query) !== false) {
                            $results[] = ['title' => $title, 'url' => 'index.php?page=' . urlencode($title)];
                            break;
                        }
                    }
                }
            }
        }

        $this->renderSearchResults($query, $results);
    }

    private function renderSearchResults($query, $results)
    {
        echo '<div class="search-results-container">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-gradient-primary">
                    <h4 class="text-white mb-0"><i class="bi bi-search me-2"></i>Resultados para: "' . htmlspecialchars($query) . '"</h4>
                </div>
                <div class="card-body">';

        if (!empty($results)) {
            $this->renderResultsList($results);
        } else {
            $this->renderNoResults();
        }

        echo '</div></div></div>';
    }

    private function renderResultsList($results)
    {
        echo '<div class="results-list">';
        foreach ($results as $result) {
            echo '<a href="' . $result['url'] . '" class="result-item">
                <div class="d-flex align-items-center p-3 border-bottom transition-hover">
                    <i class="bi bi-link-45deg me-3 text-primary"></i>
                    <div><h5 class="mb-0">' . ucfirst($result['title']) . '</h5></div>
                    <i class="bi bi-chevron-right ms-auto text-muted"></i>
                </div>
            </a>';
        }
        echo '</div>';
    }

    private function renderNoResults()
    {
        echo '<div class="text-center p-4">
            <i class="bi bi-search-x fa-3x text-muted mb-3"></i>
            <div class="alert alert-warning mb-0">
                <h5 class="alert-heading">No se encontraron resultados</h5>
                <p class="mb-0">Intenta con otros términos de búsqueda</p>
            </div>
        </div>';
    }

    public function handlePageLoad()
    {
        if (!isset($_GET['page'])) {
            include 'USR.php';
            return;
        }

        $page = $_GET['page'];
        $validPages = $this->getValidPages();

        if (array_key_exists($page, $validPages) && in_array($this->userRango, $validPages[$page]['roles'])) {
            include $validPages[$page]['file'];
        } else {
            $this->renderAccessDenied();
        }
    }

    private function getValidPages()
    {
        return [
            'inicio' => ['file' => 'USR.php', 'roles' => $this->getAllRoles()],
            'ver_perfil' => ['file' => 'PRUS.php', 'roles' => $this->getAllRoles()],
            'cerrar_session' => ['file' => 'CRSS.php', 'roles' => $this->getAllRoles()],
            'requisitos_paga' => ['file' => 'RQPG.php', 'roles' => $this->getAllRoles()],
            'gestion_ascenso' => ['file' => 'GSAS.php', 'roles' => $this->getLogisticsAndAboveRoles()],
            'ver_mis_tiempos' => ['file' => 'HIST.php', 'roles' => $this->getLogisticsAndAboveRoles()],
            'ver_mis_ascensos' => ['file' => 'HISA.php', 'roles' => $this->getLogisticsAndAboveRoles()],
            'gestion_de_tiempo' => ['file' => 'GSTM.php', 'roles' => $this->getDirectorAndAboveRoles()],
            'gestion_de_pagas' => ['file' => 'GTPS.php', 'roles' => $this->getAdminRoles()],
            'gestion_de_notificaciones' => ['file' => 'GTNT.php', 'roles' => $this->getAdminRoles()],
            'ventas_membresias' => ['file' => 'VTM.php', 'roles' => $this->getAdminRoles()],
            'ventas_rangos_y_traslados' => ['file' => 'VTR.php', 'roles' => $this->getAdminRoles()]
        ];
    }

    private function getAllRoles()
    {
        return [
            'Web_master',
            'web_master',
            'Agente',
            'agente',
            'Seguridad',
            'seguridad',
            'Tecnico',
            'tecnico',
            'Logistica',
            'logistica',
            'Supervisor',
            'supervisor',
            'Director',
            'director',
            'Presidente',
            'presidente',
            'Operativo',
            'operativo',
            'Junta directiva',
            'junta directiva',
            'Administrador',
            'administrador',
            'Manager',
            'manager',
            'Owner',
            'owner',
            'Fundador',
            'fundador',
            'My_queen',
            'my_queen'
        ];
    }

    private function getLogisticsAndAboveRoles()
    {
        return [
            'Web_master',
            'web_master',
            'Logistica',
            'logistica',
            'Supervisor',
            'supervisor',
            'Operativo',
            'operativo',
            'Director',
            'director',
            'Presidente',
            'presidente',
            'Junta directiva',
            'junta directiva',
            'Administrador',
            'administrador',
            'Manager',
            'manager',
            'Owner',
            'owner',
            'Fundador',
            'fundador',
            'My_queen',
            'my_queen'
        ];
    }

    private function getDirectorAndAboveRoles()
    {
        return [
            'Web_master',
            'web_master',
            'Director',
            'director',
            'Presidente',
            'presidente',
            'Operativo',
            'operativo',
            'Junta directiva',
            'junta directiva',
            'Administrador',
            'administrador',
            'Manager',
            'manager',
            'Owner',
            'owner',
            'Fundador',
            'fundador',
            'My_queen',
            'my_queen'
        ];
    }

    private function getAdminRoles()
    {
        return [
            'Web_master',
            'web_master',
            'Administrador',
            'administrador',
            'Manager',
            'manager',
            'Owner',
            'owner',
            'Fundador',
            'fundador',
            'My_queen',
            'my_queen'
        ];
    }

    private function renderAccessDenied()
    {
        $rango = $this->userRango ?? 'Agente';
        echo '<div class="alert alert-danger text-center mt-5">
            <h4 class="alert-heading">Acceso Denegado</h4>
            <p>No tienes los permisos necesarios para acceder a esta página o la página no existe.</p>
            <p>Tu rango actual es: ' . htmlspecialchars($rango) . '</p>
            <p>Redirigiendo a la página principal...</p>
        </div>
        <meta http-equiv="refresh" content="3;url=index.php">';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['interface'])) {
    session_start();
    $_SESSION['interface_selected'] = $_POST['interface'];
    header('Content-Type: application/json');
    echo json_encode(['success' => true]);
    exit;
}

$controller = new UserController();
?>

<body>
    <div class="page-container">
        <div class="container mt-5 mb-5">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <?php
                    if (isset($_GET['q'])) {
                        $controller->handleSearch();
                    } else {
                        $controller->handlePageLoad();
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div id="loader-wrapper" class="loader-wrapper">
        <div class="loader">
            <div class="loader-ring"></div>
            <div class="loader-ring-inner"></div>
        </div>
    </div>

    <?php require_once(TEMPLATES_PATH . 'footer.php'); ?>

    <script>
        window.addEventListener('load', function() {
            const loader = document.getElementById('loader-wrapper');
            loader.classList.add('fade-out');
            setTimeout(() => {
                loader.style.display = 'none';
            }, 300);
        });

        document.addEventListener('click', function(e) {
            const link = e.target.closest('a');
            if (link && !link.hasAttribute('target') && link.href.indexOf('#') === -1) {
                const loader = document.getElementById('loader-wrapper');
                loader.style.display = 'flex';
                loader.classList.remove('fade-out');
            }
        });
    </script>
</body>