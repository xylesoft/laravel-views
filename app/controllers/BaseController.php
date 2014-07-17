<?php

class BaseController extends Controller {

    protected static $dataContainer = [];

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

    protected function setAttribute($name, $data) {
        self::$dataContainer[$name] = $data;
    }

    /**
     * Call upon a view
     *
     * @param string $name
     */
    protected function executeView($viewName) {
        $viewClass = 'views\\' . $viewName . 'View';
        $view = new $viewClass(Request::format());
        return $view->execute(self::$dataContainer);
    }

}
