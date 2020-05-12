<?php

namespace Hcode\Model;

use \Hcode\DB\Sql;
use \Hcode\Model;
use \Hcode\Mailer;

class ChatAdmin extends Model {

    public static function listAll()
    {
        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_chatadmin");
    }

    public function show()
    {
        $sql = ChatAdmin::listAll();
    }

    public function save()
    {

        $sql = new Sql();

        if ($this->getname() && $this->getmessage()){
            $results = $sql->select("CALL sp_chatadmin_save(:id, :name, :message)", array(
                ":id"=>$this->getid(),
                ":name"=>$this->getname(),
                ":message"=>$this->getmessage()
            ));

            $this->setData($results[0]);
        }else{

        }
    }

}

?>