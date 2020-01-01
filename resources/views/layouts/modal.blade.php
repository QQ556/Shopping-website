<!-- Modal -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">線上提問</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="modalform" method="POST" action="/message" autocomplete="off">
                    {{ csrf_field() }}
                    <label for="basic-url">你的姓名</label>
                    <div class="input-group mb-3">
                        <input type="text" 　 aria-label="Username" class="form-control" id="Username" name="Username"
                            aria-describedby="basic-addon3" data-dismiss>
                    </div>
                    <label for="basic-url">你的電話</label>
                    <div class="input-group mb-3">
                        <input type="number"   　aria-label="telphone" class="form-control" id="telphone" name="telphone"
                            aria-describedby="basic-addon3" required>
                    </div>
                    <label for="basic-url">你的信箱</label>
                    <div class="input-group mb-3">
                        <input type="text" 　 aria-label="Email" class="form-control" id="Email" name="Email"
                            aria-describedby="basic-addon3" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea2">你想跟店家說的話</label>
                        <textarea class="form-control rounded-0" id="message" name="message" rows="3"
                            required></textarea>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">關閉</button>
                <button id="myFormSubmit" type="submit" class="btn btn-primary">傳送訊息</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('#myFormSubmit').click(function(e){
      e.preventDefault();
      alert($('#Username').val());
      /*
      $.post('http://path/to/post', 
         $('#myForm').serialize(), 
         function(data, status, xhr){
           // do something here with response;
         });
      */
});
</script>