@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="alert alert-success" role="alert" style="display: none;"></div>
        <div class="alert alert-danger" role="alert" style="display: none;"></div>
        <div class="row">
            <div class="col-md-4">
                <form id="generate_report_form">
                    @csrf
                    <div class="form-group">
                        <div class="form-group">
                            <label for="datetime_range">Select datetime range</label>
                            <input type="text" name="datetime_range" id="datetime_range" class="form-control"/>
                            <small>format: mm/dd/yyyy hh:mm</small>
                        </div>
                    </div>
                    <a href="javascript:;" class="btn btn-primary" id="report_form_submit_btn">Generate report</a><br>

                </form>
                <hr>
                <form id="email_access_url_form">
                    @csrf
                    <div class="form-group">
                        <label for="email">Send an access URL to this email address:</label>
                        <input type="email" class="form-control" id="email_report" name="email">
                        <input type="hidden" name="access_url" id="access_url">
                    </div>
                    <button class="btn btn-success" id="email_access_url_form_submit_btn" disabled>E-mail access url</button>
                </form>
            </div>
            <div class="col-md-8" id="activities_table" style="display: none;">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Description</th>
                        <th scope="col">Started at</th>
                        <th scope="col">Finished at</th>
                        <th scope="col">Time spent</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>

        $('#email_report').on('change', function() {
            if ($(this).val() == '') {
                $('#email_access_url_form_submit_btn').attr('disabled', true);
            } else {
                $('#email_access_url_form_submit_btn').attr('disabled', false);
            }
        });

        $('#email_report').on('keyup', function() {
            if ($(this).val() == '') {
                $('#email_access_url_form_submit_btn').attr('disabled', true);
            } else {
                $('#email_access_url_form_submit_btn').attr('disabled', false);
            }
        });

        $('#datetime_range').daterangepicker({
            timePicker: true,
            locale: {
                format: 'MM/DD/YYYY hh:mm A'
            },
        });

        $('#report_form_submit_btn').on('click', function() {
            $('#generate_report_form').submit();
        });

        $('#generate_report_form').on('submit', function(e) {
            e.preventDefault();

            $('.alert-danger').empty();
            $('.alert-success').empty();
            $('.alert-danger').hide();
            $('.alert-success').hide();

            let form = $(this);

            $.ajax({
                url: '/activity/report',
                method: 'POST',
                data: form.serialize(),
                success: function(response) {
                    if (response.error) {
                        $('.alert-danger').empty();
                        $('.alert-danger').append('<p>' + response.message + '<p>');
                        $('.alert-danger').show();
                    } else {
                        $('#activities_table tbody').empty();

                        $('#access_url').val(response.url);

                        if(response.activities.length > 0) {
                            response.activities.map(activity => {


                                $('#activities_table tbody').append(
                                    `<tr>
                                    <td>` + activity.description + `</td>
                                    <td>` + activity.started_at + `</td>
                                    <td>` + activity.finished_at + `</td>
                                    <td>` + activity.time_spent + `</td>
                                <tr>`
                                );
                            });

                            $('#activities_table').show();
                        } else {
                            $('#activities_table').hide();
                        }

                        $('.alert-success').empty();
                        $('.alert-success').append('<p>' + response.message + '<p>');
                        $('.alert-success').show();
                    }
                }
            });
        });

        $('#email_access_url_form_submit_btn').on('click', function(e) {
            e.preventDefault();
            $('#email_access_url_form').submit();
        });

        $('#email_access_url_form').on('submit', function(e) {
            e.preventDefault();

            let form = $(this);

            $.ajax({
                url: '/report/email-url',
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