<?php

namespace App\Http\Controllers;

use App\Models\Especie;
use App\Models\InventarioZona;
use App\Models\Zona;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function ETL(){//menu Admin ETL
        return view('/ETL');
    }
    public function respaldo_restauracion(){//menu Admin respaldo y restauracion
        return view('/respaldo_restauracion');
    }

    public function ejecucion()
    {
        //EXTRACCION
        //configuracion de la base de datos transaccional
        $servidor = "127.0.0.1";
        $database = "gerenciales";
        $port = '3306';
        $username = "root";
        $password = "admin";

        //Conexion a la BD transaccional
        $conn = mysqli_connect($servidor, $username, $password, $database, $port);

        //Prueba de conexion
        if (!$conn) {
            die("La conexion ha fallado: " . mysqli_connect_error());
        }

        //TRANSFORMACION
        //Tabla zonas
        $queryset = Zona::all();

        //Verificar si esta vacias la BD gerencial, si hay actualizaciones
        if (count($queryset) == 0) {
            $query = "SELECT * FROM zonas";

            $result = $conn->query($query);
            while ($fila = $result->fetch_array()) {
                $zonas[] = array_map('utf8_encode', $fila);
            }
        } else {
            $i = 0;
            while ($i < count($queryset)) {
                $prueba = [];
                $texto = strval($queryset[$i]->id);
                foreach ($conn->query("SELECT * FROM zonas WHERE id = '$texto'") as $fila) {
                    $prueba = $fila;
                }
                if ($prueba != []) {
                    $eliminar = Zona::destroy($queryset[$i]->id);
                } else {
                    $query = "SELECT * FROM zonas";

                    $result = $conn->query($query);
                    while ($fila = $result->fetch_array()) {
                        $zonas[] = array_map('utf8_encode', $fila);
                    }
                }
                $i++;
            }
            $queryset = Zona::all();
            if (count($queryset) == 0) {
                $query = "SELECT * FROM zonas";

                $result = $conn->query($query);
                while ($fila = $result->fetch_array()) {
                    $zonas[] = array_map('utf8_encode', $fila);
                }
            }
        }

        //Tabla zona_inventarios
        $query = "SELECT * FROM inventario_zonas";

        $result = $conn->query($query);
        while ($fila = $result->fetch_array()) {
            $inventario_zonas[] = array_map('utf8_encode', $fila);
        }

        //Tabla especies
        $query = "SELECT * FROM especies";

        $result = $conn->query($query);
        while ($fila = $result->fetch_array()) {
            $especies[] = array_map('utf8_encode', $fila);
        }

        //Tabla ventas
       /*  $query = "SELECT * FROM ventas";

        $result = $conn->query($query);
        while ($fila = $result->fetch_array()) {
            $ventas[] = array_map('utf8_encode', $fila);
        } */

        mysqli_close($conn);

        //CARGA
        //Tabla zonas
        foreach ($zonas as $valor) {
            $zona = new Zona();
            $zona->id = $valor["id"];
            $zona->nombre_zona = $valor["nombre_zona"];
            $zona->descripcion_zona = $valor["descripcion_zona"];
            $zona->estado_zona = $valor["estado_zona"];
            $zona->created_at = null;
            $zona->updated_at = null;
            $zona->save();
        }
        //Tabla zona_inventarios
        foreach ($inventario_zonas as $valor) {
            $inventario_zona = new InventarioZona();
            $inventario_zona->id = $valor["id"];
            $inventario_zona->codigo_inventario = $valor["codigo_inventario"];
            $inventario_zona->nombre_inventario = $valor["nombre_inventario"];
            $inventario_zona->descripcion_inventario = $valor["descripcion_inventario"];
            $inventario_zona->zona_id = $valor["zona_id"];
            $inventario_zona->created_at = null;
            $inventario_zona->updated_at = null;
            $inventario_zona->save();
        }
        //Tabla especies
        foreach ($especies as $valor) {
            $especie = new Especie();
            $especie->id = $valor["id"];
            $especie->nombre_especie = $valor["nombre_especie"];
            $especie->costo_especie = $valor["costo_especie"];
            $especie->valorVenta = $valor["valorVenta"];
            $especie->numeracionInicial = $valor["numeracionInicial"];
            $especie->numeracionFinal = $valor["numeracionFinal"];
            $especie->cantidad_especie = $valor["cantidad_especie"];
            $especie->estado_especie = $valor["estado_especie"];
            $especie->inventario_id = $valor["inventario_id"];
            $especie->created_at = null;
            $especie->updated_at = null;
            $especie->save();
        }

         //Tabla especies
         /* foreach ($ventas as $valor) {
            $venta = new Venta();
            $venta->id = $valor["id"];
            $venta->name = $valor["name"];
            $venta->especie_id = $valor["especie_id"];
            $venta->zona_id = $valor["zona_id"];
            $venta->cantidad = $valor["cantidad"];
            $venta->total = $valor["total"];
            $venta->created_at = null;
            $venta->updated_at = null;
            $especie->save();
        } */

        //FALTA INSERTAR UNA BITACORA NUEVA Y DEBE REDIRECCIONAR A ESA PANTALLA

        return view('/finETL');
    }
}
