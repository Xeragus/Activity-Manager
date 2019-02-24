@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="alert alert-success" role="alert" style="display: none;"></div>
        <div class="alert alert-danger" role="alert" style="display: none;"></div>
        <div class="row">
            <div class="col-md-4">
                <form action="" id="daily_date_range_form">
                    @csrf
                    <div class="form-group">
                        <label for="date_range">Specify date range</label>
                        <input type="text" class="form-control" name="date_range" id="date_range">
                    </div>
                    <button id="daily_date_range_submit_btn" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="col-md-8">
                <table class="table" id="daily_activities_time_table" style="display: none;">
                    <thead>
                    <tr>
                        <th scope="col">Day</th>
                        <th scope="col">Active time (minutes)</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        $('#date_range').daterangepicker({});

        $('#daily_date_range_submit_btn').on('click', function(e) {
            e.preventDefault();

            $('#daily_date_range_form').submit();
        });

        $('#daily_date_range_form').on('submit', function (e) {
            e.preventDefault();

            $('.alert-danger').empty();
            $('.alert-success').empty();
            $('.alert-danger').hide();
            $('.alert-success').hide();

            let form = $(this);

            $.ajax({
                url: '/report/print/daily',
                method: 'POST',
                data: form.serialize(),
                success: function(response) {
                    $('#daily_activities_time_table').hide();
                    $('#daily_activities_time_table tbody').empty();

                    if (response.error) {
                        $('.alert-danger').empty();
                        $('.alert-danger').append('<p>' + response.message + '<p>');
                        $('.alert-danger').show();
                    } else {
                        if (!jQuery.isEmptyObject(response.dailyActivities)) {
                            $.each(response.dailyActivities, function(key, value) {
                                console.log(key, value);
                                $('#daily_activities_time_table tbody').append(
                                    `<tr>
                                    <td>` + key + `</td>
                                    <td>` + value + `</td>
                                </tr>`
                                );
                            });

                            $('#daily_activities_time_table').show();
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