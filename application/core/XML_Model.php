<?php

/**
 * CSV-persisted collection.
 * 
 * @author		JLP
 * @copyright           Copyright (c) 2010-2017, James L. Parry
 * ------------------------------------------------------------------------
 */
class XML_Model extends Memory_Model
{
//---------------------------------------------------------------------------
//  Housekeeping methods
//---------------------------------------------------------------------------

	/**
	 * Constructor.
	 * @param string $origin Filename of the XML file
	 * @param string $keyfield  Name of the primary key field
	 * @param string $entity	Task name meaningful to the persistence
	 */
	function __construct($origin = null, $keyfield = 'id', $entity = null)
	{
		parent::__construct();

		// guess at persistent name if not specified
		if ($origin == null)
			$this->_origin = get_class($this);
		else
			$this->_origin = $origin;

		// remember the other constructor fields
		$this->_keyfield = $keyfield;
		$this->_entity = $entity;

		// start with an empty collection
		$this->_data = array(); // an array of objects
		$this->fields = array(); // an array of strings
		// and populate the collection
		$this->load();
	}

	/**
	 * Load the collection state appropriately, depending on persistence choice.
	 * OVER-RIDE THIS METHOD in persistence choice implementations
	 */
	protected function load()
	{
	    //Checking if the file exists
        if (file_exists($this->_origin)) {
            $xml = simplexml_load_file($this->_origin);
        } else {
            exit('Failed to open data.xml.');
        }

        //Update the DB so called Titles (id, flag, etc) into an
        //array from memory_model named _fields
        $something = $xml->item;
        $fields = array();
       foreach ($something->children() as $key){
           array_push($fields,$key->getName());
       }
        $this->_fields = $fields;

        // build the list of tasks
        foreach ($xml->item as $item) {
            // Creates rows of data stored in data in format:
            // ( [1] => stdClass Object ( [id] => 1 [task] => COMP1234 Assignment [priority] => 2 [size] => 2 [group] => 2 [deadline] => 20170219 [status] => 2 [flag] => )
            $record = new stdClass();
            for ($i = 0; $i < count($this->_fields); $i ++ )
                $record->{$this->_fields[$i]} = (string)$item->{$this->_fields[$i]};
            $key = $record->{$this->_keyfield};
            $this->_data[$key] = $record;
        }

        $this->reindex();
    }
        

	/**
	 * Store the collection state appropriately, depending on persistence choice.
	 * OVER-RIDE THIS METHOD in persistence choice implementations
	 */
	protected function store()
	{
		// rebuild the keys table
		$this->reindex();
		//---------------------
        //Create empty XML document
        $doc = new DOMDocument();
        if ($doc) {
            // we want a nice output
            $doc->formatOutput = true;

            $top = $doc->createElement('tasks');
            $top = $doc->appendChild($top);

            //Iterate through each record in data (each record has an item object
            foreach ($this->_data as $key => $record) {

                $root = $doc->createElement('item');
                $root = $top->appendChild($root);

                //Iterate through each predefined _field and create xml tag <fieldname> field content </fieldname>
                for($i = 0; $i < count($this->_fields); $i ++ ){
                    $element = $doc->createElement($this->_fields[$i], $record->{$this->_fields[$i]});
                    $element = $root->appendChild($element);
                }
            }

            //Saves $doc content into the origin (aka, local address of file)
            $doc->save($this->_origin);
        } else {
            exit('Failed to store data in tasks.xml.');
        }
	}

}
