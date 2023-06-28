<?php

namespace Controllers;

use Classes\Paginacion;
use Model\Ponentes;
use MVC\Router;
use Intervention\Image\ImageManager;

class PonentesController
{

    public static function index(Router $router)
    {
        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual,FILTER_VALIDATE_INT);
        if(!$pagina_actual || $pagina_actual < 1){
            if(!is_admin()) header("Location:/admin/ponentes?page=1");
        }
        $regisro_por_pagina = 5;
        $total=Ponentes::total();
        $paginacion = new Paginacion($pagina_actual,$regisro_por_pagina,$total);
        
        if ($paginacion->total_paginas() < $pagina_actual)  header("Location:/admin/ponentes?page=1");

        if(!is_admin()) header("Location:/login");
       
        $ponentes = Ponentes::paginar($regisro_por_pagina, $paginacion->offset());

        $router->render('admin/ponentes/index', [
            'titulo' => 'Ponentes / Conferencista',
            'ponentes' => $ponentes,
            'paginacion'=> $paginacion->paginacion()
        ]);
    }
    public static function crear(Router $router)
    {
        if(!is_admin()) header("Location:/login");
        $alertas = [];
        $ponente = new Ponentes;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!is_admin()) header("Location:/login");
            if ($_FILES['imagen']['tmp_name']) {
                $carpeta_imagenes = '../public/img/speakers';

                // Crear la carpeta si no existe
                if (!is_dir($carpeta_imagenes)) {
                    mkdir($carpeta_imagenes, 0755, true);
                }

                $image = new ImageManager();
                $imagen_png =  $image->make($_FILES['imagen']['tmp_name'])->fit(800, 800)->encode('png', 80);
                $imagen_webp =  $image->make($_FILES['imagen']['tmp_name'])->fit(800, 800)->encode('webp', 80);

                $nombre_imagen = md5(uniqid(rand(), true));
                $_POST['imagen'] = $nombre_imagen;
            } else {
                $_POST['imagen'] = '';
            }
            $_POST['redes'] = json_encode($_POST['redes'], JSON_UNESCAPED_SLASHES);
            if (empty($alertas)) {
                if(isset($nombre_imagen)){
                    $imagen_png->save($carpeta_imagenes . '/' . $nombre_imagen . '.png');
                    $imagen_webp->save($carpeta_imagenes . '/' . $nombre_imagen . '.webp');
                }
                
                $resultado = $ponente->guardar();
                if ($resultado) {
                    header('Location:/admin/ponentes');
                }
            }
            $ponente->sincronizar($_POST);
            $alertas = $ponente->validar();
        }
        $router->render('admin/ponentes/crear', [
            'titulo' => 'Registrar Ponente',
            'alertas' => $alertas,
            'ponente' => $ponente,
            'redes' => json_decode($ponente->redes)
        ]);
    }
    public static function editar(Router $router)
    {
        if(!is_admin()) header("Location:/login");
        $alertas = [];

        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if (!$id) {
            header('Location: /admin/ponentes');
        }

        $ponente = Ponentes::find($id);

        if (!$ponente) {
            header('Location: /admin/ponentes');
        }

        $ponente->imagen_acutal = $ponente->imagen;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!is_admin()) header("Location:/login");
            if ($_FILES['imagen']['tmp_name']) {
                $image = new ImageManager();
                $imagen_png =  $image->make($_FILES['imagen']['tmp_name'])->fit(800, 800)->encode('png', 80);
                $imagen_webp =  $image->make($_FILES['imagen']['tmp_name'])->fit(800, 800)->encode('webp', 80);

                $nombre_imagen = md5(uniqid(rand(), true));
                $_POST['imagen'] = $nombre_imagen;
                if ($_FILES['imagen']['tmp_name']) {
                    $carpeta_imagenes = '../public/img/speakers';

                    // Crear la carpeta si no existe
                    if (!is_dir($carpeta_imagenes)) {
                        mkdir($carpeta_imagenes, 0755, true);
                    }

                    $image = new ImageManager();
                    $imagen_png =  $image->make($_FILES['imagen']['tmp_name'])->fit(800, 800)->encode('png', 80);
                    $imagen_webp =  $image->make($_FILES['imagen']['tmp_name'])->fit(800, 800)->encode('webp', 80);

                    $nombre_imagen = md5(uniqid(rand(), true));
                    $_POST['imagen'] = $nombre_imagen;
                   
                } else {
                    $_POST['imagen'] = $ponente->imagen_actual;
                }
            }
            $_POST['redes'] = json_encode($_POST['redes'],JSON_UNESCAPED_SLASHES);
            $ponente->sincronizar($_POST);
            $alertas = $ponente->validar();
            if (empty($alertas)) {
                if(isset($nombre_imagen)){
                    $imagen_png->save($carpeta_imagenes . '/' . $nombre_imagen . '.png');
                    $imagen_webp->save($carpeta_imagenes . '/' . $nombre_imagen . '.webp');
                }
                $resultado=$ponente->guardar();
                if($resultado){
                    header('Location: /admin/ponentes');
                }
            }
        }
        $router->render('admin/ponentes/editar', [
            'titulo' => 'Actualizar',
            'alertas' => $alertas,
            'ponente' => $ponente ?? null,
            'redes' => json_decode($ponente->redes)
        ]);
    }
    public static function eliminar (){
        if(!is_admin()) header("Location:/login");
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $_POST['id'];
            $ponente= Ponentes::find($id);
            if(isset($ponente)){
                header('Location: /admin/ponentes');
            }
            $resultado= $ponente -> eliminar();
            if ($resultado){
                header('Location: /admin/ponentes');
            }
            debuguear($id);
        }
    }
}
