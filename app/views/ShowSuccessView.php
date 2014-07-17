<?php

namespace views;

class ShowSuccessView extends View {

    public function executeHtml($dataContainer) {

        // We set the title here, because the title is for HTML ONLY!
        $dataContainer['title'] = "A HTML view";

        // Call the renderer
        return \View::make('pages/index')->with($dataContainer);
    }

    public function executeJson($dataContainer) {

        // We set some API specific data base JSON is for API ONLY!
        $dataContainer['api-data'] = 'Here some extra info just for your API!';

        return parent::executeJson($dataContainer);
    }
} 