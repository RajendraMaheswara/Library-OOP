<?php
    class Form {
        var $fields = array();
        var $action;
        var $submit = "";
        var $jumField = 0;

        function __construct($action, $submit){
            $this->action = $action;
            $this->submit = $submit;
        }

        function addText($name, $label){
            $this->fields[$this->jumField] = array(
                'type'  => 'text',
                'name'  => $name,
                'label' => $label
            );
            $this->jumField++;
        }

        function addPassword($name, $label){
            $this->fields[$this->jumField] = array(
                'type'  => 'password',
                'name'  => $name,
                'label' => $label
            );
            $this->jumField++;
        }

        function addRadio($name, $label, $options){
            $this->fields[$this->jumField] = array(
                'type'    => 'radio',
                'name'    => $name,
                'label'   => $label,
                'options' => $options
            );
            $this->jumField++;
        }

        function addCheckbox($name, $label, $options){
            $this->fields[$this->jumField] = array(
                'type'    => 'checkbox',
                'name'    => $name,
                'label'   => $label,
                'options' => $options
            );
            $this->jumField++;
        }

        function addSelect($name, $label, $options){
            $this->fields[$this->jumField] = array(
                'type'    => 'select',
                'name'    => $name,
                'label'   => $label,
                'options' => $options
            );
            $this->jumField++;
        }

        function addTextarea($name, $label){
            $this->fields[$this->jumField] = array(
                'type'  => 'textarea',
                'name'  => $name,
                'label' => $label
            );
            $this->jumField++;
        }

        function displayForm(){
            echo "<form action='".$this->action."' method='post'>";
            echo "<table width='100%' cellspacing='5'>";
            
            foreach($this->fields as $field){
                echo "<tr><td align='right'>".$field['label']."</td><td>";
                
                switch($field['type']){
                    case 'text':
                        echo "<input type='text' name='".$field['name']."'>";
                        break;
                    case 'password':
                        echo "<input type='password' name='".$field['name']."'>";
                        break;
                    case 'radio':
                        foreach($field['options'] as $val => $optLabel){
                            echo "<input type='radio' name='".$field['name']."' value='".$val."'> ".$optLabel." ";
                        }
                        break;
                    case 'checkbox':
                        foreach($field['options'] as $val => $optLabel){
                            echo "<input type='checkbox' name='".$field['name']."[]' value='".$val."'> ".$optLabel." ";
                        }
                        break;
                    case 'select':
                        echo "<select name='".$field['name']."'>";
                        foreach($field['options'] as $val => $optLabel){
                            echo "<option value='".$val."'>".$optLabel."</option>";
                        }
                        echo "</select>";
                        break;
                    case 'textarea':
                        echo "<textarea name='".$field['name']."' rows='4' cols='30'></textarea>";
                        break;
                }
                
                echo "</td></tr>";
            }

            echo "<tr><td colspan='2' align='center'>";
            echo "<input type='submit' name='tombol' value='".$this->submit."'>";
            echo "</td></tr>";
            echo "</table></form>";
        }
    }
?>
