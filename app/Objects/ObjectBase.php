<?php
abstract class ObjectBase{

    private $data = [];

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $numargs = func_num_args();
        $arguments = func_get_args();
        if($numargs == 0)
            throw new ObjectException('Un argument est attendu au constructeur d\'un objet');
        if(is_array($arguments[0])){
            $function = '__constructWithData';
        }
        else if(is_numeric($arguments[0])){
            $function = '__constructWithId';
        }
        else{
            throw new ObjectException('Construction d\'objet avec les mauvais paramètres');
        }
        call_user_func_array(array($this, $function), $arguments);
    }

    /**
     * @throws ObjectException
     */
    public function __constructWithData($constructData)
    {
        if(is_null($constructData))
            throw new ObjectException('La grille de données en paramètre est nulle');
        foreach($constructData as $key=> $value){
            $method = 'set'.ucfirst($key);
            if(method_exists($this, $method)){
                $this->data[$key] = $value;
                $this->$method($value);
            }

        }
    }

    public function __constructWithId($id)
    {
        $this->data['id'] = $id;
        $this->setId($id);
    }

    public function updateOrCreate(){
        foreach ($this->data as $key => $value) {
            echo $key.' = '.$value.'<br>';
            $method = 'get'.ucfirst($key);
            $this->data[$key] = $this->$method();
        }
        $modelName = (get_class($this)).'Model';
        $model = new $modelName;
        $model->updateOrCreate($this->data);

    }

    public function updateAttribute($attributeName, $attributeValue){
        $this->data[$attributeName] = $attributeValue;
        $modelName = (get_class($this)).'Model';
        $model = new $modelName;
        $model->updateOne($attributeName, $attributeValue, $this->getId());
    }

    public function destroy(){
        $modelName = (get_class($this)).'Model';
        $model = new $modelName;
        $model->deleteOne($this->getId());

    }

}