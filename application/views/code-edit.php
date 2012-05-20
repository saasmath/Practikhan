<?=$this->load->view('scaffolding/header')?>
<textarea id="myArea">This is text</textarea>
<script>
 (function() {
    var textArea = document.getElementById('myArea');
    var myCodeMirror = CodeMirror.fromTextArea(textArea, {
      lineNumbers: true
    });
 })();
</script>

<?=$this->load->view('scaffolding/footer')?>
