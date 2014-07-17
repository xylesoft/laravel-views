<?php

namespace views;

abstract class View {

    private $outputFormat;

    protected $httpStatus = 200;

    public function __construct($acceptsFormat) {
        $this->outputFormat = $acceptsFormat;
    }

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

    public function executeHtml($dataContainer) {
        throw new \RuntimeException('You must overload View::executeHtml()');
    }

    public function executeXml($dataContainer) {
        throw new \RuntimeException('You must overload View::executeXml()');
    }

    public function executeJson($dataContainer) {
        return \Response::make(json_encode($dataContainer), $this->httpStatus);
    }

}