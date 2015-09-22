<?php

/**
 * Description of ee
 *
 * @author Ludo
 */

abstract class DAO {

    public abstract function create($obj);

    public abstract function request();

    public abstract function update($obj);

    public abstract function delete($obj);
    
    public abstract function getById($id);
}
