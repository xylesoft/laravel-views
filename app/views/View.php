<?php

namespace views;

abstract class View {

    private $outputFormat;

    protected $httpStatus = 200;

    /**
     * Provide the Request Accepts header type for working out which execute*() method to use.
     *
     * @param $acceptsFormat
     */
    public function __construct($acceptsFormat) {
        $this->outputFormat = $acceptsFormat;
    }

    /**
     * Execute a view method based on the request format (Accepts header).
     *
     * @param $dataContainer
     * @return mixed
     * @throws \RuntimeException
     */
    public function execute($dataContainer) {
        $availableMethods = get_class_methods($this);
        $useMethod = 'execute' . ucfirst($this->outputFormat);
        if (! in_array($useMethod, $availableMethods)) {
            throw new \RuntimeException(sprintf(
                'Output format method missing in view (%s): %s()',
                get_class($this),
                $useMethod
            ));
        }

        return $this->$useMethod($dataContainer);
    }

    /**
     * Execute a HTML view, generally involves passing data to a renderer.
     *
     * @param $dataContainer
     * @throws \RuntimeException
     */
    public function executeHtml($dataContainer) {
        throw new \RuntimeException('You must overload View::executeHtml()');
    }

    /**
     * Execute a XML view, most likely to use DOMDocument or similar.
     *
     * @param $dataContainer
     * @throws \RuntimeException
     */
    public function executeXml($dataContainer) {
        throw new \RuntimeException('You must overload View::executeXml()');
    }

    /**
     * Execute a JSON view, call as parent::executeJson($dataContainer) after JSON specific additions
     * or removal against the $dataContainer for cleaner code.
     *
     * @param $dataContainer
     * @return mixed
     */
    public function executeJson($dataContainer) {
        return \Response::make(json_encode($dataContainer), $this->httpStatus);
    }

}