<?php

namespace views;

class ShowSuccessView extends View {

    public function executeHtml($dataContainer) {
        return \View::make('pages/index')->with($dataContainer);
    }

    public function executeJson($dataContainer) {

        $dataContainer['api-data'] = 'Here some extra info just for your API!';

        return parent::executeJson($dataContainer);
    }
} 