<?php
abstract class ObjectBase{

    public function __construct($data)
    {
        foreach($data as $key=>$value){
            $method = 'set'.ucfirst($key);
            if(method_exists($this, $method))
                $this->$method($value);
        }
        $this->updateOrCreate();
    }

    public function updateOrCreate(){
        $data = [];
        $reflectionObject = new ReflectionObject($this);
        $vars = $reflectionObject->getProperties(ReflectionProperty::IS_PRIVATE);
        foreach ($vars as $privateVar) {
            $privateVar->setAccessible(true);
            $data[$privateVar->getName()] = $privateVar->getValue($this);
            $privateVar->setAccessible(false);
        }
        $modelName = (get_class($this)).'Model';
        $model = new $modelName;
        $model->updateOrCreate($data);
    }

    public function updateAttribute($attributeName, $attributeValue){
        $modelName = (get_class($this)).'Model';
        $model = new $modelName;
        $model->updateOne($attributeName, $attributeValue, $this->getId());
    }
}