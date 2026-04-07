<h4>Uploader results</h4>
  <textarea class="form-control" id="upres" name="result" style="height:500px"></textarea>
  <script type="text/javascript">
      var writeinarea = function(str){
        jQuery('#upres').val(
          (jQuery('#upres').val().length > 0 ? jQuery('#upres').val()   + "\n"  : '' )
          + str
        );
      }
      var writeinupres = function(res){
        var proc = {!! $uploader->getresultprocessor() !!}
        text = (jQuery('#upres').val().length > 0 ? "\n\n"  : '') +
          'files uploaded: ' + proc.countFiles() + "\n";
        for (var i in proc.filelist){
          text += i + ": " + proc.filelist[i].filename + ' ' + proc.filelist[i].size + ' bytes. id: ' + proc.filelist[i].file_id + "\n";
        }
        writeinarea(text);
      }
  </script>