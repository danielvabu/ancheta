<?php

class sessionesModel {

    public $db;

    function __construct() {
        $this->db = ADONewConnection(DB_TIPO);
        $this->db->debug = DB_DEBUG;
        $this->db->Connect(DB_SERVER, DB_USER, DB_CLAVE, DB_DB);
        $this->db->SetFetchMode(ADODB_FETCH_ASSOC);
    }

    function __destruct() {
        $this->db->close();
    }

    public function cantidad() {
        $sql = "SELECT count(sessiones.id) as son FROM sessiones";
        $son = $this->db->Execute($sql);
        return $son->fields["son"];
    }

    public function activos() {
        $sql = "
			SELECT sessiones.*
			FROM sessiones
			WHERE sessiones.estado=1";
        return $this->db->Execute($sql);
    }

    public function inactivos() {
        $sql = "
			SELECT sessiones.*
			FROM sessiones
			WHERE sessiones.estado=0";
        return $this->db->Execute($sql);
    }

    public function listar() {
        $sql = "
			SELECT sessiones.*
			FROM sessiones WHERE fin=1
			";
        return $this->db->Execute($sql);
    }

    public function ver($id) {
        $sql = "
			SELECT sessiones.*
			FROM sessiones
			WHERE sessiones.id = " . $id;
        return $this->db->Execute($sql);
    }

    public function verancheta($id) {
        $sql = "SELECT presentaciones.id,presentaciones.precio,presentaciones.presentacion,ancheta.cantidad,productos.nombre FROM ancheta LEFT JOIN sessiones ON (sessiones.session_id=ancheta.sessione_id) LEFT JOIN presentaciones ON (presentaciones.id=ancheta.presentacion_id) LEFT JOIN productos ON (productos.id=presentaciones.producto_id) WHERE sessiones.id=" . $id . "";

        return $this->db->Execute($sql);
    }

    public function filtrar($llega) {
        $where = "";
        if (isset($llega["nombre"]) && $llega["nombre"] != "")
            $where .= "sessiones.nombre REGEXP '" . $llega["nombre"] . "' AND ";
        if (isset($llega["email"]) && $llega["email"] != "")
            $where .= "sessiones.email REGEXP '" . $llega["email"] . "' AND ";

        $sql = "
			SELECT sessiones.*
			FROM sessiones

			WHERE " . $where . " 1
			";
        return $this->db->Execute($sql);
    }

    public function agregando($entra) {
        if ($this->db->AutoExecute("sessiones", $entra, "INSERT") == false) {
            return 0;
        } else {
            return $this->db->INSERT_ID();
        }
    }

    public function editar($id) {
        $sql = "
			SELECT sessiones.*
			FROM sessiones
			WHERE sessiones.id = " . $id;
        return $this->db->Execute($sql);
    }

    public function editando($id, $entra) {
        if ($this->db->AutoExecute("sessiones", $entra, "UPDATE", "id=" . $id) == false) {
            return 0;
        } else {
            return $id;
        }
    }

    public function eliminar($id) {
        return $this->db->Execute("DELETE FROM sessiones WHERE id=" . $id);
    }

}
