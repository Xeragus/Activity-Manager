@extends('layouts.app')
@section('content')
    <div class="container">
        <form id="create_activity_form">
            <div class="alert alert-success" role="alert" style="display: none;">
                A simple success alert—check it out!
            </div>
            <div class="alert alert-danger" role="alert" style="display: none;">
                A simple danger alert—check it out!
            </div>
            <h5>Create an activity</h5>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" id="description" rows="3" style="resize: none;"></textarea>
            </div>
            <div class="row">
                <div class="col-sm-9">
                    <div class="form-group">
                        <label for="datetime_range">Datetime range</label>
                        <input type="text" name="datetime_range" id="datetime_range" class="form-control" required/>
                        <small>format: mm/dd/yyyy hh:mm</small>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="time_spent">Time spent</label>
                        <input type="text" name="time_spent" id="time_spent" class="form-control" readonly/>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary" id="create_activity_submit_btn">Submit</button>
        </form>
    </div>
    <script>
        $(document).ready(function() {
            calculateTimeSpent();
        });

        $('#datetime_range').on('change', function () {
           calculateTimeSpent();
        });

        function calculateTimeSpent() {
            let dateRange = $('#datetime_range').val();
            let dateTimeRangeParts = dateRange.split('-');
            let dateTimeFrom = new moment(dateTimeRangeParts[0], 'MM-DD-YYYY HH:mm');
            let dateTimeTo = new moment(dateTimeRangeParts[1], 'MM-DD-YYYY HH:mm');
            let duration = moment.duration(dateTimeTo.diff(dateTimeFrom));
            let hours = parseInt(duration.asHours());
            let minutes = parseInt(duration.asMinutes())%60;
            let timeSpent = hours + 'h '+ minutes+'m';

            $('#time_spent').val(timeSpent);
        }

        $('input[name="datetime_range"]').daterangepicker({
            timePicker: true,
            startDate: moment().startOf('hour'),
            endDate: moment().startOf('hour').add(1, 'hour'),
            locale: {
                format: 'MM/DD/YYYY hh:mm A'
            },
        });

        $('#create_activity_submit_btn').on('click', function(e) {
            e.preventDefault();
            $('#create_activity_form').submit();
        });

        $('#create_activity_form').on('submit', function(e) {
            e.preventDefault();
            let form = $(this);

            $.ajax({
                url: '/activity/create',
                method: 'POST',
                data: form.serialize(),
                success: function(response) {
                    if (response.error) {
                        $('.alert-danger').empty();
                        $('.alert-danger').append('<p>' + response.message + '<p>');
                        $('.alert-danger').show();
                    } else {
                        $('.alert-success').empty();
                        $('.alert-success').append('<p>' + response.message + '<p>');
                        $('.alert-success').show();
                    }
                }
            });
        });

    </script>
@endsection