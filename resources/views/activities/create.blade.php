@extends('layouts.app')
@section('content')
    <div class="container py-5">
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
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="from_datetime">From time & date</label>
                        <input width="312" id='from_datetime' />
                        <small>format: yyyy-dd-mm HH:MM</small>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="to_datetime">To time & date</label>
                        <input width="312" id='to_datetime' />
                        <small>format: yyyy-dd-mm HH:MM</small>
                    </div>
                </div>
            </div>
            <a href="javascript:;" class="btn btn-primary" id="create_activity_submit_btn">Submit</a>
        </form>
    </div>
    <script>
        $('#from_datetime').datetimepicker({
            footer: true,
            modal: true,
            format: 'yyyy-dd-mm HH:MM'
        });

        $('#to_datetime').datetimepicker({
            footer: true,
            modal: true,
            format: 'yyyy-dd-mm HH:MM'
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