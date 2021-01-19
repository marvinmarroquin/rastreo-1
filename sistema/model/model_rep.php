<?php

//model model_rep
//0430080126
//
ini_set('post_max_size', '100M');
ini_set('upload_max_filesize', '100M');
ini_set('max_execution_time', '1000');
ini_set('max_input_time', '1000');

include('../../class/db.php');

class model_rep extends Db
{
    public function __construct()
    {
        $db = Db::getInstance();
    }

    public function informe1($date1, $date2)
    {
        $db=Db::getInstance();
        $id_mov="";
        $id_env="";

        $data =array();
        /*
        $data['cantidad']=0;
        $data['chk_descripcion']="";
        */
        $sql = "select max(id_movimiento) as id_movimiento, id_envio from movimiento
                where id_envio in (
                select id_envio from guia where fecha_date between '2021-01-01' and '2021-01-19')
                group by 2";

        $a= $db->consultar($sql);
        while ($rowa=$a->fetch(PDO::FETCH_OBJ))
        {
            $id_mov=$rowa->id_movimiento;
            $id_env=$rowa->id_envio;

            $sql_b="select c.chk_descripcion from movimiento m inner join chk_id c on m.id_chk=c.id_chk where id_movimiento=$id_mov";
            $b= $db->consultar($sql_b);
            while ($rowb=$b->fetch(PDO::FETCH_OBJ))
            {
                $id_check=$rowb->chk_descripcion;

                //if(isset($data['chk_descripcion'])) {
                    $dat['chk'] = $data[$id_check];
                    $dat['cantidad'][$id_check]=$dat['cantidad'][$id_check] + 1;
                //}

                //if(isset($data[$id_check])) {
                    //$data[$id_check] = $data[$id_check] + 1;
                //}

            }



            $id_check=$rowb->chk_descripcion;


            $data['chk_descripcion'] = $dat[$id_check];
            $data['cantidad']=$dat['cantidad'];



        }


        if(!empty($data)) {
            return $data;
        }else
            return "Error en la data";//$sql_c;
    }

}