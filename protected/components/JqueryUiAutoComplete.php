<?php
/**
 * JqueryUiAutoComplete class file.
 *
 * @author Robert Bernhard <bloddynewbie@gmail.com>
 */
Yii::import ('zii.widgets.jui.CJuiAutoComplete');

/**
 * JqueryUiAutoComplete erweitert CJuiAutoComplete
 *
 * 1. Aktivierung/Deaktivierung einer Zwangsauswahl
 * 2. Anzeige der übereinstimmen Wortphrase im AutoComplete
 * 3. Implementierung eines Hiddenfeldes für einen verborgenen ID Feldes
 *
 * @author Robert Bernhard <bloddynewbie@gmail.com>
 * @package application.components.widgets
 * @subpackage jui
 */
class JqueryUiAutoComplete extends CJuiAutoComplete
{
        /**
        * zwanghafte Selektion erforderlich
        * @var boolean $requiredSelection wenn gesetzt, wird der eingegebene Value gegen die Suggestion geprüft und bei Bedarf geleert 
        */
        public $requiredSelection = false;
        
        /**
        * Anzeige der Suchphrase in Suggest
        * @var boolean $showMatchingResult - wenn gesetzt, wird im Suggest der übereinstimende Teile der Eingabe fett markiert
        */
        public $showMatchingResult = false;
        
        /**
        * Verwendung eines Hidden ID Feldes
        * @var string $hiddenFieldName - wenn nicht null, wird die ID der ausgewählten Suggestion in dieses Feld gespeichert
        */
        public $hiddenIdFieldName = null;
        
        /**
        * @var int $minLength Mindestlänge der Eingabe, bevor der Suggest aktiv wird
        */
        public $minLength = 3;
        
        /**
        * @var string unique ID des Attributes
        */
        private $attributeId;
        
        /**
        * @var string dient als proxy zum Ablegen und Abgreifen der Ajax Response Daten zur späteren Validierung
        */
        private $jqueryDataProxy;

        /**
        * Renders the open tag of the dialog.
        * This method also registers the necessary javascript code.
        */
        public function run ()
        {
                $this->createSource ();
                $this->createOptions ();
                
                parent::run ();
        }
        
        /**
        * erstellt das source-Attribut für jQuery
        */
        private function createSource ()
        {
                $this->attributeId      = CHtml::activeId ($this->model, $this->attribute);
                $sourceUrl                 = $this->sourceUrl;
                $this->sourceUrl        = null;
                $this->jqueryDataProxy = 'reponseDataFor' . $this->attributeId;
                
                $juiRenderMethod = $juiMatcherCode = null;
                if ($this->showMatchingResult)
                {
                        $juiRenderMethod = '
                                // overwrite renderer to display bold text as html
                                $("#' . $this->attributeId . '").data ("autocomplete")._renderItem = function (ul, item) {
                                        return $("<li></li>")
                                                .data ("item.autocomplete", item)
                                                .append ("<a>" + item.label + "</a>")
                                                .appendTo (ul);
                                };';
                        
                        $juiMatcherCode = '
                                var matcher = new RegExp ($.ui.autocomplete.escapeRegex (request.term), "i");
                                var text        = $(this).value;

                                // format mathing label elements with bold html
                                for (key in data)
                                {
                                        if (data [key].label && ( !request.term || matcher.test (data [key].label))) {
                                                data [key].label = data [key].label.replace (
                                                        new RegExp(
                                                                "(?![^&;]+;)(?!<[^<>]*)(" +
                                                                $.ui.autocomplete.escapeRegex (request.term) +
                                                                ")(?![^<>]*>)(?![^&;]+;)", "gi"
                                                        ), "<strong>$1</strong>");
                                        }
                                }';
                }
                
                $this->source = 'js:
                        function (request, response) {
                                ' . $juiRenderMethod . '

                                $.ajax ({
                                        type: "post",
                                        url:  "' . $sourceUrl . '",
                                        data: { 
                                                term: request.term,
                                                ' . Yii::app()->request->csrfTokenName . ': "' . Yii::app()->request->getCsrfToken() . '"
                                        },
                                        dataType: "json",
                                        success: function (data) {
                                        console.log(data);
                                                // register data in jQuery to access it later
                                                $.' . $this->jqueryDataProxy . ' = data;
                                                
                                                ' . $juiMatcherCode . '

                                                response(data);
                                        }
                                });
                        }';
        }
        
        private function createOptions ()
        {
                $requiredSelection = null;
                if ($this->requiredSelection)
                {
                        $requiredSelection = '$(this).val ("");';
                }
                
                $optionSelect = $optionChange = $fillHiddenField = null;
                if (!is_null ($this->hiddenIdFieldName))
                {
                        echo CHtml::activeHiddenField ($this->model, $this->hiddenIdFieldName);
                        
                        $optionSelect = 'js: 
                                function (event, ui) { 
                                        if (!ui.item)
                                        {
                                                return false;
                                        }

                                        $("#' . CHtml::activeId ($this->model, $this->hiddenIdFieldName) . '").val (ui.item.id);
                                }';
                        
                        $requiredSelection .= '$("#' . CHtml::activeId ($this->model, $this->hiddenIdFieldName) . '").val ("");';
                        $fillHiddenField    = '$("#' . CHtml::activeId ($this->model, $this->hiddenIdFieldName) . '").val ($.' . $this->jqueryDataProxy . ' [key].id);';
                }
                        
                $optionChange = 'js: 
                        function (event, ui) {
                                if ( !ui.item )
                                {
                                        var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex($(this).val()) + "{:content:}quot;, "+i);

                                        for (key in $.' . $this->jqueryDataProxy . ')
                                        {
                                                if ($.' . $this->jqueryDataProxy . ' [key].value.match (matcher))
                                                {
                                                        $(this).val ($.' . $this->jqueryDataProxy . ' [key].value);
                                                        ' . $fillHiddenField . '

                                                        return false;
                                                }
                                        }

                                        ' . $requiredSelection . '

                                        return false;
                                }
                        }';
                
                $this->options = array (
                        'minLength' => $this->minLength,
                        'select'        => $optionSelect,
                        'change'        => $optionChange,
                );
        }
}