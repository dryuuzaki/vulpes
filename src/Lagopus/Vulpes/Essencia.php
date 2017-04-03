<?php

namespace Lagopus\Vulpes;

/**
 *  Essencia
 *  Responsável fornecer os métodos getters e setters
 *  @author Djavan "Ryuuzaki" Fernando
 *  @since	01/02/2017
 *  @version 1.0.0
 */


class Essencia implements \JsonSerializable{
	
	protected $id;
	
	public function __construct(){
		
	}
	
	public function __call($metodo, $parametros){		
				
		$reflect = new \ReflectionClass($this);
		
		try{
			
			$atributo = $reflect->getProperty($metodo);
			
			$atributo->setAccessible(true);
			
			if( isset( $parametros[0] ) ){
				$atributo->setValue($this, $parametros[0]);
			}else{
				return $atributo->getValue($this);
			}
			
		}catch(\ReflectionException $ex){			
			throw new \Exception("A CLASSE ".$reflect->getName()." NÃO POSSUI O MÉTODO ".$metodo);
		}		
		
	}
	
	
	
	public function jsonSerialize() {
		
		$reflect = new \ReflectionClass($this);
		
		$arrayJson = array();
		
		$props   = $reflect->getProperties();
		
		foreach ( $props as $prop ){
			
			$prop->setAccessible(true);					
			
			$arrayJson[$prop->getName()] = $prop->getValue($this);			
			
		}		
		
		return $arrayJson;
	}
	
}

?>
