<?php
    /**
     * @category Programación con PHP
     * @author Ing. Alfonso Chávez Baquero <alfonso.chb@gmail.com>
     * @since Creado: 2021-05-12
     * @link https://ui-avatars.com/ Homepage de la API.
     * @see Ejemplo de obtener imagenes de la api "ui-avatars.com" enviando dos textos.
     * Opcional el guardado en un directorio interno.
     */
    class ExampleClass
    {


        /**
         * @method getImage - Método para obtener imagen desde API.
         * @param (string) $name - Primer texto que genera una letra.
         * @param (string) $surname - Segundo texto que genera una letra.
         * @param (string) $gender - Referencia al genero de una persona "M, F".
         * @param (string) $path - Opcional ruta de directorio para guardar la imagen.
         * @return (string - boolean) - Retorna imagen en caso exitoso, false caso contrario.
         */
        public static function getImage( $name='', $surname='', $gender='', $path=null )
        {
            try{
                if ( empty($name) or empty($surname) or empty($gender) ) {
                    throw new \Exception("No cumple con los parámetros requeridos.", 1);
                }
                $ext = "png";
                $bgcolor = (strtoupper($gender)=="M") ? "1E4E8C" : "D53F8C";
                $filename = "https://ui-avatars.com/api/?name=".$name."+".$surname."&size=300&background=".$bgcolor."&color=fff&format=".$ext;
                
                if ( @fopen($filename, "r") ) {
                    if ( $path and file_exists($path) and is_dir($path) ) {
                        $new_file = $path.DIRECTORY_SEPARATOR.strtolower( "$name-$surname.$ext" );
                        $data = file_get_contents( $filename );
                        file_put_contents( $new_file, $data );
                    }
                    return $filename;
                }
                return false;
            } catch (Exception $e) {
                //die( $e->getMessage() );
                return false;
            }
        }

    }

    $path_image = ExampleClass::getImage( 'Alfonso', 'Chavez', 'M', 'images' );
?>
<!DOCTYPE html>
<html lang="es">
    <head>
    	<meta charset="UTF-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<title>Generar imagenes</title>
    </head>
    <body>
    	<div style="margin: 50px auto; text-align: center;">
           <img src="<?=$path_image?>" width="300" /> 
        </div>
    </body>
</html>