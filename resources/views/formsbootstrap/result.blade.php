<br/><br/>
    <div id="resdiv">
      <h3>Results</h3>
      <div class="form-group">
        <label>Data sent to script</label>
        <textarea class="form-control" id="result" name="result" style="height:500px"></textarea>
      </div>
      <br/>
      <input type="button" id="emptyResults" class="btn btn-danger" value="Empty results" />
    </div>
    <script>
      var processform = function(data){
        oldres = jQuery('#result').val() + (jQuery('#result').val() != '' ? "\n\n" : "");
        jQuery('#result').val(oldres + data.formcontent);
        return data.message;
      };
      jQuery('#emptyResults').on('click', function(){ jQuery('#result').val(''); });
    </script>