Delete your team

<ul>
    <?php
      if (isset($this->data["errors"])) {
        foreach ($this->data["errors"] as $value) {
          //echo "<li>".$value."</li>";
            var_dump($value);
        }
      }
    ?>
</ul>
<?php echo isset($this->data["error_message"]) ? $this->data["error_message"] : "" ?>
