<?php
/**
 * Created by PhpStorm.
 * User: chico_percedes
 * Date: 2017-11-04
 * Time: 7:00 PM
 */

use Respect\Validation\Validator as v;

class Task extends CI_Model {

    // If this class has a setProp method, use it, else modify the property directly
    public function __set($key, $value) {
        // if a set* method exists for this key, 
        // use that method to insert this value. 
        // For instance, setName(...) will be invoked by $object->name = ...
        // and setLastName(...) for $object->last_name =
        $method = 'set' . str_replace(' ', '', ucwords(str_replace(['-', '_'], ' ', $key)));
        if (method_exists($this, $method))
        {
            return $this->$method($value);
        }

        // Otherwise, just set the property value directly.
        $this->$key = $value;
        return $this;
    }

    //Verifies the priority number is between 0 and 4
    public function setPriority($value){

        if (v::intVal()->between(0, 4)->validate($value))
        {
            //Failed Action
            return 'Success';
        }
        else
        {
            //Success Action
            return 'Fail';
        }
    }

    //Verifies the name is an alphanumeric with spaces string with a max
    //length of 64 chars
    public function setToDoName($value)
    {
        //^[a-zA-Z0-9]+(?:[\w -]*[a-zA-Z0-9]+)*$
        if (
            v::regex('/^[a-zA-Z0-9]+(?:[\w -]*[a-zA-Z0-9]+)*$/')->validate($value)
            &&
            v::stringType()->length(1,64)->validate($value)
        )
        {
            //Failed Action
            return 'Success';
        }
        else
        {
            //Success Action
            return 'Fail';
        }
    }

    //Verifies the size number is between 0 and 4
    public function setSize($value){
        if (v::intVal()->between(0, 4)->validate($value))
        {
            //Failed Action
            return 'Success';
        }
        else
        {
            //Success Action
            return 'Fail';
        }
    }

    //Verifies the Group number is between 0 and 5
    public function setGroup($value){
        if (v::intVal()->between(0, 5)->validate($value))
        {
            //Failed Action
            return 'Success';
        }
        else
        {
            //Success Action
            return 'Fail';
        }
    }




}