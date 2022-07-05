<!--
tab content with editors. tabs can be inserted in a form
-->
{!! Form::bsText(['id' => $titleid, 'labeltext' => 'Title', 'name' => $titlefield, 'value' => $titleval]) !!}
{!! Form::bsEditor(['id' => $editorid, 'name' => $editorfield, 'labeltext' => 'Text', 'value' => $editorval, 'configvar' => 'editorConfig']); !!}
