<?php
class MessagesController {
    public function messages() {
        ob_start();
        require_once __DIR__ . '/../views/messages.php';
        $content = ob_get_clean();
        require_once __DIR__ . '/../views/main.php';
    }
}