<?php
class File
{
	public static function build_path($path_array) 
	{
	$DS = DIRECTORY_SEPARATOR;
	$ROOT_FOLDER = __DIR__ . $DS . "..";
    return $ROOT_FOLDER. $DS . join($DS, $path_array);
	}

    public static function warning($v)
    {
        $p = '<p> <span class="erreurFormulaire">' . $v . '</span></p>';
        return $p;
    }

    //Get a nice and clean array from a bad array which is composed of useless array with a repetition of the same value with differents keys
    public static function getNiceArray($oldarray)
    {
        $newarray = [];
        foreach($oldarray as $tmparray) {
            $i=1;
            foreach($tmparray as $k => $v) {
                if($i == 1) {
                    $newarray[count($newarray)+1] = $v;
                }
                $i++;
            }
        }
        return $newarray;
    }
}