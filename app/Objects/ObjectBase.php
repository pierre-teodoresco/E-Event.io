<?php
abstract class ObjectBase{
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
}