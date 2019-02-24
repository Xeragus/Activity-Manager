@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <form id="generate_report_form">
                    <div class="alert alert-success" role="alert" style="display: none;"></div>
                    <div class="alert alert-danger" role="alert" style="display: none;"></div>
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
                    <tr>
                        <th scope="row">3</th>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>

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
    </script>
@endsection