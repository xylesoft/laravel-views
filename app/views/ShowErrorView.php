<?php

namespace views;

class ShowErrorView extends View {

    public function executeHtml($dataContainer) {

        // We set the title here, because the title is for HTML ONLY!
        $dataContainer['title'] = "A HTML error view";

        // Call the renderer
        return \View::make('pages/index-error')->with($dataContainer);
    }

    public function executeJson($dataContainer) {

        $this->httpStatus = 400;
        $dataContainer['api-error'] = 'You failed to provide ?show_me=1';

        return parent::executeJson($dataContainer);
    }
} 