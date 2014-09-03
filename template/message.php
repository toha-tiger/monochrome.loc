<?php

if (count($this->message) ) {
    echo "<div class=\"alert {$this->message['class']}\">";
    echo '<p>' . implode ($this->message['text'], '<br />') . '</p>';
    echo '</div>';
}
