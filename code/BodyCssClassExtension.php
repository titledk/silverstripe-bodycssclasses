<?php

/**
 * BodyCssClassesExtension
 *
 * @author Anselm Christophersen <ac@anselm.dk>
 * @date   May 2015
 */
class BodyCssClassesExtension extends DataExtension {


	/**
	 * CSS Classes for the body
	 * Contains all parent classes
	 * @return string
	 */
	public function getBodyCssClasses(){

		//we want all possible custom object and controller classes -as sometimes a controller
		//would extend a special class that the object doesn't extend - or the other way around
		$class = $this->owner->ClassName;
		//class can be overwritten with the "ClassName" method
		if (method_exists($this->owner, 'ClassName')) {
			$class = $this->owner->ClassName();
		}
		$objClass = str_replace('_Controller', '', $class);

		//if we're on Page, just return "Page".
		//In order to be able to style "Page" properly, and as all other pages should extend page,
		//their classes don't include "Page"
		//Debug::dump($objClass);
		if ($objClass == 'Page') {
			return 'Page';
		}

		$controllerClass = $objClass . '_Controller';

		$objClasses = ClassInfo::ancestry($objClass);
		//Debug::dump($objClasses);

		$controllerClasses = ClassInfo::ancestry($controllerClass);
		//Debug::dump($controllerClasses);

		//combining all classes
		$allClasses = $objClasses;
		foreach($controllerClasses as $controllerClass) {
			$class = str_replace('_Controller', '', $controllerClass);
			$allClasses[$class] = $class;
		}
		//Debug::dump($allClasses);

		//filterning unnecessary classes
		$str = '';
		foreach ($allClasses as $class) {
			//only add custom classes
			if (
					$class != 'Object' &&
					$class != 'ViewableData' &&
					$class != 'DataObject' &&
					$class != 'SiteTree' &&
					$class != 'Page' && //we specifically don't include "Page" here, so ordinary pages have a chance to be styled separately
					$class != 'RequestHandler' &&
					$class != 'Controller' &&
					$class != 'ContentController' &&
					$class != 'Page_BaseController' //this is titledk specific - TODO move out to be configurable
				) {
				$str .= $class . ' ';
			}
		}

		//Debug::dump($str);
		return $str;
	}
}
