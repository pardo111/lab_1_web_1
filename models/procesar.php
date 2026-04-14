<?php
header('Content-Type: application/json');
//siempre por si la mosca
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? 'Usuario';
    $edad   = isset($_POST['edad']) ? (int)$_POST['edad'] : 0;
    $sueldoPretendido = isset($_POST['sueldo']) ? (float)$_POST['sueldo'] : 0.0;

    $renta = 0.1;
    $descuento = $sueldoPretendido * $renta;
    $sueldoNeto = $sueldoPretendido - $descuento;

    $esApto = ($edad >= 18 && $sueldoNeto > 450.00);

    $respuesta = [];

    if ($esApto) {
        $respuesta = [
            "status" => true,
            "mensaje" => "Felicidades $nombre, su perfil es apto. Su sueldo neto tras impuestos será de $" . number_format($sueldoNeto, 2) . "."
        ];
    } else {
        $respuesta = [
            "status" => false,
            "mensaje" => "Solicitud rechazada. El perfil no cumple con los criterios mínimos de edad o ingresos (Ingreso calculado: $" . number_format($sueldoNeto, 2) . ")."
        ];
    }

    echo json_encode($respuesta);

}