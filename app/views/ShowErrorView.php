<?php

namespace views;

class ShowErrorView extends View {

    public function executeHtml($dataContainer) {
        return \View::make('pages/index-error')->with($dataContainer);
    }

    public function executeJson($dataContainer) {

        $this->httpStatus = 501;
        $dataContainer['api-error'] = 'You failed to provide ?show_me';

        return parent::executeJson($dataContainer);
    }
} 