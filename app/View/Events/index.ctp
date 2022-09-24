   <div class="row justify-content-center align-items-center" style="height:100vh">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center">Add Event</h2>
                        <form class="mt-3" id="eventForm" autocomplete="off">
                            <div class="form-group">
                                <label for="name">Title:</label>
                                <input type="text" id="title" class="form-control" name="title">
                            </div>
                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea class="form-control" rows="5" id="description" name="description"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="location">Location:</label>
                                <input type="text" id="location" class="form-control" name="location">
                            </div>
                            <div class="form-group">
                            	<label for="date">Date:</label>
                                <input type="date" id="date" class="form-control" name="date">
                            </div>
                             <div class="form-group">
                                <label for="time_from">Time From:</label>
                                <input type="time" id="time_from" class="form-control" name="time_from">
                            </div>
                             <div class="form-group">
                                <label for="time_to">Time To:</label>
                                <input type="time" id="time_to" class="form-control" name="time_to">
                            </div>
                            <button id="btnAddEvent" class="btn btn-primary">Add Event</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

<script type="text/javascript">
    
    $(document).ready(function(){

        $('#eventForm').submit(function(e){

            e.preventDefault();

            var title = $('#title').val();
            var desc = $('#description').val();
            var location = $('#location').val();
            var date = $('#date').val();
            var time_from = $('#time_from').val();
            var time_to = $('#time_to').val();


            var message = '';

            if(title==''||desc==''||location==''||date==''||time_from==''||time_to=='') {

                message = 'All fields are required';

                alert(message);

                return false;
            }

            $.ajax({

                url: '<?php echo $this->Html->url('/events');?>',
                method : 'POST',
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(data) {

                    // var data = JSON.parse(data);

                    // if(data.success==1) {

                    //     $('#eventForm')[0].reset();
                    // }
                },
                error: function(jqXHR, error, status) {

                    console.log(error);
                    console.log(status);
                }
            })

        });
    });
</script>